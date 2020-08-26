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
                                    <label class='col-md-3 control-label'>Garam Gudang <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <?php
                                            $garam_gudang_id = $row->garam_gudang_id;
                                            $garam_gudang_id_name = '';                                            
                                            if (!empty($garam_gudang_id))
                                                $garam_gudang_id_name = $this->garamGudangModel->get($garam_gudang_id)->{$this->garamGudangModel->label};
                                        ?>
                                        <select name='garam_gudang_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/garamGudangModel') ?>'>
                                            <option value="<?php echo $garam_gudang_id ?>" selected="selected"><?php echo $garam_gudang_id_name ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tipe <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="tipe" id="tipe" placeholder="Tipe" value="<?php echo $row->tipe ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Jumlah <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $row->jumlah ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Saldo <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $row->saldo ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Referensi <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control mask-number" name="referensi_id" id="referensi_id" placeholder="Referensi" value="<?php echo $row->referensi_id ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id_garam_mutasi" value="<?php echo $id_garam_mutasi; ?>" />
            
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