<?php
error_reporting(E_ALL);
//echo "x";
require_once('autoloader.php');
$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url('http://www.merdeka.com/feed/');

$feed->enable_cache(false);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

require_once('simple_html_dom.php');
include_once('function.php');

$p = new Pendukung();

//print_r($feed);
foreach($feed->get_items() as $berita){
//echo "t";
    $link = $berita->get_permalink();
    
    if(!$p->isUrlExist($link))
    {
        $extract = explode('/',$link);
        $item['kategori'] = 0;
    
        if($extract[3] != 'foto')
        {
            switch($extract[3])
            {
                case "peristiwa" : $item['kategori'] = 3 ;
                    break;
                case "politik" : $item['kategori'] = 1 ;
                    break;
                case "uang" : $item['kategori'] = 2 ;
                    break;
                case "dunia" : $item['kategori'] = 3 ;
                    break;
                case "khas" : $item['kategori'] = 4 ;
                    break;
                case "gaya" : $item['kategori'] = 4 ;
                    break;
                case "artis" : $item['kategori'] = 4 ;
                    break;
                case "olahraga" : $item['kategori'] = 5 ;
                    break;
                case "sepakbola" : $item['kategori'] = 5 ;
                    break;
                case "teknologi" : $item['kategori'] = 6 ;
                    break;
                case "sehat" : $item['kategori'] = 4 ;
                    break;
                case "otomotif" : $item['kategori'] = 4 ;
                    break;
            }
            
            $html = file_get_html($berita->get_permalink());
            $item['url'] = $berita->get_permalink();
            $item['judul'] = $html->find('h1', 0)->plaintext; 
            $isi = $html->find('div#mdk-body-newsarea', 0)->plaintext;
            $txt = explode('Mulai dengan',trim($isi));
	    $txt2 = explode('Baca juga',trim($txt[0]));
            $item['isi'] = strip_tags(trim($txt2[0]));
            $tgl = $html->find('span.mdk-body-newsdate', 0)->plaintext;
            $item['tanggal'] = $p->formatTanggalMerdeka($tgl);
            $item['gambar'] = $html->find('div#mdk-body-news-detimg img',0)->src;
            
            if(trim($item['judul']) != '' && $item['kategori'] != 0 && trim($item['isi']) != '')
            {
                $p->simpanDataMerdeka($item);
            }
        }
    }
} 

//nyoba atu
/*
$berita = $feed->get_item();
$link = $berita->get_permalink();
    
if(!$p->isUrlExist($link))
{
    $extract = explode('/',$link);
    $item['kategori'] = 0;

    if($extract[3] != 'foto')
    {
        switch($extract[3])
        {
            case "peristiwa" : $item['kategori'] = 3 ;
                break;
            case "politik" : $item['kategori'] = 1 ;
                break;
            case "jakarta" : $item['kategori'] = 3 ;
                break;
            case "uang" : $item['kategori'] = 2 ;
                break;
            case "dunia" : $item['kategori'] = 3 ;
                break;
            case "khas" : $item['kategori'] = 4 ;
                break;
            case "gaya" : $item['kategori'] = 4 ;
                break;
            case "artis" : $item['kategori'] = 4 ;
                break;
            case "olahraga" : $item['kategori'] = 5 ;
                break;
            case "sepakbola" : $item['kategori'] = 5 ;
                break;
            case "teknologi" : $item['kategori'] = 6 ;
                break;
            case "sehat" : $item['kategori'] = 4 ;
                break;
            case "otomotif" : $item['kategori'] = 4 ;
                break;
        }
        
        $html = file_get_html($berita->get_permalink());
        $item['web'] = 'Merdeka.com';
        $item['url'] = $berita->get_permalink();
        $item['judul'] = $html->find('h1', 0)->plaintext; 
        $isi = $html->find('div#mdk-body-newsarea', 0)->plaintext;
        $txt = explode('Mulai dengan',trim($isi));
        $item['isi'] = trim($txt[0]);
        $tgl = $html->find('span.mdk-body-newsdate', 0)->plaintext;
        $item['tanggal'] = $p->formatTanggalMerdeka($tgl);
        $item['gambar'] = $html->find('div#mdk-body-news-detimg img',0)->src;
        
        if(trim($item['judul']) != '' || $item['kategori'] != 0 || trim($item['isi']) != '')
        {
            //$p->simpanData($item);
        }
    }
}
*/

//echo "done";

?>
