<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class GaramMutasi extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Mutasi Transaksi';
        $this->areaUrl = site_url('garamMutasi/');
        
        $this->load->model([
            'garamMutasiModel',
            'garamGudangModel',
			'mKantorModel'
            
        ]);
    }

    public function index()
    {
        $garamgudang_id = $this->input->get('gudang-garam');
        $garamgudang = $this->garamGudangModel->with_mGudang()->with_mKualitas()->where('id_garam_gudang', $garamgudang_id)->get();

        if ( $garamgudang )
        {
            $data['row'] = $garamgudang;
            $data['kantor'] = $this->mKantorModel->with_mWilayah('fields:nama_wilayah')->get($garamgudang->mGudang->kantor_id);
            
            $this->cek_wilayah($data['kantor']->wilayah_id);

        }
        else
        {
            // redirect(site_url('mKantor'));
        }
        $this->template('GaramMutasi/vList', $data);
    }

    public function getDatatable()
    {
        $customActionName = $this->input->post('customActionName');
        $records          = array();

        if ($customActionName == "destroy") 
        {
            $records=$this->destroy();
        }

        $records["data"] = array();

        $t = $this->garamMutasiModel->getData();
        $i = $this->input->get_post('start') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_garam_mutasi;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $i++,
					id_date($d->created_at),
					$d->tipe,
					idr($d->jumlah),
					// $d->referensi_id,
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $garamgudang = $this->garamGudangModel->fields('stok')->where('id_garam_gudang', $this->input->post('garam-gudang-id'))->get();
        $records["stok"]            = idr($garamgudang->stok);

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }


}

/* End of file GaramMutasi.php */
/* Location: ./application/controllers/GaramMutasi.php */