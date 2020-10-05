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
            
                <?= form_open($action, 'id="input-form" class="form-horizontal"'); ?>
                    
                    <div class='form-body'> 
                        <h3>Akun</h3>  

                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Email <span class="font-red">*</span> </label>
                                <div class='col-md-4'>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $row->email ?>" />
                                </div>
                            </div>
                        </div>
                    
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Password <span class="font-red">*</span> </label>
                                <div class='col-md-4'>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
                                    <span class="help-block"><i>kosongi jika tidak ingin diubah</i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Konfirmasi Password <span class="font-red">*</span> </label>
                                <div class='col-md-4'>
                                    <input type="password" class="form-control" name="rpassword" id="rpassword" placeholder="Konfirmasi Password" value="" />
                                </div>
                            </div>
                        </div>
                                                    
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Aktif  <span class="font-red">*</span></label>
                                <div class='col-md-4'>
                                    <?php 
                                    $opt_act = ['1'=>'Aktif', '0'=>'Tidak Aktif'];
                                    echo form_dropdown('active', $opt_act, $row->active ,'class="form-control form-filter select2"');
                                    ?>

                                </div>
                            </div>
                        </div>

                        <h3>Detail</h3>  
                        
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Nama  <span class="font-red">*</span></label>
                                <div class='col-md-4'>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nama" value="<?php echo $row->first_name ?>" />
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Group  <span class="font-red">*</span></label>
                                <div class='col-md-4'>
                                <?php 
                                    echo form_dropdown('group_id', $opt_group, $groups->group_id ,'class="form-control form-filter select2"');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='form-group'>
                                <label class='col-md-3 control-label'>Wilayah  <span class="font-red">*</span></label>
                                <div class='col-md-4'>
                                <?php
                                    echo form_dropdown('wilayah_id', $opt_wilayah, $groups->wilayah_id ,'class="form-control form-filter select2"');
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="ope-4">
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Kantor  <span class="font-red">*</span></label>
                                    <div class='col-md-4'>
                                    <?php 
                                        echo form_dropdown('kantor_id', $opt_kantor, $groups->kantor_id ,'class="form-control form-filter select2"');
                                        ?>
                                    </div>
                                </div>
                            </div>        
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Gudang  <span class="font-red">*</span></label>
                                    <div class='col-md-4'>
                                    <?php 
                                        echo form_dropdown('gudang_id', $opt_gudang, $groups->gudang_id ,'class="form-control form-filter select2"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                            
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
            
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-3 col-md-12'>
                                <button type='submit' class='btn blue btn-circle btn-outline' > Simpan Perubahan  </button>
                            </div>
                        </div>
                    </div>
                        
                <?= form_close() ?>
                    
            </div>
        </div>
    </div>
</div>


<script>
$('#ope-4').hide()
<?php if ($groups->group_id == 4) : ?>
$('#ope-4').show()
<?php endif ?>
$('select[name=group_id]').change(function (e) { 
    e.preventDefault();
    if ( $(this).val() == 4 )
    {
        $('#ope-4').show()
    }
    if ( $(this).val() == 2 )
    {
        $('#ope-4').hide()
    }
});


    $('select[name=wilayah_id').change(function (e) { 
        e.preventDefault();
        var target = $('select[name=kantor_id')
        var data   = {id:$(this).val(), [csrfName]:csrfHash}
        var url    = "<?php echo site_url('laporan/getKantor') ?>"
        main.dropdownAjax(target, data, url)
    });

    $('select[name=kantor_id').change(function (e) { 
        e.preventDefault();
        var target = $('select[name=gudang_id')
        var data   = {id:$(this).val(), [csrfName]:csrfHash}
        var url    = "<?php echo site_url('laporan/getGudang') ?>"
        main.dropdownAjax(target, data, url)
    });
</script>