<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pemasukan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Pemasukan';
        $this->areaUrl = site_url('pemasukan/');
        
        $this->load->model([
            'pemasukanModel',
			'garamGudangModel',
			'mKantorModel'
        ]);

        if ( $this->group_id == 2 )
        {
            if ( $this->wilayah_id != 3 )
            {
                $this->ion_auth->logout();
                redirect('auth/login', 'refresh');
            }            
        }
        // $this->cekGroup(1);

    }

    public function index()
    {
        $data['action']    = $this->areaUrl.'store';

        $garamgudang_id = $this->input->get('gudang-garam');
        $garamgudang = $this->garamGudangModel->with_mGudang()->with_mKualitas()->where('id_garam_gudang', $garamgudang_id)->get();

        if ( $garamgudang )
        {
            $data['row'] = $garamgudang;
            $data['kantor'] = $this->mKantorModel->with_mWilayah('fields:nama_wilayah')->get($garamgudang->mGudang->kantor_id);
        }
        else
        {
            // redirect(site_url('mKantor'));
        }

        $this->template('Pemasukan/vList', $data);
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

        $t = $this->pemasukanModel->getData($this->input->post('garam-gudang-id'));
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_pemasukan;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $checkbox,
					id_date(substr($d->tanggal, 0,10)),
					$d->no_spjg,
					idr($d->tonase),
                    btnEditTable($id)
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

    public function getRekapDatatable()
    {
        $customActionName = $this->input->post('customActionName');
        $records          = array();

        if ($customActionName == "destroy") 
        {
            $records=$this->destroy();
        }

        $records["data"] = array();

        $t = $this->pemasukanModel->getRekapData();
        $i = $this->input->get_post('start') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id_pemasukan;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $records["data"][] = array(
                    $i++,
					id_date(substr($d->tanggal, 0,10)),
					$d->no_spjg,
					$d->nama_wilayah,
					$d->nama_kantor,
					$d->nama_gudang,
					$d->nama_kualitas,
					idr($d->tonase)
                );
            }
        }
        $records["draw"]            = $t['draw'];
        $records["recordsTotal"]    = $t['total_rows'];
        $records["recordsFiltered"] = $t['total_rows'];

        $records["total_tonase"]    = idr($t['total']->tonase);

        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }


    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';
        
        $this->form_validation->set_rules('tanggal','tanggal','trim|required');
        $this->form_validation->set_rules('no_spjg','no spjg','trim|required');
        $this->form_validation->set_rules('garam_gudang_id','garam gudang id','trim|required|integer');
        $this->form_validation->set_rules('tonase','tonase','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'tanggal' => sys_date($this->input->post('tanggal')).' '.date('H:i:s'),
                        'no_spjg' => $this->input->post('no_spjg'),
                        'garam_gudang_id' => $this->input->post('garam_gudang_id'),
                        'tonase' => $this->input->post('tonase'),
                    );
            if ($this->pemasukanModel->insert($data))
            {
                // $res['url']     = $this->areaUrl;
                $res['success'] = true;
                $res['message'] = 'Tambah data berhasil';
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

        
    public function edit($id = 0)
    {
        $data['action'] = $this->areaUrl.'update';
        $row = $this->pemasukanModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $data['id_pemasukan'] = $row->id_pemasukan;

            $data['garamgudang'] = $this->garamGudangModel->with_mGudang()->with_mKualitas()->where('id_garam_gudang', $row->garam_gudang_id)->get();

            $data['kantor'] = $this->mKantorModel->with_mWilayah('fields:nama_wilayah')->get($data['garamgudang']->mGudang->kantor_id);

            $this->cek_wilayah($data['kantor']->wilayah_id);

            $this->template('Pemasukan/vEdit',$data);
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
        
        $this->form_validation->set_rules('id_pemasukan','id_pemasukan','trim|required');
        $this->form_validation->set_rules('tanggal','tanggal','trim|required');
        $this->form_validation->set_rules('no_spjg','no spjg','trim|required');
        $this->form_validation->set_rules('tonase','tonase','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'tanggal' => sys_date($this->input->post('tanggal')).' '.date('H:i:s'),
                        'no_spjg' => $this->input->post('no_spjg'),
                        'tonase' => $this->input->post('tonase'),
                    );

            $id = $this->input->post('id_pemasukan');

            if ( $d = $this->pemasukanModel->get($id) )
            {
                $garamgudang = $this->garamGudangModel->with_mGudang()->with_mKualitas()->where('id_garam_gudang', $d->garam_gudang_id)->get();
    
                $kantor = $this->mKantorModel->with_mWilayah('fields:nama_wilayah')->get($garamgudang->mGudang->kantor_id);
            
                $this->cek_wilayah($kantor->wilayah_id);
                
    
                $this->pemasukanModel->update($data, $id);
                
                $res['url']     = site_url('pemasukan?gudang-garam='.$d->garam_gudang_id);
                $res['success'] = true;
                $res['message'] = 'Ubah data berhasil';
                
            }

        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }



    public function destroy()
    {
        $ids = $this->input->post('id[]');
        foreach ($ids as $id) 
        {
            $row = $this->pemasukanModel->get($id);

            if ($row) {
                $this->pemasukanModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */