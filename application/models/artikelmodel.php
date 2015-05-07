<?php
class Artikelmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getArtikel($id,$tb)
    {
        $this->db->where('id',$id);
        return $this->db->get($tb)->row();
    }
    
    public function getArtikelTerkait($tb,$jum,$ex)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        $this->db->where_not_in('id',$ex);
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        return $this->db->get($tb);
    }
    
    public function tambahView($id,$tb)
    {
        $this->db->set('view','view+1',FALSE);
        $this->db->where('id',$id);
        return $this->db->update($tb);
    }
}