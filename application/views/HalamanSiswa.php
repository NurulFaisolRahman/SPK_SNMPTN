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
            <form method="post" action="http://localhost/SPK_SNMPTN/Siswa/UpdateSiswa">
              <div class="box-body">
                    <div class="row">
            <div class="col-md-12 form-group">
                <input type="hidden" name="NomorPendaftaran" value="<?php echo $row['NomorPendaftaran'];?>" class="form-control" required="">
                <label>NPSN Sekolah</label>
                <input type="text" name="NPSNSekolah" value="<?php echo $row['NPSNSekolah'];?>" class="form-control" required="">
                <label>Nama Siswa</label>
                <input type="text" name="NamaSiswa" value="<?php echo $row['NamaSiswa'];?>" class="form-control" required="">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="JenisKelamin">
                    <option value="L" <?php if ($row['JenisKelamin'] == 'L') {
                        echo "selected";
                      } ?>>Laki-laki</option>
                    <option value="P" <?php if ($row['JenisKelamin'] == 'P') {
                        echo "selected";
                      } ?>>Perempuan</option>
                </select>
                <label>Tanggal Lahir</label>
                <input type="date" name="TanggalLahir" value="<?php echo $row['TanggalLahir'];?>" class="form-control" required="">
                <label>Minat</label>
                <select class="form-control" name="IdProdi">
                <?php
                  foreach ($Prodi as $data) {?>
                    <option value="<?php echo $data['IdProdi']; ?>"
                      <?php if ($row['IdProdi'] == $data['IdProdi']) {
                        echo "selected";
                      } ?>><?php echo $data['NamaProdi']; ?></option>
                <?php } ?>
                </select>
                <!-- <?php for ($i = 7; $i < count($FormSiswa)-1; $i++) { $NamaKolom = $FormSiswa[$i]['COLUMN_NAME'];?>
                  <div class="form-group">
                      <label><?php echo $FormSiswa[$i]['COLUMN_NAME'];?></label>
                      <input type="text" name="<?php echo $NamaKolom;?>" value="<?php echo $row[$NamaKolom];?>" class="form-control" readonly>
                  </div>
                <?php }?> -->
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
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Minat</th>
                    <th>Rangking</th>
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
                        <td><?php echo $row['NamaSiswa'];?></td>
                        <td><?php echo $row['JenisKelamin'];?></td>
                        <td><?php echo $row['TanggalLahir'];?></td>
                        <td><?php echo $row['NamaProdi'];?></td>
                        <td><?php echo $row['Rangking'];?></td>
                        <td>
                            <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?NomorPendaftaran=<?php echo $row['NomorPendaftaran'];?>" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a>
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