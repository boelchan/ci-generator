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
                        <?php echo btnEdit($row->) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <tr>
                            <td>No Spjg</td>
                            <td><?php echo $row->no_spjg; ?></td>
                        </tr>
                        <tr>
                            <td>Pemasukan</td>
                            <td><?php echo $row->pemasukan; ?></td>
                        </tr>
                        <tr>
                            <td>Pengeluaran</td>
                            <td><?php echo $row->pengeluaran; ?></td>
                        </tr>
                        <tr>
                            <td>Sisa</td>
                            <td><?php echo $row->sisa; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>