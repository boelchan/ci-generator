<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Operator';
        $this->areaUrl = site_url('Users/');
        
        $this->load->model([
            'mWilayahModel','mKantorModel','mGudangModel'
        ]);

        $this->cekGroup(1);
    }

    public function index()
    {
        $this->template('Users/vList');
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

        $t = $this->usersModel->getData();
        $i = $this->input->get_post('length') + 1;

        if ( $t['rows'] ) 
        {
            foreach ($t['rows'] as $d) 
            {
                $id = $d->id;

                $checkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="checkboxes" name="id[]" value="'.$id.'" /> <span></span> </label>';

                $wilayah = $this->ion_auth_model->get_users_wilayah($id)->row();

                $gudang = 'Semua';

                if ( $wilayah->group_id == 4 )
                {
                    $nama_kantor = $this->mKantorModel->fields('nama_kantor')->get(@$wilayah->kantor_id)->nama_kantor;
                    $nama_gudang = $this->mGudangModel->fields('nama_gudang')->get(@$wilayah->gudang_id)->nama_gudang;
                    $gudang = $nama_kantor.' <i class="fa fa-arrow-right"></i> '. $nama_gudang;
                }
                
                $records["data"][] = array(
                    $checkbox,
					$d->first_name,
					btnRead($id, $d->email),
                    ($this->ion_auth_model->get_users_groups($id)->row()->name),
                    $wilayah->nama_wilayah,
                    $gudang,
					(is_null($d->last_login) ? '':date("Y-m-d H:i:s", $d->last_login)),
					($d->active == 1 ? 'Aktif' : 'Tidak Aktif'),
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
        $row = $this->usersModel->get($id);

        if ($row) 
        {
            $data['row'] = $row;
            $this->template('Users/vRead',$data);
        } 
        else 
        {
            show_error('Data tidak ditemukan');
        }
    }    


    public function create()
    {
        $data['action']    = $this->areaUrl.'store';
        $data['opt_group'] = $this->groupsModel->as_dropdown('name')->where('id <> ','1')->get_all();
        $data['opt_wilayah'] = [''=>'pilih']+$this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
        $this->template('Users/vCreate',$data);
    }

    public function store()
    {
        $res['success'] = false;
        $res['message'] = 'Simpan data gagal';

        $this->form_validation->set_message('matches', 'Password harus sama');
        
        $this->form_validation->set_rules('password','password','trim|required');
        $this->form_validation->set_rules('rpassword','password','trim|required|matches[password]');
        $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('active','active','trim|required');
        if ( $this->input->post('group_id')  == 4)
        {
            $this->form_validation->set_rules('kantor_id','kantor','trim|required');
            $this->form_validation->set_rules('gudang_id','gudang','trim|required');
        }
        $this->form_validation->set_rules('first_name','Nama','trim|required');
        $this->form_validation->set_rules('wilayah_id','Wilayah','trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                        'email' => $this->input->post('email'),
                        'active' => $this->input->post('active'),
                        'first_name' => $this->input->post('first_name'),
                    );
                
            $data['password'] = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
            
            if ($id = $this->usersModel->insert($data))
            {
                $data_user_group = array(
                    'user_id' => $id,
                    'group_id' => $this->input->post('group_id'),
                    'wilayah_id' => $this->input->post('wilayah_id'),
                );
                if ( $this->input->post('group_id') == 4 )
                {
                    $data_user_group['kantor_id'] = $this->input->post('kantor_id');
                    $data_user_group['gudang_id'] = $this->input->post('gudang_id');
                }
                $this->usersGroupsModel->insert($data_user_group);
                
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
        $row = $this->usersModel->get($id);

        if ($row) 
        {

            $data['groups'] = $this->ion_auth_model->get_users_wilayah($row->id)->row();

            $data['row'] = $row;
            $data['id']  = $row->id;
            $data['opt_group'] = $this->groupsModel->as_dropdown('name')->where('id <> ','1')->get_all();
            $data['opt_wilayah'] = $this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
            $data['opt_kantor'] = [''=>'Pilih']+$this->mKantorModel->as_dropdown('nama_kantor')->where('wilayah_id', $data['groups']->wilayah_id)->get_all();
            $data['opt_gudang'] = $this->mGudangModel->as_dropdown('nama_gudang')->where('kantor_id', $data['groups']->kantor_id)->get_all();
            $this->template('Users/vEdit',$data);
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
        
        $id = $this->input->post('id');
        
        $original_value = $this->usersModel->get($id)->email;
        if($this->input->post('email') != $original_value) {
           $is_unique =  '|is_unique[users.email]';
        } else {
           $is_unique =  '';
        }
        
        $this->form_validation->set_message('matches', 'Password harus sama');

        $this->form_validation->set_rules('password','password','trim');
        if ($this->input->post('password'))
            $this->form_validation->set_rules('rpassword','password','trim|required|matches[password]');

        $this->form_validation->set_rules('email','email','trim|required|valid_email'.$is_unique);
        $this->form_validation->set_rules('active','active','trim|required');
        $this->form_validation->set_rules('first_name','Nama','trim|required');
        $this->form_validation->set_rules('wilayah_id','wilayah','trim|required');

        if ( $this->input->post('group_id')  == 4)
        {
            $this->form_validation->set_rules('kantor_id','kantor','trim|required');
            $this->form_validation->set_rules('gudang_id','gudang','trim|required');
        }


        if ($this->form_validation->run() == FALSE) 
        {
            $res['message'] = 'Lengkapi inputan dengan benar';
            $res['field_error'] = $this->form_validation->error_array();
        } 
        else 
        {
            $data = array(
                'email' => $this->input->post('email'),
                'active' => $this->input->post('active'),
                'first_name' => $this->input->post('first_name'),
            );

            if ( $this->input->post('password') )
            {
                $data['password'] = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
            }

            $row = $this->usersModel->get($this->input->post('id'));
            if ($row) 
            {
                if ($this->usersModel->update($data, $this->input->post('id')))
                {
                    $data_user_group = array(
                        'user_id' => $id,
                        'group_id' => $this->input->post('group_id'),
                        'wilayah_id' => $this->input->post('wilayah_id'),
                    );
                    if ( $this->input->post('group_id') == 4 )
                    {
                        $data_user_group['kantor_id'] = $this->input->post('kantor_id');
                        $data_user_group['gudang_id'] = $this->input->post('gudang_id');
                    }
                        
                    $this->usersGroupsModel->where('user_id', $id)->delete();
                    $this->usersGroupsModel->insert($data_user_group);
    
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
            $row = $this->usersModel->get($id);

            if ($row) {
                $this->usersModel->delete($id);
            }
        }

        $result["customActionStatus"]  = "OK";
        $result["customActionMessage"] = "Hapus data berhasil";
        
        return $result;
    }
    

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */