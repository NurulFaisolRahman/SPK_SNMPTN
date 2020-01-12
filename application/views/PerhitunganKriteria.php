<?php
  //Menampilkan dan Melakukan Perhitungan Ketika Post
  if (!empty($_POST)) {
    // $SimpanPerbandinganBobot = array();
    //Membuat Array Untuk Perbandingan Bobot Kriteria
    $BobotKriteria = array();
    $Iterasi = 0;
    for ($i=$TotalKriteria-1; $i > 0; $i--) {
      $Iterasi = $Iterasi + $i;
    }
    for ($i=1; $i <= $Iterasi; $i++) {
      array_push($BobotKriteria, $_POST['BobotKriteria'.$i]);
      // array_push($SimpanPerbandinganBobot, $_POST['BobotKriteria'.$i]);
    }
    //Membuat Matrik Perbandingan Bobot Kriteria
    $DataBobotKriteria = array();
    for ($i=0; $i < $TotalKriteria; $i++) {
      $IsiBobot = array();
      for ($j=0; $j < $TotalKriteria; $j++) {
        if ($i == $j) {
          array_push($IsiBobot, 1);
        }
        else if ($j > $i) {
          array_push($IsiBobot, array_shift($BobotKriteria));
        }
        else {
          array_push($IsiBobot, 0);
        }
      }
      array_push($DataBobotKriteria, $IsiBobot);
    }
    for ($i=0; $i < $TotalKriteria; $i++) {
      $IsiBobot = array();
      for ($j=0; $j < $TotalKriteria; $j++) {
        if ($j < $i) {
          $DataBobotKriteria[$i][$j] = round(1/$DataBobotKriteria[$j][$i],2);
        }
      }
    }
    //Membuat Array Total Bobot Secara Vertikal
    $TotalBobotKriteriaVertical = array();
    for ($i=0; $i < $TotalKriteria; $i++) {
      $Tampung = 0;
      for ($j=0; $j < $TotalKriteria; $j++) {
        $Tampung = $Tampung + $DataBobotKriteria[$j][$i];
      }
      array_push($TotalBobotKriteriaVertical, $Tampung);
    }
    //Membuat Matrik Normalisasi Perbandingan Bobot Kriteria
    $DataBobotKriteriaNormalisasi = array();
    for ($i=0; $i < $TotalKriteria; $i++) {
      $IsiBobot = array();
      for ($j=0; $j < $TotalKriteria; $j++) {
        array_push($IsiBobot, $DataBobotKriteria[$i][$j]/$TotalBobotKriteriaVertical[$j]);
      }
      array_push($DataBobotKriteriaNormalisasi, $IsiBobot);
    }
    //Membuat Array Total Bobot Secara Horizontal
    $TotalBobotKriteriaHorizontal = array();
    $TotalKriteriaHorizontal = 0;
    for ($i=0; $i < $TotalKriteria; $i++) {
      $Tampung = 0;
      for ($j=0; $j < $TotalKriteria; $j++) {
        $Tampung = $Tampung + $DataBobotKriteriaNormalisasi[$i][$j];
      }
      $TotalKriteriaHorizontal = $TotalKriteriaHorizontal + $Tampung;
      array_push($TotalBobotKriteriaHorizontal, round($Tampung,2));
    }
    //Membuat Array Normalisasi Bobot
    $NormalisasiBobot = array();
    foreach ($TotalBobotKriteriaHorizontal as $key => $value) {
      array_push($NormalisasiBobot, round($value/$TotalKriteriaHorizontal,2));
    }
    //Menyimpan Bobot Setiap Kriteria
    $BobotSetiapKriteria = array();
    $Counter = 0;
    foreach ($Kriteria as $key) {
      $BobotSetiapKriteria[$key['IdKriteria']] = $NormalisasiBobot[$Counter];
      $Counter = $Counter + 1;
    }
    //Membuat Array Perkalian Bobot
    $Eigen = array();
    $HasilKaliBobot = array();
    $TampungNilai = 0;
    $TotalHasilKaliBobot = 0;
    for ($i=0; $i < $TotalKriteria; $i++) {
      $TampungNilai = 0;
      for ($j=0; $j < $TotalKriteria; $j++) {
        $TampungNilai = $TampungNilai + (round($DataBobotKriteria[$i][$j]*$NormalisasiBobot[$j],2));
      }
      array_push($HasilKaliBobot, $TampungNilai);
      array_push($Eigen, round($TampungNilai/$NormalisasiBobot[$i],2));
      $TotalHasilKaliBobot = $TotalHasilKaliBobot + $Eigen[$i];
    }
    $Rata2HasilKaliBobot = round($TotalHasilKaliBobot/$TotalKriteria,2);
    ?>
    <h3>Perbandingan Bobot Kriteria</h3>
    <table class="table table-bordered table-responsive">
      <tbody>
        <?php
          for ($i=0; $i < $TotalKriteria+2; $i++) {
            echo "<tr>";
            for ($j=0; $j < $TotalKriteria+1; $j++) {
              if ($i == 0) {
                if ($j > 0) {
                  echo "<td style='text-align:center;'>".$DataKriteria[$j]."</td>";
                }
                else {
                  echo "<td></td>";
                }
              }
              else {
                if ($j > 0) {
                  if ($i == $TotalKriteria+1) {
                    echo "<td style='text-align:center;'>".$TotalBobotKriteriaVertical[$j-1]."</td>";
                  }
                  else {
                    echo "<td style='text-align:center;color:'>".$DataBobotKriteria[$i-1][$j-1]."</td>";
                  }
                }
                else {
                  if ($i == $TotalKriteria+1) {
                    echo "<td style='text-align:center;'>Total</td>";
                  }
                  else {
                    echo "<td style='text-align:center;'>".$DataKriteria[$i][0]."</td>";
                  }
                }
              }
            }
          }
         ?>
        </tbody>
    </table>
    <h3>Normalisasi Bobot Kriteria</h3>
    <table class="table table-bordered table-responsive">
      <tbody>
        <?php
          for ($i=0; $i < $TotalKriteria+1; $i++) {
            echo "<tr>";
            for ($j=0; $j < $TotalKriteria+5; $j++) {
              if ($i == 0) {
                if ($j > 0 && $j < $TotalKriteria+1) {
                  echo "<td style='text-align:center;'>".$DataKriteria[$j][0]."</td>";
                }
                else if ($j == $TotalKriteria+1) {
                  echo "<td style='text-align:center;'>Total = ".$TotalKriteriaHorizontal."</td>";
                }
                else if ($j == $TotalKriteria+2) {
                  echo "<td style='text-align:center;'>Hasil Pembobotan = 1</td>";
                }
                else if ($j == $TotalKriteria+3) {
                  echo "<td style='text-align:center;'>Vector Eigen</td>";
                }
                else if ($j == $TotalKriteria+4) {
                  echo "<td style='text-align:center;'>Ternormalisasi Terbobot = ".$Rata2HasilKaliBobot."</td>";
                }
                else {
                  echo "<td></td>";
                }
              }
              else {
                if ($j > 0) {
                  if ($j == $TotalKriteria+1) {
                    echo "<td style='text-align:center;'>".$TotalBobotKriteriaHorizontal[$i-1]."</td>";
                  }
                  else if ($j == $TotalKriteria+2) {
                    echo "<td style='text-align:center;'>".$NormalisasiBobot[$i-1]."</td>";
                  }
                  else if ($j == $TotalKriteria+3) {
                    echo "<td style='text-align:center;'>".$HasilKaliBobot[$i-1]."</td>";
                  }
                  else if ($j == $TotalKriteria+4) {
                    echo "<td style='text-align:center;'>".$Eigen[$i-1]."</td>";
                  }
                  else {
                    echo "<td style='text-align:center;'>".round($DataBobotKriteriaNormalisasi[$i-1][$j-1],2)."</td>";
                  }
                }
                else {
                  echo "<td style='text-align:center;'>".$DataKriteria[$i][0]."</td>";
                }
              }
            }
          }
         ?>
        </tbody>
    </table>
    <?php
        $RI = array(1 => 0, 2 => 0, 3 => 0.58, 4 => 0.9, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49);
        $CI = ($Rata2HasilKaliBobot-$TotalKriteria)/($TotalKriteria-1);
        $CR = round($CI/$RI[$TotalKriteria],2);
        echo "<h3><b>CI = ".$CI."</b></h3>";
        if ($CR < 0.1) {
          echo "<h3><b>CR = ".$CR." => Konsisten</b></h3>";
        } else {
          echo "<h3><b>CR = ".$CR." => Tidak Konsisten</b></h3>";
        }
        include 'PerhitunganSubKriteria.php'
     ?>
  <?php }
  ?>
