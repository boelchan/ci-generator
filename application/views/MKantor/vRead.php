<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
            <table class="table">
                <tr>
                    <td width="10%">Nama</td>
                    <td>
                        <?php echo $row->nama_kantor; ?>
                        <?php if ($this->group_id == 1) : ?>
                        <a href="<?php echo $this->areaUrl.'edit/'.$row->id_kantor ?>" class="btn btn-outline btn-circle btn-icon-only blue" title="ubah"><i class="fa fa-pencil"></i></a>
                        <button class="btn btn-outline btn-circle btn-icon-only red" title="hapus" id="hapus-kantor" data-id_kantor="<?php echo $row->id_kantor ?>" data-nama="<?php echo $row->nama_kantor ?>"><i class="fa fa-trash"></i></button>
                        <?php endif ?>
                    </td>
                </tr>
                <?php
                    $wilayah_id = $row->wilayah_id;
                    if (!empty($wilayah_id)) 
                    {
                        $wilayah_id_name = $this->mWilayahModel->get($wilayah_id)->{$this->mWilayahModel->label};
                    }
                    else
                    {
                        $wilayah_id_name = '';
                    }
                    ?>
                <tr>
                    <td>Wilayah</td>
                    <td><?php echo $wilayah_id_name; ?></td>
                </tr>
            </table>
        </div>

    
        <div class="col-md-12">
            <h3>Gudang
            <?php if ($this->group_id == 1) : ?>
            <a href="<?php echo site_url('mGudang/create/?kantor='.$row->id_kantor) ?>" class="btn btn-outline btn-circle blue btn-xs"> <i class="fa fa-plus"></i> Tambah</a>
            <?php endif ?>

            </h3>
        </div>

        <?php if ($gudangs) : ?>
            <?php foreach ($gudangs as $gudang) : ?>
                <div class='col-md-4'>
                    <div class='portlet light'>
                        <div class='portlet-title'>
                            <div class='caption'>
                                <span class='caption-subject'><?php echo $gudang->nama_gudang ?></span>
                            </div>
                            <div class="actions">
                                <?php if ($this->group_id == 1) : ?>
                                <a href="<?php echo site_url('mGudang/edit/'.$gudang->id_gudang) ?>" class="btn btn-outline btn-circle  blue "><i class="fa fa-pencil"></i></a>
                                <button class="btn btn-outline btn-circle btn-sm red hapus-gudang" data-id_gudang="<?php echo $gudang->id_gudang ?>" data-nama="<?php echo $gudang->nama_gudang ?>"><i class="fa fa-trash"></i></button>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class='portlet-body'>

                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr class="bold text-center heading ">
                                        <td width="25%">Kualitas</td>
                                        <td width="30%">Stok (tonase)</td>
                                        <td width="45%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $isi_gudang = $this->garamGudangModel->with_mKualitas('fields:nama_kualitas')->where('gudang_id', $gudang->id_gudang)->get_all(); ?>
                                    <?php if ($isi_gudang) : ?>
                                        <?php foreach ( $isi_gudang as $isi ) : ?>
                                            <tr>
                                                <td><?php echo $isi->mKualitas->nama_kualitas ?></td>
                                                <td class="text-right"><?php echo idr($isi->stok) ?></td>
                                                <td>
                                                    <?php if ($this->group_id == 1 || $this->wilayah_id == 3) : ?>
                                                    <a href="<?php echo site_url('pemasukan?gudang-garam='.$isi->id_garam_gudang) ?>" class="btn btn-outline btn-icon-only btn-circle green" id="tambah" data-id_gudang="<?php echo $gudang->id_gudang ?>" data-nama="<?php echo $gudang->nama_gudang ?>" title="pemasukan"><i class="fa fa-arrow-down "></i></a>
                                                    <?php endif ?>
                                                    <a href="<?php echo site_url('pengeluaran?gudang-garam='.$isi->id_garam_gudang) ?>" class="btn btn-outline btn-icon-only btn-circle yellow" id="kurang" data-id_gudang="<?php echo $gudang->id_gudang ?>" data-nama="<?php echo $gudang->nama_gudang ?>" title="pengeluaran"><i class="fa fa-arrow-up "></i></a>
                                                    <a href="<?php echo site_url('garamMutasi?gudang-garam='.$isi->id_garam_gudang) ?>" class="btn btn-outline btn-icon-only btn-circle purple" id="mutasi" data-id_gudang="<?php echo $gudang->id_gudang ?>" data-nama="<?php echo $gudang->nama_gudang ?>" title="mutasi"><i class="fa fa-exchange "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <tr>
                                        <td colspan="3"><i>belum ada stok</i></td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class='col-md-4'>
                <i>tidak ada gudang</i>
            </div>
        <?php endif ?>
        
    </div>
</section>

<script>


    
    $('#hapus-kantor').click(function (e) { 
        e.preventDefault();
        
        var kantor_id = $(this).data('id_kantor');
        
        swal({
          title : "Hapus kantor <b>"+$(this).data('nama')+"</b> ?",
          html: 'proses ini akan menghapus seluruh gudang yang ada dibawahnya!',
          type: "question",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Ya'
        }).then(function(){
            $.post("<?php echo site_url('mKantor/destroy') ?>", {id_kantor: kantor_id, [csrfName]:csrfHash}, function(data, textStatus, xhr) {
                if (data.success == true) {
                    swal("Berhasil", data.message, "success");
                    location.href = '<?php echo site_url('mKantor') ?>';
                }else{
                    swal("Opps!", data.message, "warning");
                }
            });
        });
    });

    $('.hapus-gudang').click(function (e) { 
        e.preventDefault();
        
        var gudang_id = $(this).data('id_gudang');
        
        swal({
          title : "Hapus gudang <b>"+$(this).data('nama')+"</b> ?",
          html: 'proses ini akan menghapus seluruh data transaksi di gudang tersebut!',
          type: "question",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Ya'
        }).then(function(){
            $.post("<?php echo site_url('mGudang/destroy') ?>", {id_gudang: gudang_id, [csrfName]:csrfHash}, function(data, textStatus, xhr) {
                if (data.success == true) {
                    swal("Berhasil", data.message, "success");
                    location.reload();
                }else{
                    swal("Opps!", data.message, "warning");
                }
            });
        });
    });



</script>