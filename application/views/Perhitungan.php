<div class="content-wrapper">
    <section class="content-header">
        <h1>Perhitungan</h1>
    </section>
    <?php
      $NamaProgramStudi = array();
      foreach ($Prodi as $key) {
        $NamaProgramStudi[$key['IdProdi']] = $key['NamaProdi'];
      }
     ?>
    <section class="content">
        <div class="box">
        <div class="box-body">
            <?php
            if (!empty($_POST['IDMinat'])) {
              $Pecah = explode("|",$_POST['IDMinat']);
            }
             ?>
              <table id="Perhitungan" class="table table-striped dataTable no-footer">
                <thead>
                  <tr>
                    <th>Nama Program Studi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                          <select class="form-control" id="IdProdi" onchange="GantiProdi()">
                            <?php
                            foreach ($FilterData as $row) {?>
                               <option value="<?=$row['IdProdi']."|".$row['Tahun'];?>" <?php if (!empty($Pecah)) {
                                 if ($Pecah[0] == $row['IdProdi']) {
                                   echo "selected";
                                 }
                               } ?>><?=$NamaProgramStudi[$row['IdProdi']]." ".$row['Tahun'];?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                            <a class="btn btn-success" onclick="FormPerhitungan()"><li class="fa fa-plus"></li> Input Bobot</a>
                        </td>
                    </tr>
                </tbody>
              </table>
              <table id="Perhitungan" class="table table-striped dataTable no-footer">
                <thead>
                  <tr>
                    <th>Tanggal Bobot Yang Di Simpan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                          <select class="form-control" name="BobotHistory" id="BobotHistory">
                            <?php
                            foreach ($Bobot as $row) {?>
                               <option value="<?=$row['Bobot'];?>"><?=$row['Waktu'];?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                            <button onclick="TampilkanBobot()" class="btn btn-info"> <b>Lihat Bobot</b></button>
                        </td>
                    </tr>
                </tbody>
              </table>
              <button onclick="TabelPerbandingan()" class="btn btn-info"> <b>Show/HIde Tabel Perbandingan</b></button>
              <button onclick="PerhitunganANP()" class="btn btn-info"> <b>Show/HIde Perhitungan Bobot</b></button>
              <button onclick="PerhitunganElectre()" class="btn btn-info"> <b>Show/HIde Perhitungan Electre</b></button>
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
                $TextPerbandingan = array("Kedua Elemen Sama Pentingnya",0.50,"Nilai Tengah Diantara Dua Pendapat Yang Berdampingan",
                "Elemen Yang Kanan Sedikit Lebih Penting Dari Pada Elemen Yang Kiri","Elemen Yang Kiri Sedikit Lebih Penting Dari Pada Elemen Yang Kanan",
                 0.25,"Nilai Tengah Diantara Dua Pendapat Yang Berdampingan","Elemen Yang Kanan Lebih Penting Dari Pada Elemen Yang Kiri",
                 "Elemen Yang Kiri Lebih Penting Dari Pada Elemen Yang Kanan",0.16,"Nilai Tengah Diantara Dua Pendapat Yang Berdampingan",
                 "Elemen Yang Kanan Sangat Lebih Penting Dari Pada Elemen Yang Kiri","Elemen Yang Kiri Sangat Lebih Penting Dari Pada Elemen Yang Kanan",
                 0.12,"Nilai Tengah Diantara Dua Pendapat Yang Berdampingan","Elemen Kanan Mutlak Lebih Penting","Elemen Kiri Mutlak Lebih Penting");
                $DataKriteria = array();
                array_push($DataKriteria, 'Dummy');
                foreach ($Kriteria as $row) {
                  array_push($DataKriteria, $row['NamaKriteria']);
                }
               ?>
              <div id="FormPerhitungan" style="display: none;">
                <form method="post" onsubmit="SimpanIndexBobot()">
                <div class="form-group">
                  <input type="hidden" id="IDMinat" name="IDMinat" class="form-control">
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
                            <select class="form-control" name="<?php echo "BobotKriteria".$counter; ?>" id="<?php echo "BobotKriteria".$counter; ?>">
                              <?php for ($k=0; $k < count($BobotPerbandingan); $k++) { ?>
                                <option value="<?php echo $BobotPerbandingan[$k];?>"><?php echo $TextPerbandingan[$k];?></option>
                              <?php } ?>
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
                              <select class="form-control" name="<?php echo $key['NamaKriteria'].$counter; ?>" id="<?php echo $key['NamaKriteria'].$counter; ?>">
                                <?php for ($k=0; $k < count($BobotPerbandingan); $k++) { ?>
                                  <option value="<?php echo $BobotPerbandingan[$k];?>"><?php echo $TextPerbandingan[$k];?></option>
                                <?php } ?>
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
             </form>
                </div>
                <br><br>
                <div id="PerhitunganANP" style="display: none;">
                  <?php include 'PerhitunganKriteria.php' ?>
                </div>
                <?php
                if (!empty($_POST)) {
                  $BobotDataSiswa = array();
                  $BobotKriteriaTanpaSub = array();
                  $TampungBobotSubKriteria = array();
                  foreach ($BobotSetiapKriteria as $key => $value) {
                    $Nampung = array();
                    $CekPunyaSub = $this->db->get_where('SubKriteria', array('IdKriteria' => $key))->num_rows();
                    if ($CekPunyaSub == 0) {
                      array_push($BobotKriteriaTanpaSub, $value);
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
                  foreach ($BobotKriteriaTanpaSub as $key => $value) {
                    array_push($BobotDataSiswa, $value);
                  }
                 ?>
                 <div id="PerhitunganElectre" style="display: none;">
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
                        <th style="text-align:center;"><?php if ($value['COLUMN_NAME'] == 'IdProdi') {
                          echo "Minat";
                        } else {
                          echo $value['COLUMN_NAME'];
                        }
                        ;array_push($NamaKolomKriteriaDanSub,$value['COLUMN_NAME']);?></th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                        for ($i=0; $i < count($FormSiswa)-7; $i++) {
                          if ($i == 0) {
                            echo "<td colspan=7 style='text-align:center;'>Bobot =======></td>";
                          }
                          else {
                            echo "<td style='text-align:center;'>".$BobotDataSiswa[$i-1]."</td>";
                          }
                        }
                      ?>
                    </tr>
                      <?php $NamaProdi = "";?>
                      <?php for ($i=0; $i < count($Siswa); $i++) {?>
                        <tr>
                        <?php foreach ($Siswa[$i] as $key => $value): ?>
                          <td style="text-align:center;">
                            <?php
                              if ($key == 'IdProdi') {
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
                          for ($i=0; $i < count($FormSiswa)-7; $i++) {
                            if ($i == 0) {
                              echo "<td colspan=7 style='text-align:center;'>Nilai X =======></td>";
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
                        echo "<td>".$NamaKolomKriteriaDanSub[$Kolom+6]."</td>";
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
      				 					echo "<td>".$NamaKolomKriteriaDanSub[$Kolom+6]."</td>";
      				 				}
      				 			}
      				 			else {
      				 				if ($Kolom == 0) {
      				 					echo "<td>".$NomorPendaftaranSiswa[$Baris-1]."</td>";
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
                <table id="Rangking" class="table table-striped dataTable no-footer">
                  <thead>
                    <tr>
                    <?php for ($i=0; $i < count($MatrikAgregatDominan)+2; $i++) {
                      if ($i == count($MatrikAgregatDominan)+1) {
                        echo "<th>Rangking</th>";
                      }
                      if ($i == 0) {
                        echo "<th>".$NamaKolomKriteriaDanSub[$i]."</th>";
                      }
                      if ($i != 0 && $i < count($MatrikAgregatDominan)+1){
                        echo "<th>#</th>";
                      }
                    } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $HimpunanAlternatifTerbaik = array();
                    for ($Baris=0; $Baris < count($MatrikAgregatDominan); $Baris++) {
                      echo "<tr>";
                      $TotalNilaiAlternatif = 0;
                      for ($Kolom=0; $Kolom < count($MatrikAgregatDominan[0])+2; $Kolom++) {
                        if ($Kolom == 0) {
                          echo "<td>".$NomorPendaftaranSiswa[$Baris]."</td>";
                        }
                        else{
                          if ($Kolom < count($MatrikAgregatDominan[0])+1) {
                            echo "<td>".$MatrikAgregatDominan[$Baris][$Kolom-1]."</td>";
                          }
                          if ($Kolom == count($MatrikAgregatDominan[0])+1) {
                            echo "<td>".$TotalNilaiAlternatif."</td>";
                          }
                        }
                        if ($Baris != $Kolom && $Kolom < count($MatrikAgregatDominan[0])) {
                          $TotalNilaiAlternatif = $TotalNilaiAlternatif + $MatrikAgregatDominan[$Baris][$Kolom];
                        }
                      }
                      echo "</tr>";
                      array_push($HimpunanAlternatifTerbaik, $TotalNilaiAlternatif);
                    }
                  ?>
                  </tbody>
                </table></div></div>
                <?php 
                  $Rangking = array();
                  $RangkingSiswa = array();
                  $Indeks = 0;
                  arsort($HimpunanAlternatifTerbaik);
                  foreach ($HimpunanAlternatifTerbaik as $key => $value) {
                    array_push($Rangking, Array(0 => $NomorPendaftaranSiswa[$key]));
                    array_push($RangkingSiswa, Array('NomorPendaftaran' => $NomorPendaftaranSiswa[$key]));
                    $Rangking[$Indeks][1] = $value;
                    $RangkingSiswa[$Indeks]['Rangking'] = ($Indeks+1);
                    $Indeks++;
                  }
                  $this->db->update_batch('DataSiswa', $RangkingSiswa, 'NomorPendaftaran');
                 ?>
                 <h4>Rangking</h4>
                 <table id="classTable" class="table table-bordered">
                  <?php 
                    for ($Baris=0; $Baris < count($Rangking)+1; $Baris++) { 
                      if ($Baris == 0) {
                        echo "<thead>";
                      }
                      echo "<tr>";
                      for ($Kolom=0; $Kolom < count($Rangking[0])+1; $Kolom++) { 
                        if ($Baris == 0) {
                          if ($Kolom == 0) {
                            echo "<td>NomorPendaftaran</td>";
                          }
                          else if($Kolom == count($Rangking[0])-1){
                            echo "<td>Rangking</td>";
                          }
                          else {
                            echo "<td>Jumlah Preferensi</td>";
                          }
                        }
                        else {
                          if ($Kolom == 0) {
                            echo "<td>".$Rangking[$Baris-1][0]."</td>";
                          }
                          else if($Kolom == count($Rangking[0])-1){
                            echo "<td>".$Baris."</td>";
                          }
                          else {
                            echo "<td>".$Rangking[$Baris-1][$Kolom-1]."</td>";
                          }
                        }
                      }
                      if ($Baris == 0) {
                        echo "</thead>";
                      }
                      echo "</tr>";
                    }
                   ?>
                   <tbody>
                 </table>
                <?php } ?>
              </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
</div>
<script type="text/javascript">
  document.getElementById('IDMinat').value = document.getElementById('IdProdi').value;
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
  function PerhitunganElectre() {
    var x = document.getElementById("PerhitunganElectre");
    if (x.style.display === "none") {
      x.style.display = "grid";
    } else {
      x.style.display = "none";
    }
  }

  function GantiProdi(){
    document.getElementById('IDMinat').value = $("#IdProdi").val();
  }

  function TampilkanBobot(){
    // var Index = document.getElementById('BobotHistory').value.split('|');
    // document.getElementById('BobotKriteria1').selectedIndex = Index[0];
    // document.getElementById('BobotKriteria2').selectedIndex = Index[1];
    // document.getElementById('BobotKriteria3').selectedIndex = Index[2];
    // document.getElementById('MataPelajaran1').selectedIndex = Index[3];
    // document.getElementById('MataPelajaran2').selectedIndex = Index[4];
    // document.getElementById('MataPelajaran3').selectedIndex = Index[5];
    // document.getElementById('MataPelajaran4').selectedIndex = Index[6];
    // document.getElementById('MataPelajaran5').selectedIndex = Index[7];
    // document.getElementById('MataPelajaran6').selectedIndex = Index[8];
    // document.getElementById('MataPelajaran7').selectedIndex = Index[9];
    // document.getElementById('MataPelajaran8').selectedIndex = Index[10];
    // document.getElementById('MataPelajaran9').selectedIndex = Index[11];
    // document.getElementById('MataPelajaran10').selectedIndex = Index[12];
    // document.getElementById('MataPelajaran11').selectedIndex = Index[13];
    // document.getElementById('MataPelajaran12').selectedIndex = Index[14];
    // document.getElementById('MataPelajaran13').selectedIndex = Index[15];
    // document.getElementById('MataPelajaran14').selectedIndex = Index[16];
    // document.getElementById('MataPelajaran15').selectedIndex = Index[17];
    // var x = document.getElementById("FormPerhitungan");
    // if (x.style.display === "none") {
    //   x.style.display = "grid";
    // } else {
    //   x.style.display = "none";
    // }
  }

  function SimpanIndexBobot(){
    // var bobot1 = document.getElementById('BobotKriteria1').selectedIndex;
    // var bobot2 = document.getElementById('BobotKriteria2').selectedIndex;
    // var bobot3 = document.getElementById('BobotKriteria3').selectedIndex;
    // var bobot4 = document.getElementById('MataPelajaran1').selectedIndex;
    // var bobot5 = document.getElementById('MataPelajaran2').selectedIndex;
    // var bobot6 = document.getElementById('MataPelajaran3').selectedIndex;
    // var bobot7 = document.getElementById('MataPelajaran4').selectedIndex;
    // var bobot8 = document.getElementById('MataPelajaran5').selectedIndex;
    // var bobot9 = document.getElementById('MataPelajaran6').selectedIndex;
    // var bobot10 = document.getElementById('MataPelajaran7').selectedIndex;
    // var bobot11 = document.getElementById('MataPelajaran8').selectedIndex;
    // var bobot12 = document.getElementById('MataPelajaran9').selectedIndex;
    // var bobot13 = document.getElementById('MataPelajaran10').selectedIndex;
    // var bobot14 = document.getElementById('MataPelajaran11').selectedIndex;
    // var bobot15 = document.getElementById('MataPelajaran12').selectedIndex;
    // var bobot16 = document.getElementById('MataPelajaran13').selectedIndex;
    // var bobot17 = document.getElementById('MataPelajaran14').selectedIndex;
    // var bobot18 = document.getElementById('MataPelajaran15').selectedIndex;
    // var bobot = bobot1+"|"+bobot2+"|"+bobot3+"|"+bobot4+"|"+bobot5+"|"+bobot6+"|"+bobot7+"|"+bobot8+"|"+bobot9+"|"+bobot10+"|"+bobot11+"|"+bobot12+"|"+bobot13+"|"+bobot14+"|"+bobot15+"|"+bobot16+"|"+bobot17+"|"+bobot18;
    // var Data = { BOBOT : bobot };
    // $.post("http://localhost/SPK_SNMPTN/Admin/SimpanBobot", Data);
    // alert('Bobot Berhasil Disimpan')
  }

</script>
