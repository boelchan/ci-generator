<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MKantorModel extends MY_Model
{
    public $table       = 'm_kantor';
    public $primary_key = 'id_kantor';
    public $label       = 'nama_kantor';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_kantor'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
        $this->has_one['mWilayah'] = array('mWilayahModel','id_wilayah','wilayah_id');
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
        $dataOrder[$i++] = 'nama_kantor';
        $dataOrder[$i++] = 'wilayah_id'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('nama_kantor')) )
        {
            $where[] = " LOWER(nama_kantor) LIKE '%".strtolower($this->input->post('nama_kantor'))."%'";
        }
        if( !empty($this->input->post('wilayah_id')) )
        {
            $where[] = " wilayah_id = ". $this->input->post('wilayah_id');
        }

        $q .= "
    		LEFT JOIN m_wilayah ON wilayah_id = id_wilayah ";

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

/* End of file MKantorModel.php */
/* Location: ./application/models/MKantorModel.php */