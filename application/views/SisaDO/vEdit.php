<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Edit Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?php echo form_open($action, 'id="input-form" class="form-horizontal"'); ?>
                    
                    <div class='form-body'> 

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>No Spjg <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="no_spjg" id="no_spjg" placeholder="No Spjg" value="<?php echo $row->no_spjg ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Pemasukan</label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="pemasukan" id="pemasukan" placeholder="Pemasukan" value="<?php echo $row->pemasukan ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Pengeluaran</label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="pengeluaran" id="pengeluaran" placeholder="Pengeluaran" value="<?php echo $row->pengeluaran ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Sisa</label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="sisa" id="sisa" placeholder="Sisa" value="<?php echo $row->sisa ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="" value="<?php echo $; ?>" />
            
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