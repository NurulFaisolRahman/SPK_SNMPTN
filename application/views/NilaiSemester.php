<div class="content-wrapper">
    <section class="content-header">
        <h1>Nilai Semester</h1>
    </section>
    <section class="content">
        <div class="box">
        <div class="box-header with-border">
              Edit Nilai Semester
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
            <form method="post" action="http://localhost/SPK_SNMPTN/Siswa/UpdateNilai">
              <div class="box-body">
              <div class="row">
                <?php foreach ($Nilai as $key => $value) { ?>
                  <?php 
                    if ($key == 'NomorPendaftaran') { ?>
                      <input type="hidden" name="<?=$key ?>" value="<?php echo $value;?>" class="form-control">
                  <?php } 
                  else { ?>
                      <div class="col-sm-1 form-group">
                      <div class="form-group">
                        <div class="row"></div>
                          <label><?php echo $key;?></label>
                          <input type="text" name="<?php echo $key;?>" value="<?php echo $value;?>" class="form-control">
                      </div>
                    </div>
                   <?php } ?>
                    <?php }?>
                 <div class="col-md-12 form-group">
            <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
             </div>
            </div>
              </div></form>
          </div>
    </section>
</div>