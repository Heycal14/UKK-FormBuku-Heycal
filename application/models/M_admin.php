<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function total_buku()
    {
        return $this->db->get('tbl_buku')->num_rows();
    }

    public function total_kategori()
    {
        return $this->db->get('tbl_kategori')->num_rows();
    }
}
