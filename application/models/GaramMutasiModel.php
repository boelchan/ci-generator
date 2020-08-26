<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GaramMutasiModel extends MY_Model
{
    public $table       = 'garam_mutasi';
    public $primary_key = 'id_garam_mutasi';
    public $label       = 'id_garam_mutasi';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_garam_mutasi'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
        $this->has_one['garamGudang'] = array('garamGudangModel','id_garam_gudang','garam_gudang_id');
    }
    
    // get dataTable
    function getData() 
    {
        $order  = $this->input->post('order');
        $length = $this->input->post('length');
        $start  = $this->input->post('start');

        $result['draw'] = $this->input->post('draw');
        
        $dataOrder = array();
        $where     = array();

        $i = 0;
        $dataOrder[$i++] = $this->primary_key;
        $dataOrder[$i++] = 'created_at';
        $dataOrder[$i++] = 'tipe';
        $dataOrder[$i++] = 'jumlah';
        $dataOrder[$i++] = 'saldo';
        $dataOrder[$i++] = 'referensi_id'; 

        $q = "SELECT * FROM $this->table ";
        
        $where[] = " garam_gudang_id = ". $this->input->post('garam-gudang-id');
        
        if( !empty($this->input->post('tipe')) )
        {
            $where[] = " LOWER(tipe) LIKE '%".strtolower($this->input->post('tipe'))."%'";
        }
        if( !empty($this->input->post('jumlah')) )
        {
            $where[] = " LOWER(jumlah) LIKE '%".strtolower($this->input->post('jumlah'))."%'";
        }
        if( !empty($this->input->post('saldo')) )
        {
            $where[] = " LOWER(saldo) LIKE '%".strtolower($this->input->post('saldo'))."%'";
        }
        if( !empty($this->input->post('referensi_id')) )
        {
            $where[] = " LOWER(referensi_id) LIKE '%".strtolower($this->input->post('referensi_id'))."%'";
        }

        // $q .= " LEFT JOIN garam_gudang ON garam_gudang_id = id_garam_gudang ";

        if ( count($where) > 0 ) 
        {
            $where = implode(' AND ', $where);
            $q .= " WHERE $where"; 
        }

        $result['total_rows'] = $this->db->query($q)->num_rows();

        if ($order)
        {
            $q .= " ORDER BY ". $dataOrder[$order[0]['column']] ." ". $order[0]['dir'];
        }
        else
        {
            $q .= " ORDER BY created_at DESC ";
        }

        $q .= " LIMIT $start , $length ";

        $result['rows'] = $this->db->query($q)->result();

        return $result;
    }

}

/* End of file GaramMutasiModel.php */
/* Location: ./application/models/GaramMutasiModel.php */