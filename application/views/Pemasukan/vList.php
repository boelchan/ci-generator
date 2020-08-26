<div class='row'>
    <div class='col-md-4'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack(site_url('mKantor/read/'.@$kantor->id_kantor), '') ?>
                    <a href="<?php echo site_url('pengeluaran?gudang-garam='.$row->id_garam_gudang) ?>" class="btn btn-outline btn-circle yellow" id="kurang" title="pengeluaran"><i class="fa fa-arrow-up "></i> Tambah Pengeluaran</a>
                    <a href="<?php echo site_url('garamMutasi?gudang-garam='.$row->id_garam_gudang) ?>" class="btn btn-outline btn-circle purple" id="mutasi" title="mutasi"><i class="fa fa-exchange "></i> Mutasi</a>

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
                                <td><?php echo $row->mGudang->nama_gudang ?></td>
                            </tr>
                            <tr>
                                <td>Kualitas</td>
                                <td><?php echo $row->mKualitas->nama_kualitas ?></td>
                            </tr>
                        </table>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="" id="stok">0</span>
                                            <small class="font-green-sharp">ton</small>
                                        </h3>
                                        <small>Stok</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-8'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <span class="caption-subject font-dark sbold">Tambah Pemasukan</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?php echo form_open($action, 'id="input-form" class="form-horizontal"'); ?>

                    <div class='form-body'> 
                        <input type="hidden" name="garam_gudang_id" value="<?php echo $row->id_garam_gudang ?>">

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
                                            <input type='text' class='form-control ' readonly name="tanggal" value="<?php echo date('d-m-Y') ?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Nomer D.O <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="text" class="form-control" name="no_spjg" id="no_spjg" placeholder="Nomer D.O" value="" />
                                    </div>
                                </div>
                            </div>
                            
                        
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Tonase <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="number" class="form-control" name="tonase" id="tonase" placeholder="Tonase" value="" />
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

<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light bordered'>
            <div class='portlet-title'>
                <div class="caption">
                    <span class="caption-subject font-dark sbold">Data</span>
                </div>
                <div class="actions">
                    <a class="accordion-toggle accordion-toggle-styled collapsed btn btn-circle btn-outline blue" data-toggle="collapse" data-parent="#accordion3" href="#collapse_filter" title="filter pencaran"> <i class="fa fa-search"></i> </a>
                </div>
            </div>
            <div class='portlet-body'>
                <div class="panel-group accordion" id="accordion3">
                    <div class="panel panel-default">
                        <div id="collapse_filter" class="panel-collapse collapse">       
                            <div class="panel-body">             
                                <div class="row">
                                    <div class="form-group form-horizontal filter">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Nomer D.O</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-filter input-sm" name="no_spjg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <button class="btn btn-sm blue btn-outline btn-circle filter-submit pull-right"> <i class="fa fa-search fa-lg"></i> Cari</button> </div>
                                            <div class="col-md-6 no-space">
                                                <button class="btn btn-sm red btn-outline btn-circle filter-cancel pull-left"> <i class="fa fa-refresh fa-lg"></i> Reset</button> </div>
                                        </div>
                                    </div>  
                                </div>  
                            </div>  
                        </div>
                    </div>
                </div>
                <div class='table-container'>
                    <div class="table-actions-wrapper">
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Pilih</option>
                            <?php echo btnDestroyTable() ?>
                        </select>
                        <button class="btn btn-sm blue btn-icon-only btn-circle btn-outline table-group-action-submit">
                            <i class="fa fa-check fa-lg"> </i> </button>
                            <span> </span>
                    </div>
                    <table class="table table-bordered table-hover" id="tablePemasukan">
                        <thead>
                            <tr role="row" class="heading" id="tableHeader">
                                <th width="2%"> 
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable">
                                        <span></span>
                                    </label>    
                                </th>
                        
                                <th>Tanggal</th>
                                <th>Nomer D.O</th>
                                <th>Tonase</th>
                                <th></th>
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
    datatableAjax.setDefaultParam('garam-gudang-id', '<?= $row->id_garam_gudang ?>');
    datatableAjax.init({
        src: $("#tablePemasukan"),
        dataTable: {
            "ajax": {
                "url": "<?php echo site_url('Pemasukan/getDatatable/') ?>",
                "complete": function (data) {
                    $('#stok').html(data.responseJSON.stok)
                }
            },
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [
                {
                    targets: [3],
                    className: 'dt-body-right',
                    orderable:true
                },
                {
                    targets: [0,($('#tableHeader').find('th').length)-1],
                    orderable:false
                },
            ]        
        }
    });
</script>