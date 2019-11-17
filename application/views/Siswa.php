<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Siswa</h1>
    </section>
    <section class="content">
        <?php
            $config = mysqli_connect("localhost", "root", "","spk");
            error_reporting(0);
            $NomorPendaftaran = $_GET['NomorPendaftaran'];
            $sql="SELECT  * FROM DataSiswa where NomorPendaftaran='$NomorPendaftaran' ";
            if (!$result = mysqli_query($config, $sql)){
            die('Error:'.mysqli_error($config));
            }  else {
            if (mysqli_num_rows($result)> 0){
            while ($row=  mysqli_fetch_assoc($result)){
        ?>
        <div class="box">
        <div class="box-header with-border">
              Edit Data Siswa
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
            <form method="post" action="http://localhost/SPK_SNMPTN/Admin/UpdateSiswa">
              <div class="box-body">
                    <div class="row">
            <div class="col-md-12 form-group">
                <input type="hidden" name="NomorPendaftaranLama" value="<?php echo $row['NomorPendaftaran'];?>" class="form-control" required="">
                <label>Nomor Pendaftaran</label>
                <input type="text" name="NomorPendaftaran" value="<?php echo $row['NomorPendaftaran'];?>" class="form-control" required="">
                <label>NPSN Sekolah</label>
                <input type="text" name="NPSNSekolah" value="<?php echo $row['NPSNSekolah'];?>" class="form-control" required="">
                <label>Minat</label>
                <select class="form-control" name="Minat">
                <?php
                  foreach ($Prodi as $data) {?>
                    <option value="<?php echo $data['IdProdi']; ?>"
                      <?php if ($row['Minat'] == $data['IdProdi']) {
                        echo "selected";
                      } ?>><?php echo $data['NamaProdi']; ?></option>
                <?php } ?>
                </select>
                <?php for ($i = 3; $i < count($FormSiswa); $i++) { $NamaKolom = $FormSiswa[$i]['COLUMN_NAME'];?>
                  <div class="form-group">
                      <label><?php echo $FormSiswa[$i]['COLUMN_NAME'];?></label>
                      <input type="text" name="<?php echo $NamaKolom;?>" value="<?php echo $row[$NamaKolom];?>" class="form-control" required="">
                  </div>
                <?php }?>
                </div>
             <div class="col-md-12 form-group">
               <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
             </div>
            </div>
              </div></form>
          </div>
               <?php
                    }
                }  else {
                echo '';
                }
                }?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> <a href="#" data-toggle="modal" data-target="#my-modal1" class="btn btn-info"><li class="fa fa-plus"></li> Tambah</a></h3>
          <div class="box-tools pull-right">
             </div>
        </div>
        <div class="box-body">
              <table id="example1" class="table table-striped dataTable no-footer">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Pendaftaran</th>
                    <th>NPSN Sekolah</th>
                    <th>Minat</th>
                    <th>Aksi</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    foreach ($Siswa as $row) {
                ?>

                    <tr>
                        <td><?php echo $no ;?></td>
                        <td><?php echo $row['NomorPendaftaran'];?></td>
                        <td><?php echo $row['NPSNSekolah'];?></td>
                        <td><?php echo $row['NamaProdi'];?></td>
                        <td>
                            <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?NomorPendaftaran=<?php echo $row['NomorPendaftaran'];?>" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a>
                            <a HapusSiswa=<?php echo $row['NomorPendaftaran'];?> class="btn btn-danger HapusSiswa"><li class="fa fa-trash-o"></li> Hapus</a>
                         </td>
                    </tr>
                        <?php
                $no++;
                }?>
                </tbody>


              </table>
        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </section><!-- /.content -->
</div>
<form method="post" action="http://localhost/SPK_SNMPTN/Admin/TambahSiswa">
    <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Siswa</h4>
                </div>
                <div class="modal-body center">
                  <div class="form-group">
                      <label>Nomor Pendaftaran</label>
                      <input type="text" name="NomorPendaftaran" class="form-control" required="" placeholder="Masukkan Nomor Pendaftaran">
                  </div>
                  <div class="form-group">
                      <label>NPSN Sekolah</label>
                      <input type="text" name="NPSNSekolah" class="form-control" required="" placeholder="Masukkan Nomor Pendaftaran">
                  </div>
                  <div class="form-group">
                      <label>Minat</label>
                      <select class="form-control" name="Minat">
                      <?php
                        foreach ($Prodi as $data) {?>
                          <option value="<?php echo $data['IdProdi']; ?>"><?php echo $data['NamaProdi']; ?></option>
                        <?php } ?>
                      </select>
                  </div>
                  <?php for ($i = 3; $i < count($FormSiswa); $i++) {?>
                    <div class="form-group">
                        <label><?php echo $FormSiswa[$i]['COLUMN_NAME'];?></label>
                        <input type="text" name="<?php echo $FormSiswa[$i]['COLUMN_NAME'];?>" class="form-control" required="">
                    </div>
                  <?php }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-info"> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
