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

                <?php foreach ($wilayahs as $wil) : ?>
                    <h3><?php echo $wil->nama_wilayah ?>
                    <?php if ($this->group_id == 1) : ?>
                    <?php echo btnCreate('Tambah Kantor', $this->areaUrl.'create?wilayah='.$wil->id_wilayah) ?>
                    <?php endif ?>
                    </h3>
                    <?php 
                    if ($this->group_id == 4) {
                        $wilayah = $this->ion_auth_model->get_users_wilayah($this->jwt->user_id)->row();
                        $kantors = $this->mKantorModel->where('id_kantor', $wilayah->kantor_id)->get_all();
                    } else {
                        $kantors = $this->mKantorModel->where('wilayah_id', $wil->id_wilayah)->get_all();
                    }
                    
                    if ( $kantors )
                    {
                        foreach ( $kantors as $kan)
                        {
                            echo "<a href='".$this->areaUrl.'read/'.$kan->id_kantor."' class='btn btn-lg btn-outline '>".$kan->nama_kantor."</a>&nbsp;";
                        }
                    }
                     ?>

                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


</script>