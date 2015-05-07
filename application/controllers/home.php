<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('homemodel','hmm');
    }
    
    public function index()
    {
        $json_url = "http://103.247.211.119/samnius/index.php/service/hotNewsWithPicture";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $json_url);        
        $str = curl_exec($ch);        
        $ar = json_decode($str,true);
        print_r($ar);
        
        //$this->load->helper('text');
        //$this->load->view('home_view',$data);
    }
}