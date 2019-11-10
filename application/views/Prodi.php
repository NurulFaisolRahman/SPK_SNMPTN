        <div class="content-wrapper">
            <section class="content-header">
                <h1>Program Studi</h1>
            </section>
            <section class="content">
                <?php
                    $config = mysqli_connect("localhost", "root", "","spk");
                    error_reporting(0);
                    $id=$_GET['id'];
                    $sql="SELECT  * FROM Prodi where IdProdi='$id' ";
                    if (!$result = mysqli_query($config, $sql)){
                    die('Error:'.mysqli_error($config));
                    }  else {
                    if (mysqli_num_rows($result)> 0){
                    while ($row=  mysqli_fetch_assoc($result)){
                ?>
                <div class="box">
                <div class="box-header with-border">
                      Edit Nama Prodi
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                    <form>
                      <div class="box-body">
                            <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nama Prodi</label>
                        <input type="hidden" id="EditIdProdi" value="<?php echo $row['IdProdi'];?>" class="form-control" required="">
                        <input type="text" id="EditNamaProdi" value="<?php echo $row['NamaProdi'];?>" class="form-control" required="">
                        </div>
                     <div class="col-md-12 form-group">
                       <button type="submit" id="UpdateProdi" class="btn btn-primary btn-flat pull-right"><span class="fa fa-send"></span> Simpan</button>
                     </div>
                    </div>
                      </div>
                    </form>
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
                            <th>Nama Prodi</th>
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
                                    <a href="<?php $_SERVER[SCRIPT_NAME] ;?>?id=<?php echo $row['IdProdi'];?>" class="btn btn-info"><li class="fa fa-pencil"></li> Edit</a>
                                    <a HapusIdProdi=<?php echo $row['IdProdi'];?> class="btn btn-danger HapusProdi"><li class="fa fa-trash-o"></li> Hapus</a>
                                    <!-- <a BobotKriteria=<?php echo "'".$row['NamaProdi']."'";?> class="btn btn-success BobotKriteria" data-toggle="modal" data-target="#my-modal2"><li class="fa fa-plus"></li> Bobot Kriteria</a>
                                    <a BobotSubKriteria=<?php echo "'".$row['NamaProdi']."'";?> class="btn btn-warning BobotSubKriteria" data-toggle="modal" data-target="#my-modal3"><li class="fa fa-plus"></li> Bobot SubKriteria</a> -->
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
        <form>
            <div class="modal fade" id="my-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Tambah Program Studi</h4>
                        </div>
                        <div class="modal-body center">
                            <div class="form-group">
                                <label>Nama Prodi</label>
                                <input type="text" id="NamaProdiBaru" class="form-control" required="" placeholder="Masukkan Nama Program Studi">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                            <button type="submit" id="TambahProdi" class="btn btn-info"> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form>
            <div class="modal fade" id="my-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Perbandingan Bobot Kriteria</h4>
                        </div>
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
                            <div class="form-group">
                              <input type="hidden" id="NamaProdiKriteria"  class="form-control">
                              <div class="container-fluid">
                                <?php
                                  $DataKriteria = array();
                                  foreach ($Kriteria as $row) {
                                    array_push($DataKriteria, $row['NamaKriteria']);
                                  }
                                  $x = 0;
                                  $counter = 0;
                                  for ($i=$TotalKriteria-1; $i > 0; $i--) {
                                    $y = $x;
                                    for ($j=0; $j < $i; $j++) {
                                      echo "<div class='row align-items-center'>";
                                      $y = $y + 1;
                                      $counter = $counter + 1;?>
                                      <div class="col-sm-2">
                                        <label><?php echo $DataKriteria[$x];?></label>
                                      </div>
                                      <div class="col-sm-8">
                                        <select class="form-control" id="<?php echo "Bobot".$counter; ?>">
                                        <?php for ($k=1; $k <= 9; $k++) {?>
                                          <option value="<?php echo $k;?>"><?php echo $k;?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <label><?php echo $DataKriteria[$y];?></label>
                                      </div>
                                    </div><br>
                                    <?php }
                                    $x = $x + 1;
                                  }
                                 ?>
                             </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                            <button type="submit" id="SimpanBobotKriteria" class="btn btn-info"> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form>
            <div class="modal fade" id="my-modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Perbandingan Bobot Sub Kriteria</h4>
                        </div>
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
                            <div class="form-group">
                              <input type="hidden" id="NamaProdiKriteria"  class="form-control">
                              <div class="container-fluid">
                                <?php
                                  $DataKriteria = array();
                                  foreach ($Kriteria as $row) {
                                    array_push($DataKriteria, $row['NamaKriteria']);
                                  }
                                  $x = 0;
                                  $counter = 0;
                                  for ($i=$TotalKriteria-1; $i > 0; $i--) {
                                    $y = $x;
                                    for ($j=0; $j < $i; $j++) {
                                      echo "<div class='row align-items-center'>";
                                      $y = $y + 1;
                                      $counter = $counter + 1;?>
                                      <div class="col-sm-2">
                                        <label><?php echo $DataKriteria[$x];?></label>
                                      </div>
                                      <div class="col-sm-8">
                                        <select class="form-control" id="<?php echo "Bobot".$counter; ?>">
                                        <?php for ($k=1; $k <= 9; $k++) {?>
                                          <option value="<?php echo $k;?>"><?php echo $k;?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <label><?php echo $DataKriteria[$y];?></label>
                                      </div>
                                    </div><br>
                                    <?php }
                                    $x = $x + 1;
                                  }
                                 ?>
                             </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                            <button type="submit" id="SimpanBobotKriteria" class="btn btn-info"> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
