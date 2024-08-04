<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPembayaran extends CI_Model
{
    public function get_all_pembayaran()
    {
        $this->db->select('pembayaran.id_pembayaran, pembayaran.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, penggunaan.bulan as bulan_tagihan, pelanggan.alamat, tagihan.status as status_bayar');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_pembayaran($id_pembayaran)
    {
        $this->db->delete($this->table, ['id_pembayaran' => $id_pembayaran]);
        return $this->db->affected_rows() > 0;
    }

    public function get_tagihan_by_pembayaran($id_pembayaran)
    {
        $this->db->select('tagihan.id_tagihan, penggunaan.id_penggunaan');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->where('pembayaran.id_pembayaran', $id_pembayaran);
        return $this->db->get()->row_array();
    }

    public function get_pembayaran_by_id($id_pembayaran)
    {
        return $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();
    }
    public function delete_pembayaran_dan_tagihan($id_pembayaran)
    {
        // Mengambil id_tagihan berdasarkan id_pembayaran
        $this->db->select('id_tagihan');
        $this->db->from('pembayaran');
        $this->db->where('id_pembayaran', $id_pembayaran);
        $query = $this->db->get();
        $id_tagihan = $query->row()->id_tagihan;

        // Hapus dari tabel pembayaran
        $this->db->delete('pembayaran', ['id_pembayaran' => $id_pembayaran]);

        // Hapus dari tabel tagihan
        $this->db->delete('tagihan', ['id_tagihan' => $id_tagihan]);

        return $this->db->affected_rows() > 0;
    }
}
