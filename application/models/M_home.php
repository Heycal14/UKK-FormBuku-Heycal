<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left');
        $this->db->order_by('id_buku', 'desc');
        return $this->db->get()->result();
    }

    public function get_all_data_kategori()
    {
        $this->db->select('*');
        $this->db->from('tbl_kategori');
        $this->db->order_by('id_kategori', 'desc');
        return $this->db->get()->result();
    }

    public function detail_buku($id_buku)
    {
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left');
        $this->db->where('id_buku', $id_buku);
        
        return $this->db->get()->row(); 
    }

    public function gambar_buku($id_buku)
    {
        $this->db->select('*');
        $this->db->from('tbl_gambar');
        $this->db->where('id_buku', $id_buku);

        return $this->db->get()->result();
    }

    public function kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tbl_kategori');
        $this->db->where('id_kategori', $id_kategori);
        
        return $this->db->get()->row();
    }
    public function get_all_data_buku($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left');
        $this->db->where('tbl_buku.id_kategori', $id_kategori);
        return $this->db->get()->result();
    }

    public function get_keyword($keyword){
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->like('judul', $keyword);
        $this->db->or_like('pengarang', $keyword);
        $this->db->or_like('penerbit', $keyword);
        return $this->db->get()->result();
    }
}
