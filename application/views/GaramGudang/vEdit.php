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
                                    <label class='col-md-3 control-label'>Gudang <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <?php
                                            $gudang_id = $row->gudang_id;
                                            $gudang_id_name = '';                                            
                                            if (!empty($gudang_id))
                                                $gudang_id_name = $this->mGudangModel->get($gudang_id)->{$this->mGudangModel->label};
                                        ?>
                                        <select name='gudang_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/mGudangModel') ?>'>
                                            <option value="<?php echo $gudang_id ?>" selected="selected"><?php echo $gudang_id_name ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Kualitas <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <?php
                                            $kualitas_id = $row->kualitas_id;
                                            $kualitas_id_name = '';                                            
                                            if (!empty($kualitas_id))
                                                $kualitas_id_name = $this->mKualitasModel->get($kualitas_id)->{$this->mKualitasModel->label};
                                        ?>
                                        <select name='kualitas_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/mKualitasModel') ?>'>
                                            <option value="<?php echo $kualitas_id ?>" selected="selected"><?php echo $kualitas_id_name ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tonase <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="tonase" id="tonase" placeholder="Tonase" value="<?php echo $row->tonase ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id_garam_gudang" value="<?php echo $id_garam_gudang; ?>" />
            
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