<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MKualitas extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Kualitas';
        $this->areaUrl = site_url('mKualitas/');
        
        $this->load->model([
            'mKualitasModel',
            'garamGudangModel',
            'mGudangModel'
        ]);
        $this->cekGroup(1);

    }

    public function index()
    {
        $this->template('MKualitas/vList');
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

        $t = $this->mKualitasModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_kualitas;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					btnRead($id, $d->nama_kualitas),
                    btnEditTable($id)
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function read($id=null)
    {
        $row = $this->mKualitasModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('MKualitas/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $this->template('MKualitas/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('nama_kualitas','nama kualitas','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_kualitas' => $this->input->post('nama_kualitas'),
                    );
            if ($id = $this->mKualitasModel->insert($data))
            {

                $gudangs = $this->mGudangModel->get_all();
                if ( $gudangs )
                {
                    foreach ( $gudangs as $g)
                    {
                        $garamGudang[] = array('gudang_id'=>$g->id_gudang, 'kualitas_id'=>$id);
                    }
                    $this->garamGudangModel->insert($garamGudang);
                }
                $res['url']     = $this->areaUrl;
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }


    public function edit($id = 0)
    {
        $data['action'] = $this->areaUrl.'update';
        $row = $this->mKualitasModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_kualitas'] = $row->id_kualitas;
            $this->template('MKualitas/vEdit',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }   

    public function update()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';

        $id = $this->input->post('id_kualitas');
        $this->form_validation->set_rules('id_kualitas','id kualitas','required');
        $this->form_validation->set_rules('nama_kualitas','nama kualitas','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_kualitas' => $this->input->post('nama_kualitas'),
                    );

            $row = $this->mKualitasModel->get($id);
            if ($row) 
            {
                if ($this->mKualitasModel->update($data, $id))
                {
                    
                    $res['url']     = $this->areaUrl;
                    $res['success'] = true;
                    $res['message'] = 'Ubah data berhasil';
                }
            } 
            else 
            {
                $res['success'] = false;
                $res['message'] = 'Data tidak ditemukan';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    } 


    public function destroy()
    {
        $ids = $this->input->post('id[]');
        foreach ($ids as $id) 
        {
            $row = $this->mKualitasModel->get($id);

            if ($row) {
                $this->mKualitasModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file MKualitas.php */
/* Location: ./application/controllers/MKualitas.php */