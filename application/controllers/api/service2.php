<?php

class Service2 extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('servicemodel','svm');
    }
    
    public function listKategori()
    {
        $callback = $this->input->get('callback');
        
        $this->load->helper('text');
        $kategori = $this->svm->getKategori();
        foreach($kategori->result() as $kat){
            $berita = $this->svm->getBeritaTerbaruFromKategori($kat->id,0, 2);
            if($berita){
                $bt  = array();
                foreach($berita->result() as $br){
                    $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => character_limiter($br->isi,200), 'gambar' => $br->gambar, 'waktu_berita' => $br->waktu_berita);
                }
                $kt[] = array('id' => $kat->id, 'nama' => $kat->nama, 'deskripsi' => $kat->deskripsi, 'beritaTerbaru' => $bt);
            };
        }
        if(!empty($kt))
        {
            $json['listKategori'] = true;
            $json['kategori'] = $kt;             
        }
        else
        {
            $json['listKategori'] = false;
        }
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$kt)).');';
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true, 'data'=>$kt));
        };
    }
    
    public function beritaDalamKategori()
    {
        $callback = $this->input->get('callback');
        $cat = $this->input->get('cat');
        $p = $this->input->get('p');
        
        $this->load->helper('text');
        $berita = $this->svm->getBeritaTerbaruFromKategori($cat,$p);
        
        if($berita){
            foreach($berita->result() as $br){
                $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => $br->isi, 'gambar' => $br->gambar, 'waktu_berita' => date('d F Y H:i',strtotime($br->waktu_berita)), 'id'=>$br->id, 'web'=>$br->web);
            }
        };
        
        if(!empty($bt))
        {
            $json['beritaDalamKategori'] = true;
            $json['listBerita'] = $bt;
        }
        else
        {
            $json['beritaDalamKategori'] = false;
        }
        
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$bt)).');';
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true, 'data'=>$bt));
        };
    }
    
    public function detilBerita($web,$id,$idp)
    {
    	//$this->output->enable_profiler(true);
        $callback = $this->input->get('callback');
        
        $bt = array();
        
        if($web!=0 && $id!=0){
            $this->load->helper('text');
            switch($web)
            {
                case 1 : $tb = 'antara'; $site = 'Antara.com';
                    break;
                case 2 : $tb = 'kompas'; $site = 'Kompas.com';
                    break;
                case 3 : $tb = 'merdeka'; $site = 'Merdeka.com';
                    break;
                case 4 : $tb = 'metro'; $site = 'Metrotvnews.com';
                    break;
                case 5 : $tb = 'okezone'; $site = 'Okezone.com';
                    break;
                case 6 : $tb = 'viva'; $site = 'Viva.co.id';
                    break;
            }
            
            $berita = $this->svm->getBerita($tb,$id);
            if($berita) :
                //$bt[] = array('url_asal' => $berita->url, 'judul' => $berita->judul, 'isi' => character_limiter($berita->isi,250), 'gambar' => $berita->gambar, 'waktu_berita' => $berita->waktu_berita, 'view' => $berita->view);
                $bt[] = array('url_asal' => $berita->url, 'judul' => $berita->judul, 'summary' => $berita->summary, 'gambar' => $berita->gambar, 'waktu_berita' => date('d F Y H:i',strtotime($berita->waktu_berita)), 'view' => $berita->view, 'kategori_id' => $berita->kategori_id, 'web'=>$site);
                $this->svm->updateViewBerita($tb,$id);
                
                $tag = $this->svm->getTagBerita($tb,$id);
                foreach($tag->result() as $data){
                	$ex = $this->svm->isTagIdpExist($data->tag,$idp);
                	//echo $ex;
                	if($ex > 0)
                		$this->svm->updateCountTagViewBerita($data->tag,$idp);
                	else
                		$this->svm->saveTagViewBerita($data->tag,$idp);
                }
                
            endif;
        }
        
        if(!empty($bt))
        {
            $json['detilBerita'] = true;
            $json['Berita'] = $bt;
        }
        else
        {
            $json['detilBerita'] = false;
        }
        
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$bt)).');';
        }else{
            header('Content-Type:application/json;');
            echo json_encode(array('success'=>true, 'data'=>$bt));
        };
    }
    
    public function hotNews($jum)
    {
        $callback = $this->input->get('callback');
            
        $this->load->helper('text');
        $berita = $this->svm->getHotNews($jum);
        
        if($berita) :
        foreach($berita->result() as $br)
        {
            //$bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => character_limiter($br->isi,250), 'gambar' => $br->gambar, 'waktu_berita' => $br->waktu_berita, 'view' => $br->view, 'id'=>$br->id, 'web'=>$br->web);
            $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'summary' => character_limiter($br->summary,250), 'gambar' => $br->gambar, 'waktu_berita' => $br->waktu_berita, 'view' => $br->view, 'id'=>$br->id, 'web'=>$br->web);
        }
        endif;
        
        if(!empty($bt))
        {
            $json['hotNews'] = true;
            $json['listBerita'] = $bt;
        }
        else
        {
            $json['hotNews'] = false;
        }
        
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$bt)).');';
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true, 'data'=>$bt));
        }
    }
    
    public function saveNewId($idp,$dname,$dmodel,$dversion)
    {
    	//$this->output->enable_profiler(true);
    	$this->svm->addId($idp,$dname,$dmodel,$dversion);
    	$callback = $this->input->get('callback');
    	if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true).');');
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true));
        }
    }
    
    public function beritaRekomendasi($idp)
    {
    	//$this->output->enable_profiler(true);
        $callback = $this->input->get('callback');
        $p = $this->input->get('p');
        if($this->input->get('lim'))
        	$lim = $this->input->get('lim');
        else
        	$lim = 10;
                
        $this->load->helper('text');
        $tag = $this->svm->getTagFromIdp($idp);
        
        foreach($tag->result() as $dt)
        	$tg[] = $dt->tag;
        
        if(!empty($tg))
        {
	        $berita = $this->svm->getBeritaRekomendasi($tg,$p,$lim);	
		
		if($berita){
	            foreach($berita->result() as $br){
	                $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => $br->isi, 'gambar' => $br->gambar, 'waktu_berita' => date('d F Y H:i',strtotime($br->waktu_berita)), 'id'=>$br->id, 'web'=>$br->web, 'summary' => character_limiter($br->summary,250));
	            }
	        }
        }     
        
        if(empty($bt))
        {
        	$berita = $this->svm->getBeritaTerbaru($p,$lim);	
        	if($berita){
	            foreach($berita->result() as $br){
	                $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => $br->isi, 'gambar' => $br->gambar, 'waktu_berita' => date('d F Y H:i',strtotime($br->waktu_berita)), 'id'=>$br->id, 'web'=>$br->web, 'summary' => character_limiter($br->summary,250));
	            }
	        }
        }
        
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$bt)).');';
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true, 'data'=>$bt));
        };
        //print_r($berita);
    }
    
    public function beritaKeyword()
    {
    	//$this->output->enable_profiler(true);
        $callback = $this->input->get('callback');
        $p = $this->input->get('p');
        $key = $this->input->get('key');
        if($this->input->get('lim'))
        	$lim = $this->input->get('lim');
        else
        	$lim = 10;
                
        $this->load->helper('text');
        
        $berita = $this->svm->getBeritaKeyword($key,$p,$lim);	
		
	if($berita){
            foreach($berita->result() as $br){
                $bt[] = array('url_api_detail' => site_url('api/service/detilBerita/'.$br->web.'/'.$br->id),'url_asal' => $br->url, 'judul' => $br->judul, 'isi' => $br->isi, 'gambar' => $br->gambar, 'waktu_berita' => date('d F Y H:i',strtotime($br->waktu_berita)), 'id'=>$br->id, 'web'=>$br->web, 'summary' => character_limiter($br->summary,250));
            }
        }
        
        if($callback){
            header('Content-Type:application/javascript;');
            echo $callback.'('.json_encode(array('success'=>true, 'data'=>$bt)).');';
        }else{
            header('Content-Type:application/json;');
             echo json_encode(array('success'=>true, 'data'=>$bt));
        }
    }
}