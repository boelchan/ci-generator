<div class='row'>
    <div class='col-md-4'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack(site_url('pengeluaran?gudang-garam='.$row->garam_gudang_id), '') ?>
                    <?php if ($this->group_id == 1) : ?>
                    <a href="<?php echo site_url('pemasukan?gudang-garam='.$row->garam_gudang_id) ?>" class="btn btn-outline btn-circle green" id="tambah"  title="pemasukan"><i class="fa fa-arrow-down "></i>Tambah Pemasukan</a>
                    <?php endif ?>
                    <a href="<?php echo site_url('garamMutasi?gudang-garam='.$row->garam_gudang_id) ?>" class="btn btn-outline btn-circle purple" id="mutasi"  title="mutasi"><i class="fa fa-exchange "></i>Mutasi</a>

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
                    <span class='caption-subject bold '>Edit Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?php echo form_open($action, 'id="input-form" class="form-horizontal"'); ?>
                    
                    <div class='form-body'> 

                        <div class='row'>
                        
                        <div class="col-md-6 no-space">

                                <input type="hidden" name="id_pengeluaran" value="<?php echo $row->id_pengeluaran ?>">
                            
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Tanggal <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
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
                                        <div class='col-md-9'>
                                            <input type="text" class="form-control" name="no_spjg" id="no_spjg" placeholder="Nomer D.O" value="<?php echo $row->no_spjg ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Nopol <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
                                            <input type="text" class="form-control" name="nopol" id="nopol" placeholder="Nopol" value="<?php echo $row->nopol ?>" />
                                        </div>
                                    </div>
                                </div>
                                
                                            
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Tujuan <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
                                            <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Tujuan" value="<?php echo $row->tujuan ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 no-space">
                            
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Tonase <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
                                            <input type="number" class="form-control" name="tonase" id="tonase" placeholder="Tonase" value="<?php echo $row->tonase ?>" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Hasil Timbang <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
                                            <input type="number" class="form-control" name="hasil_timbang" id="hasil_timbang" placeholder="Hasil Timbang" value="<?php echo $row->hasil_timbang ?>" />
                                        </div>
                                    </div>
                                </div>
                                
                            
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Jumlah Karung <span class="font-red">*</span> </label>
                                        <div class='col-md-9'>
                                            <input type="number" class="form-control" name="jumlah_karung" id="jumlah_karung" placeholder="Jumlah Karung" value="<?php echo $row->jumlah_karung ?>" />
                                        </div>
                                    </div>
                                </div>
                
                                
                            </div>
                            
                        </div>

                        <input type="hidden" name="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>" />
            
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline' > Simpan Perubahan  </button>
                            </div>
                        </div>
                    </div>
                        
                <?php echo form_close() ?>
                    
            </div>
        </div>
    </div>
</div>