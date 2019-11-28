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
                  $TampungBobotSubKriteria = array();
                  foreach ($BobotSetiapKriteria as $key => $value) {
                    $Nampung = array();
                    $CekPunyaSub = $this->db->get_where('SubKriteria', array('IdKriteria' => $key))->num_rows();
                    if ($CekPunyaSub == 0) {
                      array_push($BobotDataSiswa, $value);
                    }
                    else{
                      $DataSub = $this->db->get_where('SubKriteria', array('IdKriteria' => $key))->result_array();
                      foreach ($DataSub as $Kunci => $Nilai) {
                        array_push($Nampung, $value);
                      }
                      $TampungBobotSubKriteria[$key] = $Nampung;
                    }
                  }
                  foreach ($DataBobotSiswaSubKriteria as $Key => $Value) {
                    foreach ($TampungBobotSubKriteria as $key => $value) {
                      array_reverse($value);
                      $Counter = 0;
                      foreach ($value as $kunci => $data) {
                        array_push($BobotDataSiswa, round($data*$Value[$Counter],3));
                        $Counter = $Counter + 1;
                      }
                    }
                  }
                 ?>
                 <?php
                  include 'PerhitunganElectre.php';
                  $NamaKolomKriteriaDanSub = array();
                  $NomorPendaftaranSiswa = array();
                ?>
                 <div class="table-responsive">
                <table class="table table-bordered table-responsive">
                  <tbody>
                    <tr>
                      <?php foreach ($FormSiswa as $key => $value): ?>
                        <th style="text-align:center;"><?php echo $value['COLUMN_NAME'];array_push($NamaKolomKriteriaDanSub,$value['COLUMN_NAME']);?></th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                        for ($i=0; $i < count($FormSiswa)-2; $i++) {
                          if ($i == 0) {
                            echo "<td colspan=3 style='text-align:center;'>Bobot =======></td>";
                          }
                          else {
                            echo "<td style='text-align:center;'>".$BobotDataSiswa[$i-1]."</td>";
                          }
                        }
                      ?>
                    </tr>
                      <?php $NamaProdi = ""; ?>
                      <?php for ($i=0; $i < count($Siswa); $i++) {?>
                        <tr>
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
                                if ($key == 'NomorPendaftaran') {
                                  array_push($NomorPendaftaranSiswa, $value);
                                }
                              }
                              ?>
                          </td>
                        <?php endforeach; ?>
                        </tr>
                      <?php } ?>
                      <tr>
                        <?php
                          for ($i=0; $i < count($FormSiswa)-2; $i++) {
                            if ($i == 0) {
                              echo "<td colspan=3 style='text-align:center;'>Nilai X =======></td>";
                            }
                            else {
                              echo "<td style='text-align:center;'>".$Nilai_X[$i-1]."</td>";
                            }
                          }
                        ?>
                      </tr>
                  </tbody>
                </table>
                </div>
                <h4>Langkah 1 Normalisasi Matrik</h4>
                <!-- // Menampilkan Matrik Ternormalisasi -->
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                <?php
                for ($Baris=0; $Baris < count($Matrik)+1; $Baris++) {
                  echo "<tr>";
                  for ($Kolom=0; $Kolom < count($Matrik[0])+1; $Kolom++) {
                    if ($Baris == 0) {
                      if ($Kolom == 0) {
                        echo "<td>Nomor Pendaftaran</td>";
                      }
                      else {
                        echo "<td>".$NamaKolomKriteriaDanSub[$Kolom+2]."</td>";
                      }
                    }
                    else {
                      if ($Kolom == 0) {
                        echo "<td>".$NomorPendaftaranSiswa[$Baris-1]."</td>";
                      }
                      else {
                        echo "<td>".$MatrikNormalisasi[$Baris-1][$Kolom-1]."</td>";
                      }
                    }
                  }
                  echo "</tr>";
                }
                echo "</tbody></table></div>";?>
                <h4>Langkah 2 Perkalian Bobot Dengan Matrik Ternormalisasi</h4>
                <!-- // Menampilkan Matrik Terboboti -->
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                  <?php
      				 	for ($Baris=0; $Baris < count($Matrik)+1; $Baris++) {
      			 			echo "<tr>";
      			 			for ($Kolom=0; $Kolom < count($Matrik[0])+1; $Kolom++) {
      				 			if ($Baris == 0) {
      				 				if ($Kolom == 0) {
      				 					echo "<td>Nomor Pendaftaran</td>";
      				 				}
      				 				else {
      				 					echo "<td>".$NamaKolomKriteriaDanSub[$Kolom+2]."</td>";
      				 				}
      				 			}
      				 			else {
      				 				if ($Kolom == 0) {
      				 					echo "<td>A".$NomorPendaftaranSiswa[$Baris-1]."</td>";
      				 				}
      				 				else {
      				 					echo "<td>".$MatrikTerboboti[$Baris-1][$Kolom-1]."</td>";
      				 				}
      				 			}
      				 		}
      				 		echo "</tr>";
      				 	}
      				 	echo "</tbody></table></div>";?>
                <h4>Menghitung Matrik Concordance dan Discordance</h4>
                <h4>Matrik Concordance</h4>
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
      				 	<?php for ($Baris=0; $Baris < count($MatrikConcordance); $Baris++) {
      			 			echo "<tr>";
      			 			for ($Kolom=0; $Kolom < count($MatrikConcordance[0]); $Kolom++) {
      			 				echo "<td>".$MatrikConcordance[$Baris][$Kolom]."</td>";
      				 		}
      				 		echo "</tr>";
      				 	}
      				 	echo "</tbody></table></div>";
      				 	echo "<h4>Matrik Discordance</h4>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                  echo "<tbody>";
      				 	for ($Baris=0; $Baris < count($MatrikDiscordance); $Baris++) {
      			 			echo "<tr>";
      			 			for ($Kolom=0; $Kolom < count($MatrikDiscordance[0]); $Kolom++) {
      			 				echo "<td>".$MatrikDiscordance[$Baris][$Kolom]."</td>";
      				 		}
      				 		echo "</tr>";
      				 	}
      				 	echo "</tbody></table></div>";?>
                <h4>Menghitung Matriks Dominan Concordance dan Discordance</h4>
                <h4>Matrik Dominan Concordance</h4>
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
      				 	<?php for ($Baris=0; $Baris < count($MatrikDominanConcordance); $Baris++) {
      			 			echo "<tr>";
      			 			for ($Kolom=0; $Kolom < count($MatrikDominanConcordance[0]); $Kolom++) {
      			 				echo "<td>".$MatrikDominanConcordance[$Baris][$Kolom]."</td>";
      				 		}
      				 		echo "</tr>";
      				 	}
      				 	echo "</tbody></table></div>";
      				 	echo "<h4>Matrik Dominan Discordance</h4>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                  echo "<tbody>";
      				 	for ($Baris=0; $Baris < count($MatrikDominanDiscordance); $Baris++) {
      			 			echo "<tr>";
      			 			for ($Kolom=0; $Kolom < count($MatrikDominanDiscordance[0]); $Kolom++) {
      			 				echo "<td>".$MatrikDominanDiscordance[$Baris][$Kolom]."</td>";
      				 		}
      				 		echo "</tr>";
      				 	}
      				 	echo "</tbody></table></div>";?>
                <h4>Langkah 6</h4>
      				 	<h4>Menetukan Agregate Dominance Matrix</h4>
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
      				 	<?php
                $HimpunanAlternatifTerbaik = array();
      				 	for ($Baris=0; $Baris < count($MatrikAgregatDominan); $Baris++) {
      			 			echo "<tr>";
      			 			$TotalNilaiAlternatif = 0;
      			 			for ($Kolom=0; $Kolom < count($MatrikAgregatDominan[0]); $Kolom++) {
      			 				echo "<td>".$MatrikAgregatDominan[$Baris][$Kolom]."</td>";
      			 				if ($Baris != $Kolom) {
      			 					$TotalNilaiAlternatif = $TotalNilaiAlternatif + $MatrikAgregatDominan[$Baris][$Kolom];
      			 				}
      				 		}
      				 		echo "</tr>";
      				 		array_push($HimpunanAlternatifTerbaik, $TotalNilaiAlternatif);
      				 	}
      				 	echo "</tbody></table></div>";?>
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
