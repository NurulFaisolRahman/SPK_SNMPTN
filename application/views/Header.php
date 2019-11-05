<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Program Studi</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-mini"><b>SPK</b></span>
                <span class="logo-lg"><b>Admin</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    <li>
                      <a href="http://localhost/SPK_SNMPTN/Login/LogOut"><i class="fa fa-lock"> Log Out</i></a>
                    </li>
                  </ul>
                </div>
            </nav>
        </header>
        <?php
          $Menu = array('Data Siswa' => 'http://localhost/SPK_SNMPTN/Admin/Siswa',
                        'Program Studi' => 'http://localhost/SPK_SNMPTN/Admin/Prodi',
                        'Kriteria' => 'http://localhost/SPK_SNMPTN/Admin/Kriteria',
                        'Sub Kriteria' => 'http://localhost/SPK_SNMPTN/Admin/SubKriteria');
         ?>
        <aside class="main-sidebar">
            <section class="sidebar">
                <?php
                  foreach ($Menu as $key => $value) {?>
                    <ul class="sidebar-menu">
                        <li class="">
                            <a href="<?php echo $value ?>">
                                <i class="fa fa-book"></i> <span><b><?php echo $key ?></b></span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
            </section>
        </aside>
