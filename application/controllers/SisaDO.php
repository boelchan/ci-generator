<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SisaDO extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Sisa DO';
        $this->areaUrl = site_url('sisaDO/');
        
        $this->load->model([
            'sisaDOModel'
        ]);

        $this->cekGroup(1);
        
    }

    public function index()
    {
        $this->cek_read();
        
        $this->template('SisaDO/vList');
    }

    public function getDatatable()
    {
        $this->cek_read();
        
        $customActionName = $this->input->post('customActionName');
        $records          = array();

        if ($customActionName == "destroy") 
        {
            $records=$this->destroy();
        }

        $records["data"] = array();

        $t = $this->sisaDOModel->getData();
        $i = $this->input->get_post('start') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $records["data"][] = array(
                    $i++,
					$d->no_spjg,
					idr($d->pemasukan),
					idr($d->pengeluaran),
					idr($d->sisa)
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }


}

/* End of file SisaDO.php */
/* Location: ./application/controllers/SisaDO.php */