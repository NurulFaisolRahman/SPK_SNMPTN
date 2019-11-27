<?php
  $Matrik = array();
  foreach ($Siswa as $key => $value) {
    $DataNilaiSiswa = array();
    for ($i = 3; $i < count($FormSiswa); $i++) {
      $NamaKolom = $FormSiswa[$i]['COLUMN_NAME'];
      array_push($DataNilaiSiswa, $value[$NamaKolom]);
    }
    array_push($Matrik, $DataNilaiSiswa);
  }
  // Menghitung Nilai X
  $Nilai_X = array();
  for ($i = 0; $i < count($Matrik[0]); $i++) {
    $JumlahKriteria = 0;
    for ($j = 0; $j < count($Matrik); $j++) {
      $JumlahKriteria += pow($Matrik[$j][$i],2);
    }
    array_push($Nilai_X, round(sqrt($JumlahKriteria),5));
  }
  // Menghitung Matrik Ternormalisasi
  $MatrikNormalisasi = array();
  for ($i = 0; $i < count($Matrik); $i++) {
    $Nilai_R = array();
    for ($j = 0; $j < count($Matrik[0]); $j++) {
      $Nilai = $Matrik[$i][$j]/$Nilai_X[$j];
      array_push($Nilai_R, round($Nilai,5));
    }
    array_push($MatrikNormalisasi, $Nilai_R);
  }
  //Perkalian Bobot Dengan Matrik Ternormalisasi
  $MatrikTerboboti = array();
  for ($i = 0; $i < count($Matrik); $i++) {
    $PerkalianBobot = array();
    for ($j = 0; $j < count($Matrik[0]); $j++) {
      $Nilai = $MatrikNormalisasi[$i][$j]*$BobotDataSiswa[$j];
      array_push($PerkalianBobot, round($Nilai,5));
    }
    array_push($MatrikTerboboti, $PerkalianBobot);
  }
 ?>
