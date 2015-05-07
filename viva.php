<?php
require_once('autoloader.php');
require_once('simple_html_dom.php');
include_once('function.php');

$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url('http://rss.viva.co.id/get/politik');

$feed->enable_cache(false);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();
$p = new Pendukung();

      
foreach($feed->get_items() as $berita){
$link = $berita->get_permalink();

if(!$p->isUrlVivaExist($link))
{
    $item['kategori'] = 1;

    $html = file_get_html($berita->get_permalink());
    $item['url'] = $berita->get_permalink();
    $item['judul'] = $html->find('h1', 0)->plaintext; 
    $isi = $html->find('div.isiberita', 0);
    if($isi){
        //$txt = explode('Editor :',$isi->plaintext);
        $item['isi'] = trim($isi->plaintext);
    }
    
    $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
    $gambar = $html->find('div.content-images-details img',0);
    if($gambar)
        $item['gambar'] = $gambar->src;
    else
        $item['gambar'] = '';
    
    if(trim($item['judul']) != '' && trim($item['isi']) != '')
    {
        $p->simpanDataViva($item);
    }
}


//bisnis
$feed->set_feed_url('http://rss.viva.co.id/get/bisnis');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/bisnis. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 2;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

//tekno
$feed->set_feed_url('http://rss.viva.co.id/get/teknologi');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/teknologi. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 6;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

//lifestyle
$feed->set_feed_url('http://rss.viva.co.id/get/kosmo');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/kosmo. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 4;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

$feed->set_feed_url('http://rss.viva.co.id/get/showbiz');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/showbiz. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 4;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

//peristiwa
$feed->set_feed_url('http://rss.viva.co.id/get/metro');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/metro. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 3;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

$feed->set_feed_url('http://rss.viva.co.id/get/dunia');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/dunia. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 3;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

//olahraga
$feed->set_feed_url('http://rss.viva.co.id/get/sport');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/sport. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 5;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

$feed->set_feed_url('http://rss.viva.co.id/get/bola');

$feed->enable_cache(false);

$feed->init();

if ($feed->error())
{
    echo "feed not valid: http://rss.viva.co.id/get/bola. error : ".$feed->error().'<br/>';
}
else
{        
    foreach($feed->get_items() as $berita){
        $link = $berita->get_permalink();
        
        if(!$p->isUrlVivaExist($link))
        {
            $item['kategori'] = 5;
        
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div.isiberita', 0);
            if($isi){
                //$txt = explode('Editor :',$isi->plaintext);
                $item['isi'] = trim($isi->plaintext);
            }
            
            $item['tanggal'] = date('Y-m-d H:i:s',strtotime($berita->get_date()));
            $gambar = $html->find('div.content-images-details img',0);
            if($gambar)
                $item['gambar'] = $gambar->src;
            else
                $item['gambar'] = '';
            
            if(trim($item['judul']) != '' && trim($item['isi']) != '')
            {
                $p->simpanDataViva($item);
            }
        }
    }
}

?>
