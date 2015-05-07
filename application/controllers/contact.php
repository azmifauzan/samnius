<?php
class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['menu'] = 'contact';
        $this->load->view('contact_view',$data);
    }
    
    public function send()
    {
        if($this->input->post('submit'))
        {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $msg = $this->input->post('message');
            
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $this->email->initialize($config);
            $this->email->from($email, $nama);
            $this->email->to('azmifauzan@gmail.com');
            $this->email->subject('Email dari pengunjung Kroompay');
            $this->email->message($msg);
            $this->email->send();
            $data['menu'] = 'contact';
            $this->load->view('contacts_view',$data);
        }
        else
        {
            redirect('contact','refresh');
        }
    }
}