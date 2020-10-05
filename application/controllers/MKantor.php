<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MKantor extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Kantor';
        $this->areaUrl = site_url('mKantor/');
        
        $this->load->model([
            'mKantorModel',
            'mWilayahModel',
            'mGudangModel',
            'garamGudangModel'
        ]);

        if ( $this->group_id == 2 )
        {
            $this->create = false;
            $this->edit = false;
            $this->destroy = false;
        }
    }

    public function index()
    {
        if ( $this->group_id == 1 )
        {
            $data['wilayahs'] = $this->mWilayahModel->get_all();
        }
        else if ( $this->group_id == 2 )
        {
            $data['wilayahs'] = $this->mWilayahModel->where('id_wilayah', $this->wilayah_id)->get_all();
        }
        else 
        {
            $data['wilayahs'] = $this->mWilayahModel->where('id_wilayah', $this->wilayah_id)->get_all();
        }
        $this->template('MKantor/vList', $data);
    }

    public function read($id=null)
    {
        $row = $this->mKantorModel->get($id);

        if ($row) 
        {
            $this->cek_wilayah($row->wilayah_id);
            
            $data['row'] = $row;

            if ($this->group_id == 4) {
                $wilayah = $this->ion_auth_model->get_users_wilayah($this->jwt->user_id)->row();
                $data['gudangs'] = $this->mGudangModel->where('id_gudang', $wilayah->gudang_id)->get_all();
            } else {
                $data['gudangs'] = $this->mGudangModel->where('kantor_id', $id)->get_all();
            }
            
            $this->template('MKantor/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    

    public function create()
    {
        $this->cek_create();
        
        $data['action']    = $this->areaUrl.'store';
        $data['wilayah_dd'] = $this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
        $this->template('MKantor/vCreate',$data);
    }

    public function store()
    {
        $this->cek_create();

        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('nama_kantor','nama kantor','trim|required');
        $this->form_validation->set_rules('wilayah_id','wilayah id','trim|required|integer');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_kantor' => $this->input->post('nama_kantor'),
                        'wilayah_id' => $this->input->post('wilayah_id'),
                    );
            if ($this->mKantorModel->insert($data))
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
        $this->cek_edit();

        $data['action'] = $this->areaUrl.'update';
        $row = $this->mKantorModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['wilayah_dd'] = $this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
            $data['id_kantor'] = $row->id_kantor;
            $this->template('MKantor/vEdit',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }   

    public function update()
    {
        $this->cek_edit();
        
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';

        $id = $this->input->post('id_kantor');
        $this->form_validation->set_rules('id_kantor','id kantor','required');
        $this->form_validation->set_rules('nama_kantor','nama kantor','trim|required');
        $this->form_validation->set_rules('wilayah_id','wilayah id','trim|required|integer');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_kantor' => $this->input->post('nama_kantor'),
                        'wilayah_id' => $this->input->post('wilayah_id'),
                    );

            $row = $this->mKantorModel->get($id);
            if ($row) 
            {
                $this->mKantorModel->update($data, $id);
                $res['url']     = $this->areaUrl.'read/'.$id;
                $res['success'] = true;
                $res['message'] = 'Ubah data berhasil';
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
        $this->cek_destroy();

        $id = $this->input->post('id_kantor');
        $row = $this->mKantorModel->where('id_kantor', $id)->get();

        if ($row) 
        {
            $this->mKantorModel->delete($row->id_kantor);

            $res['success'] = true;
            $res['message'] = 'Kantor berhasil dihapus';
        } 
        else 
        {
            $res['success'] = false;
            $res['message'] = 'Data tidak ditemukan';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($res));

    }
    

}

/* End of file MKantor.php */
/* Location: ./application/controllers/MKantor.php */