<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('ModelAdmin');
        $this->load->model('ModelPemesanan');
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'css'   => array('style'),
            'js'    => array(),
            'result'   => ''
        ];
        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/index', $data);
        $this->load->view('template/admin/admin_footer');
    }

    public function login()
    {
    }
}
