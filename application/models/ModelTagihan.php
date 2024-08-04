<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelTagihan extends CI_Model
{
    var $table = 'tagihan';
    public function gettagihan()
    {
        return $this->db->get($this->table);
    }
    public function get_tagihan_detail($id_penggunaan = null)
    {
        if (empty($id_penggunaan)) {
            return [];
        }

        $this->db->select('tagihan.id_tagihan, tagihan.id_penggunaan, tagihan.bulan, tagihan.tahun, tagihan.status, penggunaan.meter_awal, penggunaan.meter_akhir, penggunaan.id_pelanggan');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
        $this->db->where('tagihan.id_penggunaan', $id_penggunaan);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_pembayaran_list()
    {
        $this->db->select('py.id_pembayaran, p.id_pelanggan, p.username, p.nomor_kwh, p.nama_pelanggan, p.alamat, 
                       t.bulan AS bulan_tagihan, 
                       IF(py.tanggal_pembayaran IS NOT NULL, "Lunas", "Belum Bayar") AS status_bayar');
        $this->db->from('pelanggan p');
        $this->db->join('tagihan t', 'p.id_pelanggan = t.id_pelanggan', 'left');
        $this->db->join('pembayaran py', 't.id_tagihan = py.id_tagihan', 'left');
        $this->db->group_by('p.id_pelanggan, t.bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_tagihan_by_pembayaran($id_pembayaran)
    {
        // Ambil ID tagihan terkait berdasarkan ID pembayaran
        $this->db->select('tagihan.id_tagihan');
        $this->db->from('tagihan');
        $this->db->join('pembayaran', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'inner');
        $this->db->where('pembayaran.id_pembayaran', $id_pembayaran);
        $tagihan = $this->db->get()->result_array();

        // Hapus tagihan dan data terkait
        foreach ($tagihan as $t) {
            $this->db->delete('tagihan', ['id_tagihan' => $t['id_tagihan']]);
        }
    }
}
