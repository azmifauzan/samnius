<?php
class Artikel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('artikelmodel','arm');
    }
    
    public function baca($tbl,$id)
    {
        switch($tbl)
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
        
        $data['artikel'] = $this->arm->getArtikel($id,$tb);
        $data['site'] = $site;
        $data['terkait'] = $this->arm->getArtikelTerkait($tb,5,$id);
        $data['judul'] = $data['artikel']->judul;
        $this->arm->tambahView($id,$tb);
        $this->load->helper('text');
        $this->load->view('baca_view',$data);
    }
}