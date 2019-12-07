<?php
  $Pisah = explode("|",$_POST['IDMinat']);
  $Siswa = $this->db->get_where('DataSiswa', array('IdProdi' => $Pisah[0], 'Tahun' => $Pisah[1]))->result_array();
  $Matrik = array();
  foreach ($Siswa as $key => $value) {
    $DataNilaiSiswa = array();
    for ($i = 4; $i < count($FormSiswa); $i++) {
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
      $Nilai = round($Matrik[$i][$j]/$Nilai_X[$j],5);
      array_push($Nilai_R, $Nilai);
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
  //Langkah 3 dan 4 Menghitung Matrik Concordance dan Discordance<
  $MatrikConcordance = array();
  $MatrikDiscordance = array();
  $NilaiThresholdConcordance = 0;
  $NilaiThresholdDiscordance = 0;
  for ($i = 0; $i < count($Matrik); $i++) {
    $BarisConcordance = array();
    $BarisDiscordance = array();
    for ($j = 0; $j < count($Matrik); $j++) {
      if ($i != $j) {
        $BobotConcordance = 0;
        $HimpunanPenyebut = array();
        $HimpunanPembilang = array();
        for ($k = 0; $k < count($Matrik[0]); $k++) {
          array_push($HimpunanPembilang, abs($MatrikTerboboti[$i][$k] - $MatrikTerboboti[$j][$k]));
          if ($MatrikTerboboti[$i][$k] >= $MatrikTerboboti[$j][$k]) {
            $BobotConcordance = $BobotConcordance + $BobotDataSiswa[$k];
          }
          else {
            array_push($HimpunanPenyebut, abs($MatrikTerboboti[$i][$k] - $MatrikTerboboti[$j][$k]));
          }
        }
        $NilaiThresholdConcordance = $NilaiThresholdConcordance + $BobotConcordance;
        array_push($BarisConcordance, $BobotConcordance);
        if (!empty($HimpunanPenyebut)) {
          array_push($BarisDiscordance, (round(max($HimpunanPenyebut)/max($HimpunanPembilang),3)));
          $NilaiThresholdDiscordance = $NilaiThresholdDiscordance + (round(max($HimpunanPenyebut)/max($HimpunanPembilang),3));
        }
        else{
          array_push($BarisDiscordance, 0);
        }

      }
      else {
        array_push($BarisConcordance, "-");
        array_push($BarisDiscordance, "-");
      }
    }
    array_push($MatrikConcordance, $BarisConcordance);
    array_push($MatrikDiscordance, $BarisDiscordance);
    }
    //Langkah 5 Menghitung Matrik Dominan Concordance dan Discordance
    $NilaiThresholdConcordance = round($NilaiThresholdConcordance / (count($MatrikConcordance)*(count($MatrikConcordance)-1)),2);
    $NilaiThresholdDiscordance = round($NilaiThresholdDiscordance / (count($MatrikConcordance)*(count($MatrikConcordance)-1)),2);
    // echo "C = ".$NilaiThresholdConcordance." D = ".$NilaiThresholdDiscordance;
    $MatrikDominanConcordance = $MatrikConcordance;
    $MatrikDominanDiscordance = $MatrikDiscordance;
    for ($i = 0; $i < count($MatrikConcordance); $i++) {
      for ($j = 0; $j < count($MatrikConcordance); $j++) {
        if ($i != $j) {
          if ($MatrikDominanConcordance[$i][$j] >= $NilaiThresholdConcordance) {
            $MatrikDominanConcordance[$i][$j] = 1;
          }
          else {
            $MatrikDominanConcordance[$i][$j] = 0;
          }
          if ($MatrikDominanDiscordance[$i][$j] >= $NilaiThresholdDiscordance) {
            $MatrikDominanDiscordance[$i][$j] = 0;
          }
          else {
            $MatrikDominanDiscordance[$i][$j] = 1;
          }
        }
      }
    }
    //Langkah 6 Menetukan Agregat Dominan Matrik";
    $MatrikAgregatDominan = $MatrikConcordance;
    for ($i = 0; $i < count($MatrikConcordance); $i++) {
      for ($j = 0; $j < count($MatrikConcordance); $j++) {
        if ($i != $j) {
          $MatrikAgregatDominan[$i][$j] = $MatrikDominanConcordance[$i][$j] * $MatrikDominanDiscordance[$i][$j];
        }
      }
    }
 ?>
