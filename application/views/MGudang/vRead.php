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
                        <?php echo btnEdit($row->id_gudang) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <tr>
                            <td>Nama Gudang</td>
                            <td><?php echo $row->nama_gudang; ?></td>
                        </tr>
                        <?php
                            $kantor_id = $row->kantor_id;
                            if (!empty($kantor_id)) 
                            {
                                $kantor_id_name = $this->mKantorModel->get($kantor_id)->{$this->mKantorModel->label};
                            }
                            else
                            {
                                $kantor_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Kantor</td>
                            <td><?php echo $kantor_id_name; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>