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
                                    <label class='col-md-3 control-label'>Kantor <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <?php echo form_dropdown('kantor_id', $kantor_dd, $row->kantor_id, 'class="form-control"') ?>
                                    </div>
                                </div>
                            </div>
                            

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Nama Gudang <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="text" class="form-control" name="nama_gudang" id="nama_gudang" placeholder="Nama Gudang" value="<?php echo $row->nama_gudang ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id_gudang" value="<?php echo $id_gudang; ?>" />
            
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