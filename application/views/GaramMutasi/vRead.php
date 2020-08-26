<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='portlet light'>
                <div class='portlet-title'>
                    <div class='caption'>
                        <?php echo btnBack() ?>
                        <span class='caption-subject bold'></span>
                    </div>
                    <div class="actions">
                        <?php echo btnEdit($row->id_garam_mutasi) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <?php
                            $garam_gudang_id = $row->garam_gudang_id;
                            if (!empty($garam_gudang_id)) 
                            {
                                $garam_gudang_id_name = $this->garamGudangModel->get($garam_gudang_id)->{$this->garamGudangModel->label};
                            }
                            else
                            {
                                $garam_gudang_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Garam Gudang</td>
                            <td><?php echo $garam_gudang_id_name; ?></td>
                        </tr>
                        <tr>
                            <td>Tipe</td>
                            <td><?php echo $row->tipe; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td><?php echo $row->jumlah; ?></td>
                        </tr>
                        <tr>
                            <td>Saldo</td>
                            <td><?php echo $row->saldo; ?></td>
                        </tr>
                        <tr>
                            <td>Referensi</td>
                            <td><?php echo $row->referensi_id; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>