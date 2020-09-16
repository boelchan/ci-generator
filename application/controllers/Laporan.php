<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->title   = 'Laporan';
        $this->areaUrl = site_url('Laporan/');
        
        $this->load->model([
			'mWilayahModel',
			'mKantorModel',
			'mGudangModel',
			'garamGudangModel',
			'pemasukanModel',
			'pengeluaranModel',
			'mKualitasModel',
			'pageModel',
        ]);

        $this->load->library('tcpdf');

        $this->cekGroup(1);
        


    }

    public function index()
    {

    }

    public function pemasukan()
    {
        $this->title   = 'Laporan Pemasukan';

        $data['wilayah_dd']  = ['' => 'Pilih']+$this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
        $data['kualitas_dd'] = ['' => 'Pilih']+$this->mKualitasModel->as_dropdown('nama_kualitas')->get_all();
        $data['no_spjgs']    = $this->pemasukanModel->fields('no_spjg')->group_by('no_spjg')->get_all();

        $tahun_arr = array();
        for ($i=date('Y'); $i >= 2018 ; $i--) 
        { 
            $tahun_arr[$i] = $i;
        }

        $data['tahun_dd'] = $tahun_arr;
        
        $this->template('Laporan/pemasukan', $data);
    }

    public function pengeluaran()
    {
        $this->title   = 'Laporan Pengeluaran';

        $data['wilayah_dd']  = ['' => 'Pilih']+$this->mWilayahModel->as_dropdown('nama_wilayah')->get_all();
        $data['kualitas_dd'] = ['' => 'Pilih']+$this->mKualitasModel->as_dropdown('nama_kualitas')->get_all();
        $data['tujuans']     = $this->pengeluaranModel->fields('tujuan')->group_by('tujuan')->get_all();
        $data['no_spjgs']    = $this->pengeluaranModel->fields('no_spjg')->group_by('no_spjg')->get_all();

        $tahun_arr = array();
        for ($i=date('Y'); $i >= 2018 ; $i--) 
        { 
            $tahun_arr[$i] = $i;
        }

        $data['tahun_dd'] = $tahun_arr;
        $this->template('Laporan/pengeluaran', $data);
    }

    public function getKantor()
    {
        $res['success'] = false;
        
        $wilayah_id = $this->input->post('id');
        $kantors = $this->mKantorModel->where('wilayah_id', $wilayah_id)->get_all();
        
        if ( $kantors )
        {
            foreach ( $kantors  as $k)
            {
                $kantor[] = array('id'=>$k->id_kantor, 'nama'=>$k->nama_kantor);
            }

            $res = $kantor;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        
    }

    public function getGudang()
    {
        $res['success'] = false;
        
        $kantor_id = $this->input->post('id');
        $gudangs = $this->mGudangModel->where('kantor_id', $kantor_id)->get_all();
        
        if ( $gudangs )
        {
            foreach ( $gudangs  as $k)
            {
                $gudang[] = array('id'=>$k->id_gudang, 'nama'=>$k->nama_gudang);
            }

            $res = $gudang;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        
    }


    public function cetak_pdf_pemasukan()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $nama_perusahaan = $this->pageModel->get_nama_perusahaan();

        $kua = $this->input->get('kualitas');
        $kual = $this->mKualitasModel->fields('nama_kualitas')->get($kua);
        $kualitas = @$kual->nama_kualitas;

        if ( $this->input->get('kantor') != '' )
        {
            if ( $this->input->get('kantor') != 0 ) $this->db->where('kantor_id', $this->input->get('kantor'));
        } 
        if ( $this->input->get('gudang') != '' )
        {
            if ( $this->input->get('gudang') != 0 ) $this->db->where('gudang_id', $this->input->get('gudang'));
        } 
        if ( $this->input->get('no_spjg') != '' )
        {
            if ( $this->input->get('no_spjg') != 0 ) $this->db->where('no_spjg', $this->input->get('no_spjg'));
        } 

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ODHE-R');
        $pdf->SetTitle('Rekapitulasi pemasukan garam');
        $pdf->SetSubject('TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $pdf->SetMargins(5, PDF_MARGIN_TOP, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        
        // ---------------------------------------------------------
        
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 9, '', true);
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('L', 'F4');
        
        // set text shadow effect
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        
        // Set some content to print

        $header = <<<EOD
        <table cellspacing="0" cellpadding="1" border="0" style="text-align:center" >
            <tr>
                <td> $nama_perusahaan </td>
            </tr>                
            <tr>
                <td>REKAPITULASI PEMASUKAN GARAM </td>
            </tr>
            <tr>
                <td>Kualitas $kualitas </td>
            </tr>

        </table>
EOD;
        $pdf->writeHTML($header, true, false, false, false, '');


        $q = $this->db->select('tanggal,no_spjg,nama_wilayah,nama_kantor,nama_gudang,tonase')
                            ->join('garam_gudang', 'garam_gudang_id=id_garam_gudang')
                            ->join('m_gudang', 'gudang_id=id_gudang')
                            ->join('m_kantor', 'kantor_id=id_kantor')
                            ->join('m_wilayah', 'wilayah_id=id_wilayah')
                            ->where('wilayah_id', $this->input->get('wilayah'))
                            ->where('kualitas_id', $this->input->get('kualitas'))
                            ->where('tanggal >=', sys_date($this->input->get('from')).' 00:01:01')
                            ->where('tanggal <=', sys_date($this->input->get('to')).' 23:59:59')
                            ->order_by('tanggal', 'asc')
                            ->get('pemasukan');
        $tabel_isi = '';
        $i = 1;
        $total_tonase = 0;
        foreach ($q->result() as $d) {
            $tabel_isi .= "<tr>
                <td width=\"5%\" style=\"text-align:center\">". $i++. "</td>
                <td width=\"10%\" style=\"text-align:center\">". id_date(substr($d->tanggal, 0,10)) ."</td>
                <td width=\"20%\" >". $d->no_spjg ."</td>
                <td width=\"17%\" >". $d->nama_wilayah ."</td>
                <td width=\"17%\" >". $d->nama_kantor ."</td>
                <td width=\"17%\" >". $d->nama_gudang ."</td>
                <td width=\"15%\" style=\"text-align:right\">". idr($d->tonase) ."</td>
            </tr>";
            
            $total_tonase += $d->tonase;
        }
        $total_tonase = idr($total_tonase);

        $html = <<<EOD
        <table cellspacing="0" cellpadding="1" border="1" >
        <thead>
            <tr style="text-align:center">
                <td width="5%" >NO</td>
                <td width="10%" >TANGGAL</td>
                <td width="20%" >NOMER D.O</td>
                <td width="17%" >WILAYAH</td>
                <td width="17%" >KANTOR</td>
                <td width="17%" >GUDANG</td>
                <td width="15%" >TONASE</td>
            </tr>
        </thead>
        <tbody>
            $tabel_isi
            <tr>
                <td colspan="6" style="text-align:center">TOTAL</td>
                <td style="text-align:right">$total_tonase</td>
            </tr>
        </tbody>
    </table>
EOD;
        
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        // ---------------------------------------------------------
        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('rekap-pemasukan.pdf', 'I');

    }

    public function cetak_pdf_pengeluaran()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $nama_perusahaan = $this->pageModel->get_nama_perusahaan();
        
        $kua = $this->input->get('kualitas');
        $kual = $this->mKualitasModel->fields('nama_kualitas')->get($kua);
        $kualitas = @$kual->nama_kualitas;

        if ( $this->input->get('kantor') != '' )
        {
            if ( $this->input->get('kantor') != 0 ) $this->db->where('kantor_id', $this->input->get('kantor'));
        } 
        if ( $this->input->get('gudang') != '' )
        {
            if ( $this->input->get('gudang') != 0 ) $this->db->where('gudang_id', $this->input->get('gudang'));
        } 
        if ( $this->input->get('no_spjg') != '' )
        {
            if ( $this->input->get('no_spjg') != 0 ) $this->db->where('no_spjg', $this->input->get('no_spjg'));
        } 

    
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ODHE-R');
        $pdf->SetTitle('Rekapitulasi Pengambilan garam');
        $pdf->SetSubject('TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $pdf->SetMargins(5, PDF_MARGIN_TOP, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        
        // ---------------------------------------------------------
        
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 9, '', true);
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('L', 'F4');
        
        // set text shadow effect
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        
        // Set some content to print

        $header = <<<EOD
        <table cellspacing="0" cellpadding="1" border="0" style="text-align:center" >
            <tr>
                <td> $nama_perusahaan </td>
            </tr>                
            <tr>
                <td>REKAPITULASI PENGAMBILAN GARAM </td>
            </tr>
            <tr>
                <td>Kualitas $kualitas </td>
            </tr>

        </table>
EOD;
        $pdf->writeHTML($header, true, false, false, false, '');

        
        if ( $this->input->get('tujuan') != '' )
        {
            $this->db->where('tujuan', $this->input->get('tujuan'));
        }
        $q = $this->db->select('tanggal,no_spjg,nama_wilayah,nama_kantor,nama_gudang,nopol,jumlah_karung,tonase,hasil_timbang,tujuan')
                            ->join('garam_gudang', 'garam_gudang_id=id_garam_gudang')
                            ->join('m_gudang', 'gudang_id=id_gudang')
                            ->join('m_kantor', 'kantor_id=id_kantor')
                            ->join('m_wilayah', 'wilayah_id=id_wilayah')
                            ->where('wilayah_id', $this->input->get('wilayah'))
                            ->where('kualitas_id', $this->input->get('kualitas'))
                            ->where('tanggal >=', sys_date($this->input->get('from')).' 00:01:01')
                            ->where('tanggal <=', sys_date($this->input->get('to')).' 23:59:59')
                            ->order_by('tanggal', 'asc')
                            ->get('pengeluaran');
        $tabel_isi = '';
        $i = 1;
        $total_timbang = 0;
        $total_tonase = 0;
        foreach ($q->result() as $d) {
            $tabel_isi .= "<tr>
                <td width=\"5%\" style=\"text-align:center\">". $i++. "</td>
                <td width=\"7%\" style=\"text-align:center\">". id_date(substr($d->tanggal, 0,10)) ."</td>
                <td width=\"11%\">". $d->no_spjg ."</td>
                <td width=\"7%\">". $d->nama_wilayah ."</td>
                <td width=\"16%\">". $d->nama_kantor ."</td>
                <td width=\"12%\">". $d->nama_gudang ."</td>
                <td width=\"7%\"> ".$d->nopol ."</td>
                <td width=\"5%\" style=\"text-align:right\"> ".idr($d->jumlah_karung) ."</td>
                <td width=\"10%\" style=\"text-align:right\"> ". idr($d->tonase) ."</td>
                <td width=\"10%\" style=\"text-align:right\"> ".idr($d->hasil_timbang) ."</td>
                <td width=\"10%\"> ".$d->tujuan ."</td>
            </tr>";
            $total_tonase += $d->tonase;
            $total_timbang += $d->hasil_timbang;
        }
        $total_timbang = idr($total_timbang);
        $total_tonase = idr($total_tonase);


        $html = <<<EOD
        <table cellspacing="0" cellpadding="1" border="1" >
        <thead>
            <tr style="text-align:center">
                <td width="5%" >NO</td>
                <td width="7%" >TANGGAL</td>
                <td width="11%" >NOMER D.O</td>
                <td width="7%" >WILAYAH</td>
                <td width="16%" >KANTOR</td>
                <td width="12%" >GUDANG</td>
                <td width="7%">NOPOL</td>
                <td width="5%">JUMLAH KARUNG</td>
                <td width="10%">TONASE</td>
                <td width="10%">HASIL TIMBANG</td>
                <td width="10%">TUJUAN</td>
            </tr>
        </thead>
        <tbody>
            $tabel_isi
            <tr>
                <td colspan="8" style="text-align:center">TOTAL</td>
                <td style="text-align:right">$total_tonase</td>
                <td style="text-align:right">$total_timbang</td>
                <td></td>
            </tr>
        </tbody>
    </table>
EOD;
        
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        // ---------------------------------------------------------
        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('rekap-pengeluaran.pdf', 'I');
        
    }

   

    

}

/* End of file GaramGudang.php */
/* Location: ./application/controllers/GaramGudang.php */