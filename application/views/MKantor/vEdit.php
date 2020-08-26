<div class='row'>
    <div class='col-md-12'>
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
                        
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Wilayah <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <?php echo form_dropdown('wilayah_id', $wilayah_dd, $row->wilayah_id, 'class="form-control"') ?>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Nama Kantor <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="text" class="form-control" name="nama_kantor" id="nama_kantor" placeholder="Nama Kantor" value="<?php echo $row->nama_kantor ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

                        <input type="hidden" name="id_kantor" value="<?php echo $id_kantor; ?>" />
            
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