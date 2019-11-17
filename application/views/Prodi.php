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
