<?php
class Faq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['menu'] = 'faq';
        $this->load->view('faq_view',$data);
    }
}