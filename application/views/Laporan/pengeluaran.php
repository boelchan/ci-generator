<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light bordered'>

            <div class='portlet-body'>
                <div class="row">
                    <div class="form-group filter">
                        <?= form_open(site_url('laporan/cetak_pdf_pengeluaran'), 'id="" class="form-horizontal" method="get" target="_blank"'); ?>
                            <div class='form-body'> 
                            
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Tanggal <span class="font-red">*</span> </label>
                                        <div class='col-md-6'>
                                            <div class="input-group input-large date-picker input-daterange">
                                                <input type="text" class="form-control form-filter" required name="from">
                                                <span class="input-group-addon"> sd </span>
                                                <input type="text" class="form-control form-filter" required name="to"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Wilayah  <span class="font-red">*</span></label>
                                        <div class='col-md-6'>
                                            <?php echo form_dropdown('wilayah', $wilayah_dd,'', 'class="form-control select2 form-filter" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Nomor D.O</label>
                                        <div class='col-md-6'>
                                            <select name="no_spjg" class="form-control select2 form-filter">
                                                <option value=""></option>
                                                <?php if ($no_spjgs) : ?>
                                                    <?php foreach ($no_spjgs as $spjg) : ?>
                                                        <option value="<?php echo $spjg->no_spjg ?>"><?php echo $spjg->no_spjg ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Kantor </label>
                                        <div class='col-md-6'>
                                            <?php echo form_dropdown('kantor', '','', 'class="form-control select2 form-filter"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Kualitas  <span class="font-red">*</span></label>
                                        <div class='col-md-6'>
                                            <?php echo form_dropdown('kualitas', $kualitas_dd,'', 'class="form-control select2 form-filter" required="required"'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Gudang </label>
                                        <div class='col-md-6'>
                                            <?php echo form_dropdown('gudang', '','', 'class="form-control select2 form-filter"'); ?>
                                        </div>
                                    </div>
                                </div>
                               

                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-3 control-label'>Tujuan</label>
                                        <div class='col-md-6'>
                                            <select name="tujuan" class="form-control select2 form-filter">
                                                <option value=""></option>
                                                <?php if ($tujuans) : ?>
                                                    <?php foreach ($tujuans as $tuj) : ?>
                                                        <option value="<?php echo $tuj->tujuan ?>"><?php echo $tuj->tujuan ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                               

                            </div>
                
                            <div class='form-actions'>
                                <div class='col-md-offset-5 col-md-7'>
                                    <button type='submit' class='btn blue btn-circle '><i class="icon icon-printer"></i> Cetak PDF</button>
                                    <button class="btn blue btn-outline btn-circle filter-submit"> <i class="fa fa-search fa-lg"></i> Cari</button>
                                </div>
                            </div>
                                

                        </form>
                    
                    </div>  
                </div>
                <div class='table-container'>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-blue">
                                        <span data-counter="counterup" id="total-jumlah-karung"></span>
                                        <small class="font-blue"></small>
                                    </h3>
                                    <small>Total Jumlah Karung</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-blue">
                                        <span data-counter="counterup" id="total-tonase"></span>
                                        <small class="font-blue"></small>
                                    </h3>
                                    <small>Total Tonase</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-blue">
                                        <span data-counter="counterup" id="total-hasil-timbang"></span>
                                        <small class="font-blue"></small>
                                    </h3>
                                    <small>Total Hasil Timbang</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover" id="tablePemasukan">
                        <thead>
                            <tr role="row" class="heading" id="tableHeader">
                                <th width="2%"> 
                                     
                                </th>
                        
                                <th>Tanggal</th>
                                <th>Nomer D.O</th>
                                <th>Wilayah</th>
                                <th>Kantor</th>
                                <th>Gudang</th>
                                <th>Kualitas</th>
                                <th>Nopol</th>
                                <th>Jumlah <br>Karung</th>
                                <th>Tonase</th>
                                <th>Hasil <br>Timbang</th>
                                <th>Tujuan</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var datatableAjax = new Datatable();

    datatableAjax.setDefaultParam('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
    datatableAjax.init({
        src: $("#tablePemasukan"),
        dataTable: {
            "ajax": {
                "url": "<?php echo site_url('Pengeluaran/getRekapDatatable/') ?>",
                "complete": function (data) {
                    $('#total-jumlah-karung').html(data.responseJSON.total_jumlah_karung)
                    $('#total-tonase').html(data.responseJSON.total_tonase)
                    $('#total-hasil-timbang').html(data.responseJSON.total_hasil_timbang)
                }
            },
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [
                {
                    targets: [8,9,10],
                    className: 'dt-body-right',
                    orderable:true
                },
                {
                    targets: [0],
                    orderable:false
                },
            ]        
        }
    });

    $('select[name=wilayah').change(function (e) { 
        e.preventDefault();
        var target = $('select[name=kantor')
        var data   = {id:$(this).val(), [csrfName]:csrfHash}
        var url    = "<?php echo $this->areaUrl.'getKantor' ?>"
        main.dropdownAjax(target, data, url)
    });

    $('select[name=kantor').change(function (e) { 
        e.preventDefault();
        var target = $('select[name=gudang')
        var data   = {id:$(this).val(), [csrfName]:csrfHash}
        var url    = "<?php echo $this->areaUrl.'getGudang' ?>"
        main.dropdownAjax(target, data, url)
    });

</script>
