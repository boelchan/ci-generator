<div class='row'>
    <div class='col-md-5'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack(site_url('mKantor/read/'.@$kantor->id_kantor), '') ?>
                    <?php if ($this->group_id == 1) : ?>
                    <a href="<?php echo site_url('pemasukan?gudang-garam='.$row->id_garam_gudang) ?>" class="btn btn-outline btn-circle green" id="tambah"  title="pemasukan"><i class="fa fa-arrow-down "></i>Pemasukan</a>
                    <?php endif ?>
                    <a href="<?php echo site_url('pengeluaran?gudang-garam='.$row->id_garam_gudang) ?>" class="btn btn-outline btn-circle yellow" id="kurang" title="pengeluaran"><i class="fa fa-arrow-up "></i> Pengeluaran</a>
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
                                            <span data-counter="counterup" data-value="" id="stok"></span>
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

    <div class='col-md-7'>
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
                                                <label class="col-md-4 control-label">Tipe</label>
                                                <div class="col-md-8">
                                                    <select name="tipe" class="form-control form-filter input-sm">
                                                        <option value="">Semua</option>
                                                        <option value="in">in</option>
                                                        <option value="out">out</option>
                                                    </select>
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
                    <table class="table table-bordered table-hover" id="tableGaramMutasi">
                        <thead>
                            <tr role="row" class="heading" id="tableHeader">
                                <th width="2%"> 
                                </th>
                        
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <!-- <th>Referensi</th> -->
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
        src: $("#tableGaramMutasi"),
        dataTable: {
            "ajax": {
                "url": "<?php echo site_url('GaramMutasi/getDatatable/') ?>",
                "complete": function (data) {
                    $('#stok').html(data.responseJSON.stok)
                }

            },
            "order": [
                [1, "desc"]
            ],            
            "columnDefs": [
                {
                    targets: [3],
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
</script>