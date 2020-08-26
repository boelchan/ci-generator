<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MWilayahModel extends MY_Model
{
    public $table       = 'm_wilayah';
    public $primary_key = 'id_wilayah';
    public $label       = 'nama_wilayah';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_wilayah'); // ...Or you can set an array with the fields that cannot be filled by insert/update

    function __construct()
    {
        parent::__construct();
        $this->soft_deletes = FALSE;
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
        $dataOrder[$i++] = 'nama_wilayah'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('nama_wilayah')) )
        {
            $where[] = " LOWER(nama_wilayah) LIKE '%".strtolower($this->input->post('nama_wilayah'))."%'";
        }

        $q .= " ";

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

/* End of file MWilayahModel.php */
/* Location: ./application/models/MWilayahModel.php */