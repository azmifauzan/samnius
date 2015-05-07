<?php
require_once('autoloader.php');
require_once('simple_html_dom.php');
include_once('function.php');

$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url('http://sindikasi.okezone.com/index.php/rss/11/RSS2.0');

$feed->enable_cache(false);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();
$p = new Pendukung();
   
foreach($feed->get_items() as $berita){
	$link = $berita->get_permalink();

	if(!$p->isUrlOkeExist($link))
	{
	    $item['kategori'] = 2;

	    $html = file_get_html($berita->get_permalink());
	    $item['url'] = $berita->get_permalink();
	    $item['judul'] = trim($html->find('div.read h1', 0)->plaintext); 
	    $isi = $html->find('div.read p', 0);
	    if($isi){
		//$txt = explode('Editor :',$isi->plaintext);
		$item['isi'] = trim($isi->plaintext);
	    }
	    
	    $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
	    $gambar = $html->find('div.detail-img img',0);
	    if($gambar)
		$item['gambar'] = $gambar->src;
	    else
		$item['gambar'] = '';
	    	    
	    if(trim($item['judul']) != '' && trim($item['isi']) != '')
	    {
		$p->simpanDataOke($item);
	    }
	}
}
?>
