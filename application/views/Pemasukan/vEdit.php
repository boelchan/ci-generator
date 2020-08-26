<div class='row'>
    <div class='col-md-4'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack(site_url('pemasukan?gudang-garam='.$row->garam_gudang_id), '') ?>
                    <a href="<?php echo site_url('pengeluaran?gudang-garam='.$row->garam_gudang_id) ?>" class="btn btn-outline btn-circle yellow" id="kurang" title="pengeluaran"><i class="fa fa-arrow-up "></i> Tambah Pengeluaran</a>
                    <a href="<?php echo site_url('garamMutasi?gudang-garam='.$row->garam_gudang_id) ?>" class="btn btn-outline btn-circle purple" id="mutasi" title="mutasi"><i class="fa fa-exchange "></i> Mutasi</a>

                </div>
            </div>
            <div class='portlet-body form'>
                <div class='row'>
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <td width="10%">Wilayah</td>
                                <td><?php echo $kantor->mWilayah->nama_wilayah ?></td>
                            </tr>
                            <tr>
                                <td>Kantor</td>
                                <td><?php echo $kantor->nama_kantor ?></td>
                            </tr>
                            <tr>
                                <td>Gudang</td>
                                <td><?php echo $garamgudang->mGudang->nama_gudang ?></td>
                            </tr>
                            <tr>
                                <td>Kualitas</td>
                                <td><?php echo $garamgudang->mKualitas->nama_kualitas ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-8'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <span class="caption-subject font-dark sbold">Edit Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?php echo form_open($action, 'id="input-form" class="form-horizontal"'); ?>

                    <div class='form-body'> 
                        <input type="hidden" name="id_pemasukan" value="<?php echo $row->id_pemasukan ?>">

                        <div class='row'>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tanggal <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <div class='input-group date date-picker' >
                                            <span class='input-group-btn'>
                                                <button class='btn default' type='button'>
                                                    <i class='fa fa-calendar'></i> </button>
                                            </span>
                                            <input type='text' class='form-control ' readonly name="tanggal" value="<?php echo id_date(substr($row->tanggal, 0,10)) ?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Nomer D.O <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="text" class="form-control" name="no_spjg" id="no_spjg" placeholder="Nomer D.O" value="<?php echo $row->no_spjg ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tonase <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="number" class="form-control" name="tonase" id="tonase" placeholder="Tonase" value="<?php echo $row->tonase ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
              
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-3 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline'>Simpan Data Baru</button>
                            </div>
                        </div>
                    </div>
                        
                <?php echo form_close() ?>
                
            </div>
        </div>
    </div>
</div> 
