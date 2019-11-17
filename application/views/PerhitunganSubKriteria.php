<?php
  foreach ($Kriteria as $key) {
    $DataSubKriteria = $this->db->get_where('SubKriteria', array('IdKriteria' => $key['IdKriteria']))->result_array();
    if (!empty($DataSubKriteria)) {
      //Membuat Array Untuk Nama2 SubKriteria
      $NamaKriteria = $key['NamaKriteria'];
      $TampungSubKriteria = array();
      array_push($TampungSubKriteria, 'Dummy');
      $JumlahSubKriteria = count($DataSubKriteria);
      foreach ($DataSubKriteria as $row) {
        array_push($TampungSubKriteria, $row['NamaSubKriteria']);
      }
      //Membuat Array Untuk Perbandingan Bobot SubKriteria
      $BobotSubKriteria = array();
      for ($i=1; $i <= $JumlahSubKriteria; $i++) {
        array_push($BobotSubKriteria, $_POST[$NamaKriteria.$i]);
      }
      $CopyBobotSubKriteria = $BobotSubKriteria;
      //Membuat Matrik Perbandingan Bobot SubKriteria
      $DataBobotSubKriteria = array();
      for ($i=0; $i < $JumlahSubKriteria; $i++) {
        $IsiBobot = array();
        for ($j=0; $j < $JumlahSubKriteria; $j++) {
          if ($i == $j) {
            array_push($IsiBobot, 1);
          }
          else if ($j > $i) {
            array_push($IsiBobot, array_shift($BobotSubKriteria));
          }
          else {
            array_push($IsiBobot, round(1/array_shift($CopyBobotSubKriteria),2));
          }
        }
        array_push($DataBobotSubKriteria, $IsiBobot);
      }
      //Membuat Array Total Bobot Secara Vertikal
      $TotalBobotSubKriteriaVertical = array();
      for ($i=0; $i < $JumlahSubKriteria; $i++) {
        $Tampung = 0;
        for ($j=0; $j < $JumlahSubKriteria; $j++) {
          $Tampung = $Tampung + $DataBobotSubKriteria[$j][$i];
        }
        array_push($TotalBobotSubKriteriaVertical, $Tampung);
      }
      //Membuat Matrik Normalisasi Perbandingan Bobot SubKriteria
      $DataBobotSubKriteriaNormalisasi = array();
      for ($i=0; $i < $JumlahSubKriteria; $i++) {
        $IsiBobot = array();
        for ($j=0; $j < $JumlahSubKriteria; $j++) {
          array_push($IsiBobot, $DataBobotSubKriteria[$i][$j]/$TotalBobotSubKriteriaVertical[$j]);
        }
        array_push($DataBobotSubKriteriaNormalisasi, $IsiBobot);
      }
      //Membuat Array Total Bobot Secara Horizontal
      $TotalBobotSubKriteriaHorizontal = array();
      $TotalSubKriteriaHorizontal = 0;
      for ($i=0; $i < $JumlahSubKriteria; $i++) {
        $Tampung = 0;
        for ($j=0; $j < $JumlahSubKriteria; $j++) {
          $Tampung = $Tampung + $DataBobotSubKriteriaNormalisasi[$i][$j];
        }
        $TotalSubKriteriaHorizontal = $TotalSubKriteriaHorizontal + $Tampung;
        array_push($TotalBobotSubKriteriaHorizontal, round($Tampung,2));
      }
      //Membuat Array Normalisasi Bobot
      $NormalisasiBobotSubKriteria = array();
      foreach ($TotalBobotSubKriteriaHorizontal as $key => $value) {
        array_push($NormalisasiBobotSubKriteria, round($value/$TotalSubKriteriaHorizontal,2));
      }
      //Membuat Array Perkalian Bobot
      $Eigen = array();
      $HasilKaliBobot = array();
      $TampungNilai = 0;
      $TotalHasilKaliBobot = 0;
      for ($i=0; $i < $JumlahSubKriteria; $i++) {
        $TampungNilai = 0;
        for ($j=0; $j < $JumlahSubKriteria; $j++) {
          $TampungNilai = $TampungNilai + (round($DataBobotSubKriteria[$i][$j]*$NormalisasiBobotSubKriteria[$j],2));
        }
        array_push($HasilKaliBobot, $TampungNilai);
        array_push($Eigen, round($TampungNilai/$NormalisasiBobotSubKriteria[$i],2));
        $TotalHasilKaliBobot = $TotalHasilKaliBobot + $Eigen[$i];
      }
      $Rata2HasilKaliBobot = round($TotalHasilKaliBobot/$JumlahSubKriteria,2);
      ?>
      <h3>Perbandingan Bobot Sub Kriteria</h3>
      <table class="table table-bordered table-responsive">
        <tbody>
          <?php
            for ($i=0; $i < $JumlahSubKriteria+2; $i++) {
              echo "<tr>";
              for ($j=0; $j < $JumlahSubKriteria+1; $j++) {
                if ($i == 0) {
                  if ($j > 0) {
                    echo "<td style='text-align:center;'>".$TampungSubKriteria[$j]."</td>";
                  }
                  else {
                    echo "<td></td>";
                  }
                }
                else {
                  if ($j > 0) {
                    if ($i == $JumlahSubKriteria+1) {
                      echo "<td style='text-align:center;'>".$TotalBobotSubKriteriaVertical[$j-1]."</td>";
                    }
                    else {
                      echo "<td style='text-align:center;color:'>".$DataBobotSubKriteria[$i-1][$j-1]."</td>";
                    }
                  }
                  else {
                    if ($i == $JumlahSubKriteria+1) {
                      echo "<td style='text-align:center;'>Total</td>";
                    }
                    else {
                      echo "<td style='text-align:center;'>".$TampungSubKriteria[$i][0]."</td>";
                    }
                  }
                }
              }
            }
           ?>
        </tbody>
      </table>
      <h3>Normalisasi Bobot Sub Kriteria</h3>
      <table class="table table-bordered table-responsive">
        <tbody>
          <?php
            for ($i=0; $i < $JumlahSubKriteria+1; $i++) {
              echo "<tr>";
              for ($j=0; $j < $JumlahSubKriteria+5; $j++) {
                if ($i == 0) {
                  if ($j > 0 && $j < $JumlahSubKriteria+1) {
                    echo "<td style='text-align:center;'>".$TampungSubKriteria[$j][0]."</td>";
                  }
                  else if ($j == $JumlahSubKriteria+1) {
                    echo "<td style='text-align:center;'>Total = ".$TotalSubKriteriaHorizontal."</td>";
                  }
                  else if ($j == $JumlahSubKriteria+2) {
                    echo "<td style='text-align:center;'>Normalisasi = 1</td>";
                  }
                  else if ($j == $JumlahSubKriteria+3) {
                    echo "<td style='text-align:center;'>Hasil Kali</td>";
                  }
                  else if ($j == $JumlahSubKriteria+4) {
                    echo "<td style='text-align:center;'>Eigen, Rata2 = ".$Rata2HasilKaliBobot."</td>";
                  }
                  else {
                    echo "<td></td>";
                  }
                }
                else {
                  if ($j > 0) {
                    if ($j == $JumlahSubKriteria+1) {
                      echo "<td style='text-align:center;'>".$TotalBobotSubKriteriaHorizontal[$i-1]."</td>";
                    }
                    else if ($j == $JumlahSubKriteria+2) {
                      echo "<td style='text-align:center;'>".$NormalisasiBobotSubKriteria[$i-1]."</td>";
                    }
                    else if ($j == $JumlahSubKriteria+3) {
                      echo "<td style='text-align:center;'>".$HasilKaliBobot[$i-1]."</td>";
                    }
                    else if ($j == $JumlahSubKriteria+4) {
                      echo "<td style='text-align:center;'>".$Eigen[$i-1]."</td>";
                    }
                    else {
                      echo "<td style='text-align:center;'>".round($DataBobotSubKriteriaNormalisasi[$i-1][$j-1],2)."</td>";
                    }
                  }
                  else {
                    echo "<td style='text-align:center;'>".$TampungSubKriteria[$i][0]."</td>";
                  }
                }
              }
            }
           ?>
          </tbody>
      </table>
      <?php
          $RI = array(1 => 0, 2 => 0, 3 => 0.58, 4 => 0.9, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49);
          $CI = ($Rata2HasilKaliBobot-$JumlahSubKriteria)/($JumlahSubKriteria-1);
          $CR = round($CI/$RI[$JumlahSubKriteria],2);
          echo "<h3><b>CI = ".$CI."</b></h3>";
          if ($CR < 0.1) {
            echo "<h3><b>CR = ".$CR." => Konsisten</b></h3>";
          } else {
            echo "<h3><b>CR = ".$CR." => Tidak Konsisten</b></h3>";
          }
       ?>
  <?php
    }
  }
 ?>
