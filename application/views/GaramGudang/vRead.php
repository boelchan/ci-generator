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
                        <?php echo btnEdit($row->id_garam_gudang) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <?php
                            $gudang_id = $row->gudang_id;
                            if (!empty($gudang_id)) 
                            {
                                $gudang_id_name = $this->mGudangModel->get($gudang_id)->{$this->mGudangModel->label};
                            }
                            else
                            {
                                $gudang_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Gudang</td>
                            <td><?php echo $gudang_id_name; ?></td>
                        </tr>
                        <?php
                            $kualitas_id = $row->kualitas_id;
                            if (!empty($kualitas_id)) 
                            {
                                $kualitas_id_name = $this->mKualitasModel->get($kualitas_id)->{$this->mKualitasModel->label};
                            }
                            else
                            {
                                $kualitas_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Kualitas</td>
                            <td><?php echo $kualitas_id_name; ?></td>
                        </tr>
                        <tr>
                            <td>Tonase</td>
                            <td><?php echo $row->tonase; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>