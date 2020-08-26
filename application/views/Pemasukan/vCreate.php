<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Tambah Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?php echo form_open($action, 'id="input-form" class="form-horizontal"'); ?>

                    <div class='form-body'> 

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tanggal <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>No Spjg <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="no_spjg" id="no_spjg" placeholder="No Spjg" value="" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Garam Gudang <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <select name='garam_gudang_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/garamGudangModel') ?>'> </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tonase <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="tonase" id="tonase" placeholder="Tonase" value="" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
              
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline'>Simpan Data Baru</button>
                            </div>
                        </div>
                    </div>
                        
                <?php echo form_close() ?>
                
            </div>
        </div>
    </div>
</div> 