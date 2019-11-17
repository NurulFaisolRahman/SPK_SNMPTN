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
                            <a class="btn btn-success" data-toggle="modal" data-target="#my-modal1"><li class="fa fa-plus"></li> Input Bobot</a>
                        </td>
                    </tr>
                        <?php
                $no++;
                }?>
                </tbody>
              </table>
              <?php include 'PerhitunganKriteria.php' ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
</div>
<form method="post">
    <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body center">
                  <table class="table table-bordered table-responsive">
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
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><b>Perbandingan Bobot</b></h4>
                  </div>
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
                                <?php for ($k=1; $k <= 9; $k++) {?>
                                  <option value="<?php echo $k;?>"><?php echo $k;?></option>
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
                                  <select class="form-control" name="<?php echo $key['NamaKriteria'].$counter; ?>">
                                  <?php for ($k=1; $k <= 9; $k++) {?>
                                    <option value="<?php echo $k;?>"><?php echo $k;?></option>
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
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-info"> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
