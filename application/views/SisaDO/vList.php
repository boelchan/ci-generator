<div class='row'>
    <div class='col-md-12'>
        <div class='portlet box green-meadow bordered'>
            <div class='portlet-title'>
                <div class="caption">
                    <span class="caption-subject font-dark sbold">Data</span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class='portlet-body'>
                
                <div class='table-container'>
                    <table class="table table-bordered table-hover" id="tableSisaDO">
                        <thead>
                            <tr role="row" class="heading" id="tableHeader" >
                                <th class="bg-green-jungle font-white" width="2%"> </th>
                        
                                <th class="bg-green-jungle font-white">Nomor DO</th>
                                <th class="bg-green-jungle font-white">Kualitas</th>
                                <th class="bg-green-jungle font-white">Pemasukan</th>
                                <th class="bg-green-jungle font-white">Pengeluaran</th>
                                <th class="bg-green-jungle font-white">Sisa</th>
                                
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
        src: $("#tableSisaDO"),
        dataTable: {
            "ajax": {
                "url": "<?php echo site_url('SisaDO/getDatatable/') ?>"
            },
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [
                {
                    targets: [3,4,5],
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