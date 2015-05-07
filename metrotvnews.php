<?php
require_once('autoloader.php');
$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url('http://www.metrotvnews.com/front/rss/polkam');

$feed->enable_cache(false);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();
require_once('simple_html_dom.php');
include_once('function.php');
$p = new Pendukung();

if ($feed->error())
{
    echo "feed not valid";
}
else
{
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();    
    
        if(!$p->isUrlMetroExist($link))
        {
            $extract = explode('/',$link);
            $item['kategori'] = 1;         
                
		$html = file_get_html($berita->get_permalink());
		$item['url'] = $berita->get_permalink();
		$item['judul'] = $html->find('h1', 0)->plaintext; 
		$isi = $html->find('div.artikel', 0);
		if(!$isi)
		    $isi = $html->find('div#artikelkanan', 0)->plaintext;
		else
		    $isi = $isi->plaintext;
		$txt = explode('Share:',trim($isi));
		$item['isi'] = trim($txt[0]);
		date_default_timezone_set('UTC');
		$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
		$gambar = $html->find('div.read-media img',0);
		if($gambar)
		    $item['gambar'] = $gambar->src;
		else
		    $item['gambar'] = '';
		
		if(trim($item['judul']) != '' && $item['kategori'] != 0 && trim($item['isi']) != '')
		{
		    $p->simpanDataMetro($item);
		}
            
        }
        
    }
}

$feed2 = new SimplePie();
$feed2->set_feed_url('http://www.metrotvnews.com/front/rss/ekonomi');
$feed2->enable_cache(false);
$feed2->init();
$feed2->handle_content_type();

foreach($feed2->get_items() as $berita){
	$link = $berita->get_permalink();    
    
        if(!$p->isUrlMetroExist($link))
        {
            $extract = explode('/',$link);
            $item['kategori'] = 2;         
                
		$html = file_get_html($berita->get_permalink());
		$item['url'] = $berita->get_permalink();
		$item['judul'] = $html->find('h1', 0)->plaintext; 
		$isi = $html->find('div.artikel', 0);
		if(!$isi)
		    $isi = $html->find('div#artikelkanan', 0)->plaintext;
		else
		    $isi = $isi->plaintext;
		$txt = explode('Share:',trim($isi));
		$item['isi'] = trim($txt[0]);
		date_default_timezone_set('UTC');
		$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
		$gambar = $html->find('div.read-media img',0);
		if($gambar)
		    $item['gambar'] = $gambar->src;
		else
		    $item['gambar'] = '';
		
		if(trim($item['judul']) != '' && $item['kategori'] != 0 && trim($item['isi']) != '')
		{
		    $p->simpanDataMetro($item);
		}
            
        }
}

$feed3 = new SimplePie();
$feed3->set_feed_url('http://www.metrotvnews.com/front/rss/internasional');
$feed3->enable_cache(false);
$feed3->init();
$feed3->handle_content_type();

foreach($feed3->get_items() as $berita){
	$link = $berita->get_permalink();    
    
        if(!$p->isUrlMetroExist($link))
        {
            $extract = explode('/',$link);
            $item['kategori'] = 3;         
                
		$html = file_get_html($berita->get_permalink());
		$item['url'] = $berita->get_permalink();
		$item['judul'] = $html->find('h1', 0)->plaintext; 
		$isi = $html->find('div.artikel', 0);
		if(!$isi)
		    $isi = $html->find('div#artikelkanan', 0)->plaintext;
		else
		    $isi = $isi->plaintext;
		$txt = explode('Share:',trim($isi));
		$item['isi'] = trim($txt[0]);
		date_default_timezone_set('UTC');
		$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
		$gambar = $html->find('div.read-media img',0);
		if($gambar)
		    $item['gambar'] = $gambar->src;
		else
		    $item['gambar'] = '';
		
		if(trim($item['judul']) != '' && $item['kategori'] != 0 && trim($item['isi']) != '')
		{
		    $p->simpanDataMetro($item);
		}
            
        }
}

$feed4 = new SimplePie();
$feed4->set_feed_url('http://www.metrotvnews.com/front/rss/olahraga');
$feed4->enable_cache(false);
$feed4->init();
$feed4->handle_content_type();

foreach($feed4->get_items() as $berita){
	$link = $berita->get_permalink();    
    
        if(!$p->isUrlMetroExist($link))
        {
            $extract = explode('/',$link);
            $item['kategori'] = 5;         
                
		$html = file_get_html($berita->get_permalink());
		$item['url'] = $berita->get_permalink();
		$item['judul'] = $html->find('h1', 0)->plaintext; 
		$isi = $html->find('div.artikel', 0);
		if(!$isi)
		    $isi = $html->find('div#artikelkanan', 0)->plaintext;
		else
		    $isi = $isi->plaintext;
		$txt = explode('Share:',trim($isi));
		$item['isi'] = trim($txt[0]);
		date_default_timezone_set('UTC');
		$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
		$gambar = $html->find('div.read-media img',0);
		if($gambar)
		    $item['gambar'] = $gambar->src;
		else
		    $item['gambar'] = '';
		
		if(trim($item['judul']) != '' && $item['kategori'] != 0 && trim($item['isi']) != '')
		{
		    $p->simpanDataMetro($item);
		}
            
        }
}

?>
