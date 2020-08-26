<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PengeluaranModel extends MY_Model
{
    public $table       = 'pengeluaran';
    public $primary_key = 'id_pengeluaran';
    public $label       = 'no_spjg';
    public $fillable    = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected   = array('id_pengeluaran'); // ...Or you can set an array with the fields that cannot be filled by insert/update

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
        $dataOrder[$i++] = 'tanggal';
        $dataOrder[$i++] = 'no_spjg';
        $dataOrder[$i++] = 'nopol';
        $dataOrder[$i++] = 'tonase';
        $dataOrder[$i++] = 'hasil_timbang';
        $dataOrder[$i++] = 'jumlah_karung';
        $dataOrder[$i++] = 'tujuan'; 

        $q = "SELECT * FROM $this->table ";
        
        if( !empty($this->input->post('tanggal')) )
        {
            $where[] = " LOWER(tanggal) LIKE '%".strtolower($this->input->post('tanggal'))."%'";
        }
        if( !empty($this->input->post('no_spjg')) )
        {
            $where[] = " LOWER(no_spjg) LIKE '%".strtolower($this->input->post('no_spjg'))."%'";
        }
        if( !empty($this->input->post('nopol')) )
        {
            $where[] = " LOWER(nopol) LIKE '%".strtolower($this->input->post('nopol'))."%'";
        }
        
        $where[] = " garam_gudang_id = ". $this->input->post('garam-gudang-id');
        
        if( !empty($this->input->post('tonase')) )
        {
            $where[] = " LOWER(tonase) LIKE '%".strtolower($this->input->post('tonase'))."%'";
        }
        if( !empty($this->input->post('hasil_timbang')) )
        {
            $where[] = " LOWER(hasil_timbang) LIKE '%".strtolower($this->input->post('hasil_timbang'))."%'";
        }
        if( !empty($this->input->post('jumlah_karung')) )
        {
            $where[] = " LOWER(jumlah_karung) LIKE '%".strtolower($this->input->post('jumlah_karung'))."%'";
        }
        if( !empty($this->input->post('tujuan')) )
        {
            $where[] = " LOWER(tujuan) LIKE '%".strtolower($this->input->post('tujuan'))."%'";
        }

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

    
    function getRekapData() 
    {
        $order  = $this->input->post('order');
        $length = $this->input->post('length');
        $start  = $this->input->post('start');

        $result['draw'] = $this->input->post('draw');
        
        $dataOrder = array();
        $where     = array();

        $i = 0;
        $dataOrder[$i++] = $this->primary_key;
        $dataOrder[$i++] = 'tanggal';
        $dataOrder[$i++] = 'no_spjg';
        $dataOrder[$i++] = 'nama_wilayah';
        $dataOrder[$i++] = 'nama_kantor';
        $dataOrder[$i++] = 'nama_gudang';
        $dataOrder[$i++] = 'nama_kualitas';
        $dataOrder[$i++] = 'nopol';
        $dataOrder[$i++] = 'jumlah_karung';
        $dataOrder[$i++] = 'tonase';
        $dataOrder[$i++] = 'hasil_timbang';
        $dataOrder[$i++] = 'tujuan'; 


        $select = "  SELECT $this->table.*, nama_wilayah, nama_kantor, nama_gudang, nama_kualitas 
                FROM $this->table ";
                
        $join = " JOIN garam_gudang ON garam_gudang_id=id_garam_gudang 
                JOIN m_gudang ON gudang_id=id_gudang 
                JOIN m_kantor ON kantor_id=id_kantor 
                JOIN m_wilayah ON wilayah_id=id_wilayah
                JOIN m_kualitas ON kualitas_id=id_kualitas ";
        

        if( !empty($this->input->post('from')) ) $where[] = " tanggal >= '".sys_date($this->input->post('from'))." 00:01:01'";
        if( !empty($this->input->post('to')) ) $where[] = " tanggal <= '".sys_date($this->input->post('to'))." 23:59:59'";
        if( !empty($this->input->post('wilayah')) )  $where[] = " wilayah_id = ".$this->input->post('wilayah');
        if( !empty($this->input->post('kantor')) )  $where[] = " kantor_id = ".$this->input->post('kantor');
        if( !empty($this->input->post('gudang')) )  $where[] = " gudang_id = ".$this->input->post('gudang');
        if( !empty($this->input->post('kualitas')) )  $where[] = " kualitas_id = ".$this->input->post('kualitas');
        if( !empty($this->input->post('tujuan')) )  $where[] = " tujuan like '".$this->input->post('tujuan')."'";
        if( !empty($this->input->post('no_spjg')) )  $where[] = " no_spjg like '".$this->input->post('no_spjg')."'";
        
        if ( count($where) > 0 )
        {
            $where = ' WHERE '.implode(' AND ', $where);
        }
        else
        {
            $where = '';
        }

        $q = $select . $join . $where; 


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


        // total stok, jumlah karung, hasil timbang
        $q2 = " select sum(jumlah_karung) as jumlah_karung, sum(tonase) as tonase, sum(hasil_timbang) as hasil_timbang FROM ". $this->table . $join . $where;         
        $result['total'] = $this->db->query($q2)->row();

        return $result;
    }


}

/* End of file PengeluaranModel.php */
/* Location: ./application/models/PengeluaranModel.php */