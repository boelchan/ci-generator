<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SisaDOModel extends MY_Model
{
    public $table       = 'v_sisa_do';
    public $primary_key = '';
    public $label       = 'no_spjg';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array(''); // ...Or you can set an array with the fields that cannot be filled by insert/update

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
        $dataOrder[$i++] = 'no_spjg';
        $dataOrder[$i++] = 'pemasukan';
        $dataOrder[$i++] = 'pengeluaran';
        $dataOrder[$i++] = 'sisa'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('no_spjg')) )
        {
            $where[] = " LOWER(no_spjg) LIKE '%".strtolower($this->input->post('no_spjg'))."%'";
        }
        if( !empty($this->input->post('pemasukan')) )
        {
            $where[] = " LOWER(pemasukan) LIKE '%".strtolower($this->input->post('pemasukan'))."%'";
        }
        if( !empty($this->input->post('pengeluaran')) )
        {
            $where[] = " LOWER(pengeluaran) LIKE '%".strtolower($this->input->post('pengeluaran'))."%'";
        }
        if( !empty($this->input->post('sisa')) )
        {
            $where[] = " LOWER(sisa) LIKE '%".strtolower($this->input->post('sisa'))."%'";
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

/* End of file SisaDOModel.php */
/* Location: ./application/models/SisaDOModel.php */