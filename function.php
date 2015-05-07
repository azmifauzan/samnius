<?php

class Pendukung {
    private $host = 'localhost';
    private $userdb = 'root';
    private $passdb = 'paswot';
    private $dbname = 'samnius';
    private $con;
    
    function __construct()
    {
        $this->con = mysql_connect($this->host,$this->userdb,$this->passdb);
        mysql_select_db($this->dbname,$this->con);
    }
        
    function __destruct()
    {
        mysql_close($this->con);
    }
    
    function getStopWords()
    {
        $query = "SELECT word FROM stopword";
        $res = mysql_query($query);
        $word = array();
        while($data = mysql_fetch_array($res))
        {
            $word[] = $data["word"];
        }
        //print_r($word);
        return $word;
    }
    
    function countIdf($text)
    {
        $df_token	= array();
        $inv_index	= array();
        $stopwords = $this->getStopWords();
        
        //hitung jumlah kalimat
        $re = '/# Split sentences on whitespace between them.
            (?<=                # Begin positive lookbehind.
              [.!?]             # Either an end of sentence punct,
            | [.!?][\'"]        # or end of sentence punct and quote.
            )                   # End positive lookbehind.
            (?<!                # Begin negative lookbehind.
              Mr\.              # Skip either "Mr."
            | Mrs\.             # or "Mrs.",
            | Ms\.              # or "Ms.",
            | Jr\.              # or "Jr.",
            | Dr\.              # or "Dr.",
            | Prof\.            # or "Prof.",
            | Sr\.              # or "Sr.",
            | Drs\.             # or... (you get the idea).
            | ST\.
            | MT\.
            | dr\.
            )                   # End negative lookbehind.
            \s+                 # Split on whitespace between sentences.
            /ix';
        $sentences = preg_split($re, $text, -1, PREG_SPLIT_NO_EMPTY);
        $N = sizeof($sentences);
        
        $token = preg_split("/[\d\W\s]+/", strtolower($text));
        $token = array_diff($token, $stopwords);		
	$token = array_values($token); // perbaiki indeks
        
        // menyimpan nilai df tiap token
        $token = array_count_values($token); // hilangkan redudansi token        
        
        foreach ($token as $key => $value) {
            if(trim($key) != ''){
                $df	= $value;
                $inv_index[$key] 		= array();
                $inv_index[$key]['df']      = $df;
                $inv_index[$key]['idf']	= log10($N/$df); // simpan nilai idf
            }
        }
        
        return $inv_index;
    }
    
    function generateSummary($text)
    {
    	//echo $text."<br/>";
        $stopwords = $this->getStopWords();
        $inv_index = $this->countIdf($text);        
        $re = '/# Split sentences on whitespace between them.
            (?<=                # Begin positive lookbehind.
              [.!?]             # Either an end of sentence punct,
            | [.!?][\'"]        # or end of sentence punct and quote.
            )                   # End positive lookbehind.
            (?<!                # Begin negative lookbehind.
              Mr\.              # Skip either "Mr."
            | Mrs\.             # or "Mrs.",
            | Ms\.              # or "Ms.",
            | Jr\.              # or "Jr.",
            | Dr\.              # or "Dr.",
            | Prof\.            # or "Prof.",
            | Sr\.              # or "Sr.",
            | Drs\.             # or... (you get the idea).
            | ST\.
            | MT\.
            | dr\.
            )                   # End negative lookbehind.
            \s+                 # Split on whitespace between sentences.
            /ix';
        $sentence = preg_split($re, $text, -1, PREG_SPLIT_NO_EMPTY);
        $jumlah = sizeof($sentence);
        if($jumlah > 15)
        	$compression_rate = 30/100; 
        elseif($jumlah > 8)
        	$compression_rate = 40/100;
        else
        	$compression_rate = 50/100;
	$max_sentence = floor(sizeof($sentence)*$compression_rate);
	if($max_sentence < 1)
		$max_sentence = 1;
        
        // inisialisasi
        $sentence_weight = array();

        // menghitung bobot tf.idf tiap kalimat
        foreach ($sentence as $key => $value) {
            // tokenisasi dengan membuang stopwords
            $word = preg_split("/[\d\W\s]+/", strtolower($value));
            $word = array_diff($word, $stopwords);		
            $word = array_values($word); // perbaiki indeks
            
            // inisialisasi bobot dan hitung frekuensi token
            $tf_idf 	= 0;
            $freq_word 	= array_count_values($word);

            // hitung bobot tf.idf
            foreach ($freq_word as $token => $tf){
                if(trim($token) != '')
                    $tf_idf += $tf * $inv_index[$token]['idf'];
            }

            // simpan nilai bobot kalimat
            array_push($sentence_weight, $tf_idf);
        }

        // sorting bobot tertinggi -> potong array -> sorting urutan kalimat
        arsort($sentence_weight);
        $sorted = array_slice($sentence_weight, 0, $max_sentence, true);
        ksort($sorted);
        
        // gabungkan ringkasan
        $summary = "";
        foreach ($sorted as $key => $value)
            $summary = $summary.$sentence[$key]."<br/><br/>";

        //echo $output['summary'];
        arsort($inv_index);
        $i=0;
        foreach ($inv_index as $key => $value){
            $tag[] = $key;
            $i++;
            if($i == 4)
                break;
        }
                
        // return teks asli dan hasil ringkasan
        $output = array();
        $output['summary']  = $summary;
        $output['tag'] = $tag;
        
        return $output;
    }
    
    function getIdArtikel($url,$web)
    {
        $query = "SELECT id FROM ".$web." WHERE url = '".$url."'";
        $data = mysql_fetch_array(mysql_query($query));
        return $data['id'];
    }
    
    function getIdTag($tag)
    {
        $query = "SELECT id FROM tag WHERE tag = '".$tag."'";
        $data = mysql_fetch_array(mysql_query($query));
        return $data['id'];
    }
    
    function isTagExist($tag)
    {
        $query = "SELECT id FROM tag WHERE tag = '".$tag."'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function simpanDataMerdeka($item)
    {
    	date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO merdeka(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'merdeka');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'merdeka');
            }
        }
    }
    
