<div class="content-wrapper">
    <section class="content-header">
        <h1>Perhitungan</h1>
    </section>
    <section class="content">
        <div class="box">
        <div class="box-body">
              <table id="example1" class="table table-striped dataTable no-footer">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Program Studi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    foreach ($Prodi as $row) {
                ?>

                    <tr>
                        <td><?php echo $no ;?></td>
                        <td><?php echo $row['NamaProdi'];?></td>
                        <td>
                            <a class="btn btn-success" onclick="FormPerhitungan()"><li class="fa fa-plus"></li> Input Bobot</a>
                        </td>
                    </tr>
                        <?php
                $no++;
                }?>
                </tbody>
              </table>
              <button onclick="TabelPerbandingan()" class="btn btn-info"> <b>Show/HIde Tabel Perbandingan</b></button>
              <button onclick="PerhitunganANP()" class="btn btn-info"> <b>Show/HIde Perhitungan Bobot</b></button>
              <table class="table table-bordered table-responsive" id="TabelPerbandingan" style="display: none;">
                <tbody>
                  <tr class="bg-primary">
                    <th style="text-align:center;">1</th>
                    <th style="text-align:center;">Kedua Elemen Sama Pentingnya</th>
                  </tr>
                  <tr class="bg-primary">
                    <th style="text-align:center;">3</th>
                    <th style="text-align:center;">Elemen Yang Satu Sedikit Lebih Penting Dari Pada Elemen Yang Lain</th>
                  </tr>
                  <tr class="bg-primary">
                    <th style="text-align:center;">5</th>
                    <th style="text-align:center;">Elemen Yang Satu Lebih Penting Dari Pada Elemen Yang Lain</th>
                  </tr>
                  <tr class="bg-primary">
                    <th style="text-align:center;">7</th>
                    <th style="text-align:center;">Elemen Yang Satu Sangat Lebih Penting Dari Pada Elemen Yang Lainnya</th>
                  </tr>
                  <tr class="bg-primary">
                    <th style="text-align:center;">9</th>
                    <th style="text-align:center;">Mutlak Lebih Penting</th>
                  </tr>
                  <tr class="bg-primary">
                    <th style="text-align:center;">2, 4, 6, 8</th>
                    <th style="text-align:center;">Nilai Tengah Diantara Dua Pendapat Yang Berdampingan</th>
                  </tr>
                </tbody>
              </table>
              <?php
                //Membuat Array Untuk Nama2 Kriteria
                $BobotPerbandingan = array(1,0.50,2,0.33,3,0.25,4,0.2,5,0.16,6,0.14,7,0.12,8,0.11,9);
                $DataKriteria = array();
                array_push($DataKriteria, 'Dummy');
                foreach ($Kriteria as $row) {
                  array_push($DataKriteria, $row['NamaKriteria']);
                }
               ?>
              <div id="FormPerhitungan" style="display: none;">
                <form method="post">
                <div class="form-group">
                  <input type="hidden" id="NamaProdiKriteria"  class="form-control">
                  <div class="container-fluid">
                    <h4><b>Bobot Kriteria</b></h4>
                    <?php
                      $x = 0;
                      $counter = 0;
                      for ($i=$TotalKriteria-1; $i > 0; $i--) {
                        $y = $x;
                        for ($j=0; $j < $i; $j++) {
                          echo "<div class='row align-items-center'>";
                          $y = $y + 1;
                          $counter = $counter + 1;?>
                          <div class="col-sm-2">
                            <label><?php echo $DataKriteria[$x+1];?></label>
                          </div>
                          <div class="col-sm-8">
                            <select class="form-control" name="<?php echo "BobotKriteria".$counter; ?>">
                              <?php foreach ($BobotPerbandingan as $key => $value): ?>
                                <option value="<?php echo $value;?>"><?php echo $value;?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <label><?php echo $DataKriteria[$y+1];?></label>
                          </div>
                        </div><br>
                        <?php }
                        $x = $x + 1;
                      }
                     ?>
                     <h4><b>Bobot Sub Kriteria</b></h4>
                     <?php
                     foreach ($Kriteria as $key) {
                      $DataSubKriteria = $this->db->get_where('SubKriteria', array('IdKriteria' => $key['IdKriteria']))->result_array();
                      if (!empty($DataSubKriteria)) {
                        echo "<h4><b>".$key['NamaKriteria']."</b></h4>";
                        $JumlahSubKriteria = count($DataSubKriteria);
                        $NamaSubKriteria = array();
                        array_push($NamaSubKriteria, 'Dummy');
                        foreach ($DataSubKriteria as $row) {
                          array_push($NamaSubKriteria, $row['NamaSubKriteria']);
                        }
                        $x = 0;
                        $counter = 0;
                        for ($i=$JumlahSubKriteria-1; $i > 0; $i--) {
                          $y = $x;
                          for ($j=0; $j < $i; $j++) {
                            echo "<div class='row align-items-center'>";
                            $y = $y + 1;
                            $counter = $counter + 1;?>
                            <div class="col-sm-2">
                              <label><?php echo $NamaSubKriteria[$x+1];?></label>
                            </div>
                            <div class="col-sm-8">
                              <select class="form-control" name="<?php echo $key['NamaKriteria'].$counter; ?>">
                              <?php foreach ($BobotPerbandingan as $Key => $value): ?>
                                <option value="<?php echo $value;?>"><?php echo $value;?></option>
                              <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <label><?php echo $NamaSubKriteria[$y+1];?></label>
                            </div>
                          </div><br>
                          <?php }
                          $x = $x + 1;
                        }
                      }
                    }
                      ?>
                 </div>
                 <button type="submit" class="btn btn-info"> <b>HITUNG</b></button>
                </div>
                </div>
                <br><br>
                <div id="PerhitunganANP" style="display: none;">
                  <?php include 'PerhitunganKriteria.php' ?>
                </div>
                <?php
                if (!empty($_POST)) {
                  $BobotDataSiswa = array();
                  $Nampung = array();
                  foreach ($BobotSetiapKriteria as $key => $value) {
                    $CekPunyaSub = $this->db->get_where('SubKriteria', array('IdKriteria' => $key))->num_rows();
                    if ($CekPunyaSub == 0) {
                      array_push($BobotDataSiswa, $value);
                    }
                    else{
                      $DataSub = $this->db->get_where('SubKriteria', array('IdKriteria' => $key))->result_array();

                      foreach ($DataSub as $Kunci => $Nilai) {
                        array_push($Nampung, $value);
                      }
                    }
                  }
                  array_reverse($Nampung);
                  $Counter = 0;
                  foreach ($Nampung as $key => $value) {
                    array_push($BobotDataSiswa, round($value*$TotalBobotSubKriteriaHorizontal[$Counter],3));
                    $Counter = $Counter + 1;
                  }
                 ?>
                <table class="table table-bordered table-responsive">
                  <tbody>
                    <tr>
                      <?php foreach ($FormSiswa as $key => $value): ?>
                        <th style="text-align:center;"><?php echo $value['COLUMN_NAME'] ?></th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                        for ($i=0; $i < count($FormSiswa)-2; $i++) {
                          if ($i == 0) {
                            echo "<td colspan=3></td>";
                          }
                          else {
                            echo "<td style='text-align:center;'>".$BobotDataSiswa[$i-1]."</td>";
                          }
                        }
                      ?>
                    </tr>
                    <tr>
                      <?php $NamaProdi = ""; ?>
                      <?php for ($i=0; $i < count($Siswa); $i++) {?>
                        <?php foreach ($Siswa[$i] as $key => $value): ?>
                          <td style="text-align:center;">
                            <?php
                              if ($key == 'Minat') {
                                if ($NamaProdi == "") {
                                  $query = "SELECT Prodi.NamaProdi FROM Prodi WHERE IdProdi = $value";
                              	  $Data = $this->db->query($query)->result_array();
                                  $NamaProdi = $Data[0]['NamaProdi'];
                                  echo $NamaProdi;
                                }
                                else {
                                  echo $NamaProdi;
                                }
                              }
                              else{
                                echo $value;
                              }
                              ?>
                          </td>
                        <?php endforeach; ?>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
                <?php } ?>
              </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
</div>
<script type="text/javascript">
  function TabelPerbandingan() {
    var x = document.getElementById("TabelPerbandingan");
    if (x.style.display === "none") {
      x.style.display = "table";
    } else {
      x.style.display = "none";
    }
  }
  function FormPerhitungan() {
    var x = document.getElementById("FormPerhitungan");
    if (x.style.display === "none") {
      x.style.display = "grid";
    } else {
      x.style.display = "none";
    }
  }
  function PerhitunganANP() {
    var x = document.getElementById("PerhitunganANP");
    if (x.style.display === "none") {
      x.style.display = "grid";
    } else {
      x.style.display = "none";
    }
  }

</script>
