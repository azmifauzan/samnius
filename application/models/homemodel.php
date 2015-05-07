<?php
class Homemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getBeritaGambar($tbl,$jum)
    {
        $this->db->order_by('waktu_berita','desc');
        $this->db->limit($jum);
        $this->db->where('gambar !=','');
        return $this->db->get($tbl);
    }
    
    public function getBeritaGambarKategori($tbl,$ktg,$jum)
    {
        $this->db->order_by('waktu_berita','random');
        $this->db->limit($jum);
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        $this->db->where('gambar !=','');
        $this->db->where('kategori_id',$ktg);
        return $this->db->get($tbl);
    }
    
    public function getBeritaKategori($tbl,$ktg,$jum)
    {
        $this->db->order_by('waktu_berita','random');
        $this->db->limit($jum);
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        $this->db->where('kategori_id',$ktg);
        return $this->db->get($tbl);
    }
    
    public function getBeritaPolitik($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vpolitik');
    }
    
    public function getBeritaEkonomi($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vekonomi');
    }
    
    public function getBeritaPeristiwa($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vperistiwa');
    }
    
    public function getBeritaGaya($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vgaya');
    }
    
    public function getBeritaOlahraga($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('volahraga');
    }
    
    public function getBeritaTekno($jum)
    {
        $this->db->limit($jum);
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vtekno');
    }
    
    public function getRandomPolitik($jum)
    {
        $this->db->order_by('waktu_berita','random');
        $this->db->limit($jum);
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vpolitik');
    }
    
     public function getRandomPeristiwa($jum)
    {
        $this->db->order_by('waktu_berita','random');
        $this->db->limit($jum);
        $this->db->where('MONTH(waktu_berita)',date('m'));
        $this->db->where('YEAR(waktu_berita)',date('Y'));
        $this->db->order_by('waktu_berita','desc');
        return $this->db->get('vperistiwa');
    }
}