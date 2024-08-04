<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelLayanan extends CI_Model
{
    var $table = 'penggunaan';
    public function getpenggunaan()
    {
        return $this->db->get($this->table);
    }
    public function cekData($where = null)
    {
        return $this->db->get_where('penggunaan', $where)->row_array();
        //$this->db->last_query();
    }
    public function getUserWhere($where = null)
    {
        return $this->db->get_where('penggunaan', $where);
    }
    public function getContactWhere()
    {
        return $this->db->get_where('penggunaan');
    }
    public function getBuku()
    {
        return $this->db->get_where('buku');
    }
    public function getdata($id = null)
    {
        if (empty($id)) {
            return [];
        }

        $this->db->where('id_penggunaan', $id);
        $query = $this->db->get('penggunaan');
        return $query->row_array();
    }
    public function delete_penggunaan_by_tagihan($id_tagihan)
    {
        // Mengambil id_penggunaan berdasarkan id_tagihan
        $this->db->select('id_penggunaan');
        $this->db->from('tagihan');
        $this->db->where('id_tagihan', $id_tagihan);
        $query = $this->db->get();
        $id_penggunaan = $query->row()->id_penggunaan;

        // Hapus dari tabel penggunaan
        $this->db->delete($this->table, ['id_penggunaan' => $id_penggunaan]);

        return $this->db->affected_rows() > 0;
    }
}
