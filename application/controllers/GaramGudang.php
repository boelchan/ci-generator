<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class GaramGudang extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'GaramGudang';
        $this->areaUrl = site_url('garamGudang/');
        
        $this->load->model([
            'garamGudangModel',
			'mKualitasModel',
			'mGudangModel'
        ]);

        // $this->cekGroup(1);

    }

    public function index()
    {
    }

    

}

/* End of file GaramGudang.php */
/* Location: ./application/controllers/GaramGudang.php */