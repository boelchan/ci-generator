<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GaramGudangModel extends MY_Model
{
    public $table       = 'garam_gudang';
    public $primary_key = 'id_garam_gudang';
    public $label       = 'id_garam_gudang';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_garam_gudang'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
        $this->has_one['mKualitas'] = array('mKualitasModel','id_kualitas','kualitas_id');
        $this->has_one['mGudang'] = array('mGudangModel','id_gudang','gudang_id');
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
        $dataOrder[$i++] = 'gudang_id';
        $dataOrder[$i++] = 'kualitas_id';
        $dataOrder[$i++] = 'tonase'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('gudang_id')) )
        {
            $where[] = " gudang_id = ". $this->input->post('gudang_id');
        }
        if( !empty($this->input->post('kualitas_id')) )
        {
            $where[] = " kualitas_id = ". $this->input->post('kualitas_id');
        }
        if( !empty($this->input->post('tonase')) )
        {
            $where[] = " LOWER(tonase) LIKE '%".strtolower($this->input->post('tonase'))."%'";
        }

        $q .= "
    		LEFT JOIN m_kualitas ON kualitas_id = id_kualitas
    		LEFT JOIN m_gudang ON gudang_id = id_gudang ";

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

/* End of file GaramGudangModel.php */
/* Location: ./application/models/GaramGudangModel.php */