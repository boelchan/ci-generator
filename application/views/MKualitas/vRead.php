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
                        <?php echo btnEdit($row->id_kualitas) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <tr>
                            <td>Nama Kualitas</td>
                            <td><?php echo $row->nama_kualitas; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>