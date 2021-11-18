<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buku extends CI_Model 
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left');  
        $this->db->order_by('id_buku', 'desc');
        return $this->db->get()->result();  
    }

    public function get_data($id_buku)
    {
        $this->db->select('*');
        $this->db->from('tbl_buku');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left');  
        $this->db->where('id_buku', $id_buku);
        
        return $this->db->get()->row();  
    }

    public function add($data)
    {
        $this->db->insert('tbl_buku', $data);
        
    }
    public function edit($data)
    {
        $this->db->where('id_buku', $data['id_buku']);
        $this->db->update('tbl_buku', $data);
        
        
    }
    public function delete($data)
    {
        $this->db->where('id_buku', $data['id_buku']);
        $this->db->delete('tbl_buku', $data);
    }
}