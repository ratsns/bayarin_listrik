<?php

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'judul' => 'Bayarin.id'
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('beranda', $data);
        // $this->load->view('template/beranda/about', $data);
        $this->load->view('template/footer', $data);
    }
}
