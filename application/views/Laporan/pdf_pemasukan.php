<table border="true">
    <thead>
        <tr>
            <td>NO</td>
            <td>TANGGAL</td>
            <td>NO SPJG</td>
            <td>WILAYAH</td>
            <td>KANTOR</td>
            <td>GUDANG</td>
            <td>TONASE</td>
            <td>KET</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($q->result() as $d) : ?>
        <tr>
            <td></td>
            <td><?php echo id_date($d->tanggal) ?></td>
            <td><?php echo $d->no_spjg ?></td>
            <td><?php echo $d->nama_wilayah ?></td>
            <td><?php echo $d->nama_kantor ?></td>
            <td><?php echo $d->nama_gudang ?></td>
            <td><?php echo idr($d->tonase) ?></td>
            <td></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>