    function simpanDataMetro($item)
    {
    	date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO metro(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'metro');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'metro');
            }
        }
    }
    
    function isUrlExist($url)
    {
        $query = "SELECT * FROM merdeka WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function isUrlMetroExist($url)
    {
        $query = "SELECT * FROM metro WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function formatTanggalMerdeka($tgl)
    {
        $t = explode(',',$tgl);
        $t2 = explode(' ',trim($t[1]));
        $waktu = $t2[2].'-';
        switch(strtolower($t2[1]))
        {
            case "januari" : $waktu.='01';
                break;
            case "februari" : $waktu.='02';
                break;
            case "maret" : $waktu.='03';
                break;
            case "april" : $waktu.='04';
                break;
            case "mei" : $waktu.='05';
                break;
            case "juni" : $waktu.='06';
                break;
            case "juli" : $waktu.='07';
                break;
            case "agustus" : $waktu.='08';
                break;
            case "september" : $waktu.='09';
                break;
            case "oktober" : $waktu.='10';
                break;
            case "november" : $waktu.='11';
                break;
            case "desember" : $waktu.='12';
                break;
        }
        $waktu.='-'.$t2[0].' '.$t2[3];
        return $waktu;
    }
    
    function formatTanggalMetro($tgl)
    {
        $t = explode(',',$tgl);
        $t2 = explode(' ',trim($t[1]));
        $waktu = $t2[2].'-';
        switch(strtolower($t2[1]))
        {
            case "january" : $waktu.='01';
                break;
            case "february" : $waktu.='02';
                break;
            case "march" : $waktu.='03';
                break;
            case "april" : $waktu.='04';
                break;
            case "may" : $waktu.='05';
                break;
            case "june" : $waktu.='06';
                break;
            case "july" : $waktu.='07';
                break;
            case "august" : $waktu.='08';
                break;
            case "september" : $waktu.='09';
                break;
            case "october" : $waktu.='10';
                break;
            case "november" : $waktu.='11';
                break;
            case "december" : $waktu.='12';
                break;
        }
        $waktu.='-'.$t2[0].' '.$t2[4].':00';
        return $waktu;
    }
    
    function isUrlAntaraExist($url)
    {
        $query = "SELECT * FROM antara WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function simpanDataAntara($item)
    {
        date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO antara(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'antara');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'antara');
            }
        }
    }
    
    function isUrlKompasExist($url)
    {
        $query = "SELECT * FROM kompas WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function simpanDataKompas($item)
    {
        date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO kompas(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'kompas');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'kompas');
            }
        }
    }
    
    function isUrlVivaExist($url)
    {
        $query = "SELECT * FROM viva WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function simpanDataViva($item)
    {
        date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO viva(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'viva');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'viva');
            }
        }
    }
    
    function isUrlOkeExist($url)
    {
        $query = "SELECT * FROM okezone WHERE url = '$url'";
        $res = mysql_query($query);
        if(mysql_num_rows($res) > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function simpanDataOke($item)
    {
        date_default_timezone_set("Asia/Jakarta");
        $summary = $this->generateSummary($item['isi']);
        $query = "INSERT INTO okezone(url,judul,waktu_berita,waktu_input,kategori_id,gambar,summary) VALUES('".$item['url']."','".mysql_real_escape_string($item['judul'])."','".$item['tanggal']."','".date('Y-m-d H:i:s')."','".$item['kategori']."','".$item['gambar']."','".mysql_real_escape_string($summary['summary'])."')";
        $hasil = mysql_query($query);
        if(!$hasil)
            echo $query.'-'.mysql_error().'<br/><br/>';
        else{
            foreach($summary['tag'] as $tag)
            {
                if(!$this->isTagExist($tag)){
                    $this->insertTag($tag);                    
                }
                $idartikel = $this->getIdArtikel($item['url'],'okezone');
                $idtag = $this->getIdTag($tag);
                $this->insertArtikelTag($idtag,$idartikel,'okezone');
            }
        }
    }
    
    function insertArtikelTag($idtag,$idartikel,$web)
    {
        $query = "INSERT INTO artikel_tag(id_tag,id_artikel,artikel_web) VALUES('".$idtag."','".$idartikel."','".$web."')";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function insertTag($tag)
    {
        $query = "INSERT INTO tag(tag) VALUES('".$tag."')";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function insertSummary($id,$summary,$web)
    {
        $query = "UPDATE ".$web." SET summary = '".mysql_real_escape_string($summary)."' WHERE id = ".$id;
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataMerdeka()
    {
        $query = "SELECT * FROM merdeka WHERE summary = '' LIMIT 1";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataKompas()
    {
        $query = "SELECT * FROM kompas WHERE summary = '' LIMIT 20";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataAntara()
    {
        $query = "SELECT * FROM antara WHERE summary = '' LIMIT 200";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataMetro()
    {
        $query = "SELECT * FROM metro WHERE summary = '' LIMIT 20";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataOkezone()
    {
        $query = "SELECT * FROM okezone WHERE summary = '' LIMIT 20";
        $hasil = mysql_query($query);
        return $hasil;
    }
    
    function getDataViva()
    {
        $query = "SELECT * FROM viva WHERE summary = '' LIMIT 20";
        $hasil = mysql_query($query);
        return $hasil;
    }
}
?>
