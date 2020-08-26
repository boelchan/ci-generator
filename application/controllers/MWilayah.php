<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MWilayah extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'MWilayah';
        $this->areaUrl = site_url('mWilayah/');
        
        $this->load->model([
            'mWilayahModel'
        ]);

        $this->cekGroup(1);

    }

    public function index()
    {
        $this->template('MWilayah/vList');
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

        $t = $this->mWilayahModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_wilayah;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					btnRead($id, $d->nama_wilayah),
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
        $row = $this->mWilayahModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('MWilayah/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $this->template('MWilayah/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('nama_wilayah','nama wilayah','trim');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_wilayah' => $this->input->post('nama_wilayah'),
                    );
            if ($this->mWilayahModel->insert($data))
            {
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
        $row = $this->mWilayahModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_wilayah'] = $row->id_wilayah;
            $this->template('MWilayah/vEdit',$data);
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

        $id = $this->input->post('id_wilayah');
        $this->form_validation->set_rules('id_wilayah','id wilayah','required');
        $this->form_validation->set_rules('nama_wilayah','nama wilayah','trim');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_wilayah' => $this->input->post('nama_wilayah'),
                    );

            $row = $this->mWilayahModel->get($id);
            if ($row) 
            {
                if ($this->mWilayahModel->update($data, $id))
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
            $row = $this->mWilayahModel->get($id);

            if ($row) {
                $this->mWilayahModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file MWilayah.php */
/* Location: ./application/controllers/MWilayah.php */