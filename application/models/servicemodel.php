<?php

class Servicemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getKategori()
    {
        return $this->db->get('kategori');
    }
    
    public function getBeritaTerbaruFromKategori($id = 0, $offset=0, $limit = 10)
    {
        switch($id)
        {
            case 1: $tbl = 'vpolitik';
                break;
            case 2: $tbl = 'vekonomi';
                break;
            case 3: $tbl = 'vperistiwa';
                break;
            case 4: $tbl = 'vgaya';
                break;
            case 5: $tbl = 'volahraga';
                break;
            case 6: $tbl = 'vtekno';
                break;
        }
        
        if($id < 1 || $id > 6)
        {
            return false;
        }
        else
        {        
            $this->db->order_by('waktu_berita','desc');
            if($offset > 0){
                $offset -= 1;
            }
            $offset = ($offset * $limit);
            $this->db->limit($limit, $offset);
            return $this->db->get($tbl);
        }
    }
    
    public function getBerita($tb,$id)
    {
        $this->db->where('id',$id);
        return $this->db->get($tb)->row();
    }
    
    public function getHotNews($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('view','desc');
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        return $this->db->get('vallberita');
    }
    
    public function updateViewBerita($tb,$id)
    {
    	$this->db->set('view','view+1',FALSE);
        $this->db->where('id',$id);
        return $this->db->update($tb);
    }
    
    public function addId($idp,$dname,$dmodel,$dversion)
    {
    	$data = array(
    		"idp" => $idp,
    		"device_name" => $dname,
    		"device_model" => $dmodel,
    		"device_version" => $dversion,
    		"waktu" => date('Y-m-d H:i:s')
    	);
    	return $this->db->insert('identity',$data);
    }
    
    public function getTagBerita($tb,$id)
    {
    	$this->db->select('tag.tag');
    	$this->db->from('tag');
    	$this->db->join('artikel_tag','artikel_tag.id_tag = tag.id');
    	$this->db->where('artikel_tag.id_artikel',$id);
    	$this->db->where('artikel_tag.artikel_web',$tb);
    	return $this->db->get();
    }
    
    public function saveTagViewBerita($tag,$idp)
    {
    	$data = array(
    		"identity_id" => $idp,
    		"tag" => $tag
    	);
    	return $this->db->insert('identity_tag',$data);
    }
    
    public function updateCountTagViewBerita($tag,$idp)
    {
    	$this->db->set('count','count+1',FALSE);
        $this->db->where('identity_id',$idp);
        $this->db->where('tag',$tag);
        return $this->db->update('identity_tag');
    }
    
    public function isTagIdpExist($tag,$idp)
    {
    	$this->db->where('identity_id',$idp);
        $this->db->where('tag',$tag);
        $this->db->from('identity_tag');
        return $this->db->count_all_results();
    }
    
    public function getTagFromIdp($id)
    {
    	$this->db->select('tag');
    	$this->db->where('identity_id',$id);
    	$this->db->order_by('count','desc');
    	$this->db->limit(5);
    	return $this->db->get('identity_tag');
    }
    
    public function getBeritaRekomendasi($tag,$offset=0, $limit = 10)
    {
    	$i=1;
    	foreach($tag as $tg)
    	{
    		if($i == 1)
	    		$this->db->like('isi',$tg);
	    	else
	    		$this->db->or_like('isi',$tg);
    		$i++;
    	}
    	if($offset > 0){
                $offset -= 1;
            }
            $offset = ($offset * $limit);
            $this->db->limit($limit, $offset);
    	$this->db->order_by('waktu_berita','desc');
    	return $this->db->get('vallberita');
    }
    
    public function getBeritaTerbaru($offset=0, $limit = 10)
    {
    	if($offset > 0){
                $offset -= 1;
            }
            $offset = ($offset * $limit);
            $this->db->limit($limit, $offset);
    	$this->db->order_by('waktu_berita','desc');
    	return $this->db->get('vallberita');
    }
    
    public function getBeritaKeyword($key, $offset=0, $limit = 10)
    {
    	if($offset > 0){
		$offset -= 1;
	}
	$offset = ($offset * $limit);
	$this->db->limit($limit, $offset);
    	$this->db->order_by('waktu_berita','desc');
    	$this->db->like('judul',$key);
    	$this->db->or_like('isi',$key);
    	return $this->db->get('vallberita');
    }
}