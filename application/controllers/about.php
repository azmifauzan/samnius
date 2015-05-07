<?php
class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['menu'] = 'about';
        $this->load->view('about_view',$data);
    }
}