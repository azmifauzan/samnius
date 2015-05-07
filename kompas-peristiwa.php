<?php
date_default_timezone_set("Asia/Jakarta");
require_once('autoloader.php');
$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url('http://www.kompas.com/getrss/regional');

$feed->enable_cache(false);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

require_once('simple_html_dom.php');
include_once('function.php');

$p = new Pendukung();

foreach($feed->get_items() as $berita){
    $link = $berita->get_permalink();
    
    if(!$p->isUrlKompasExist($link))
    {
        $item['kategori'] = 3;
    
        $html = file_get_html($berita->get_permalink());
        $item['url'] = $berita->get_permalink();
        $item['judul'] = $berita->get_title();
        foreach($html->find('p') as $element) 
		$isi[] = $element->plaintext;
	
	$j = count($isi)-1;
	$akhir = explode("Editor",$isi[$j]);
	$txt = '';
	for($x=0; $x<$j; $x++)
	{
		$txt .= $isi[$x];
	}
	$txt .= $akhir[0];
	$item['isi'] = $txt;
	
	$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
        $gambar = $html->find('div.images-area-img-alt2 img',0);
        if($gambar)
            $item['gambar'] = $gambar->src;
        else
            $item['gambar'] = '';
        
        if(trim($item['judul']) != '' && trim($item['isi']) != '')
        {
            $p->simpanDataKompas($item);
        }
    }
}

$feed2 = new SimplePie();
$feed2->set_feed_url('http://www.kompas.com/getrss/internasional');
$feed2->enable_cache(false);
$feed2->init();
$feed2->handle_content_type();

foreach($feed2->get_items() as $berita){
    $link = $berita->get_permalink();
    
    if(!$p->isUrlKompasExist($link))
    {
        $item['kategori'] = 3;
    
        $html = file_get_html($berita->get_permalink());
        $item['url'] = $berita->get_permalink();
        $item['judul'] = $berita->get_title();
        foreach($html->find('p') as $element) 
		$isi[] = $element->plaintext;
	
	$j = count($isi)-1;
	$akhir = explode("Editor",$isi[$j]);
	$txt = '';
	for($x=0; $x<$j; $x++)
	{
		$txt .= $isi[$x];
	}
	$txt .= $akhir[0];
	$item['isi'] = $txt;
	
	$item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
        $gambar = $html->find('div.images-area-img-alt2 img',0);
        
        if($gambar)
            $item['gambar'] = $gambar->src;
        else
            $item['gambar'] = '';
        
        if(trim($item['judul']) != '' && trim($item['isi']) != '')
        {
            $p->simpanDataKompas($item);
        }
    }
}

?>
