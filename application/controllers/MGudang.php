<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MGudang extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Gudang';
        $this->areaUrl = site_url('mGudang/');
        
        $this->load->model([
            'mGudangModel',
			'mKantorModel',
			'garamGudangModel',
			'mKualitasModel'
        ]);

        $this->cekGroup(1);
    }

    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $data['kantor_dd'] = $this->mKantorModel->as_dropdown('nama_kantor')->get_all();
        $this->template('MGudang/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('nama_gudang','nama gudang','trim|required');
        $this->form_validation->set_rules('kantor_id','kantor id','trim|required|integer');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_gudang' => $this->input->post('nama_gudang'),
                        'kantor_id' => $this->input->post('kantor_id'),
                    );
            if ($id = $this->mGudangModel->insert($data))
            {
                $kualitas = $this->mKualitasModel->get_all();
                if ( $kualitas )
                {
                    $data_kualitas = array();
                    foreach ( $kualitas as $kua)
                    {
                        $data_kualitas[] = array('gudang_id' => $id, 'kualitas_id'=> $kua->id_kualitas);
                    }
                    $this->garamGudangModel->insert($data_kualitas);
                }

                $res['url']     = site_url('mKantor/read/'.$this->input->post('kantor_id'));
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }


    public function edit($id = 0)
    {
        $data['action'] = $this->areaUrl.'update';
        $row = $this->mGudangModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_gudang'] = $row->id_gudang;
            $data['kantor_dd'] = $this->mKantorModel->as_dropdown('nama_kantor')->get_all();
            $this->template('MGudang/vEdit',$data);
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

        $id = $this->input->post('id_gudang');
        $this->form_validation->set_rules('id_gudang','id gudang','required');
        $this->form_validation->set_rules('nama_gudang','nama gudang','trim|required');
        $this->form_validation->set_rules('kantor_id','kantor id','trim|required|integer');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'nama_gudang' => $this->input->post('nama_gudang'),
                        'kantor_id' => $this->input->post('kantor_id'),
                    );

            $row = $this->mGudangModel->get($id);
            if ($row) 
            {
                $this->mGudangModel->update($data, $id);
                $res['url']     = site_url('mKantor/read/'. $this->input->post('kantor_id'));
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
        $id = $this->input->post('id_gudang');
        $row = $this->mGudangModel->where('id_gudang', $id)->get();

        if ($row) 
        {
            $this->mGudangModel->delete($row->id_gudang);

            $res['success'] = true;
            $res['message'] = 'gudang berhasil dihapus';
        } 
        else 
        {
            $res['success'] = false;
            $res['message'] = 'Data tidak ditemukan';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
    

}

/* End of file MGudang.php */
/* Location: ./application/controllers/MGudang.php */