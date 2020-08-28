<section class='content'>

    <div class='row'>
	<?php foreach ($wilayahs as $wil) : ?>
        <div class='col-md-4'>
            <div class='portlet light'>
                <div class='portlet-title'>
                    <div class='caption'>
								<?php echo $wil->nama_wilayah ?>
                    </div>
                </div>
                <div class='portlet-body'>
					<div class="row">
						
							<div class="col-md-12" style="overflow-x:auto;">
								<table class="table table-bordered responsive" width="100%">
									<?php $data = $this->db->where('wilayah_id', $wil->id_wilayah)->get('v_inventori_all')->result() ?>
									<tr class="bold">
										<td>Kualitas</td>
										<td>Masuk</td>
										<td>Keluar</td>
										<td>Sisa</td>
									</tr>
									<?php foreach ($data as $d) : ?>
										<tr>
											<td><?php echo $d->nama_kualitas ?></td>
											<td class="text-right"><?php echo idr($d->masuk) ?></td>
											<td class="text-right"><?php echo idr($d->keluar) ?></td>
											<td class="text-right"><?php echo idr($d->sisa) ?></td>
										</tr>
									<?php endforeach ?>
									
								</table>
							</div>
					</div>
                </div>
            </div>
        </div>
						<?php endforeach ?>
    </div>
</section>