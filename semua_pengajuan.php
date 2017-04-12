<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include 'system/koneksi.php';
session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='login.php';</script>";
 }
 else {
   $logged_in = true;
 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Master</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="black" data-image="assets/img/sidebar.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
<?php
 $query_login = "SELECT * FROM user WHERE email ='$_SESSION[email]'";
    $result_login = mysqli_query($con, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data_login = mysqli_fetch_assoc($result_login);
    $username_login = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( TIM ) - <?php echo $username_login ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li >
                    <a href="index.php">
                        <i class="pe pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="active">
                    <a href="pengajuan.php">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li>
                    <a href="notifikasi.php">
                        <i class="pe pe-7s-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>
                <li>
                    <a href="profil.php">
                        <i class="pe pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Data Pengajuan</h4>
                                    </div>  
                                    <div class="col-md-6" align="right">
                                        <a href="pengajuan.php">
                                            <button type="button" rel="tooltip" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-search"></i> Pengajuan Sendiri
                                            </button>
                                        </a>
                                        <a href="ajukan_pengajuan.php">
                                            <button type="button" rel="tooltip" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-plus"></i> Ajukan Pengajuan
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <br>    
                                <form id="form_pencarian"  action="pencarian_pengajuan.php" method="get">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> Judul Pengajuan</label>
                                                <input type="text" name="pengajuan" id="pengajuan" class="form-control" placeholder="Judul" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> Pengaju </label>
                                                <input type="text" name="pengaju" id="pengaju" class="form-control" placeholder="pengaju" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Tanggal Pengajuan</label>
                                                <input type="date" name="tanggal" id="tanggal" class="form-control"  value="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                    <label> Status</label>
                                                    <select name="status" form="form_pencarian" class="form-control"> 
                                                        <option value="">Semua</option>
                                                        <option value="menunggu">Menunggu</option>
                                                        <option value="proses">Proses</option>
                                                        <option value="selesai">Selesai</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label><br></label>
                                            <button type="submit" rel="tooltip" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-search"></i> Cari
                                            </button>
                                        </div>
                                </from>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Pengajuan</th>
                                        <th>Pengaju</th>
                                        <th>Jenis</th>
                                        <th>tanggal</th>
                                        <th>biaya</th>
                                        <th>status</th>
                                        <th>Tindak Lanjut</th>
                                    </thead>
                                    <tbody>
<?php
      $query = "SELECT a.id_pengajuan, a.pengajuan, a.id_user,  b.username, a.jenis_pengajuan, a.tanggal_pengajuan, 
                a.biaya, a.status FROM pengajuan AS a INNER JOIN user AS b WHERE a.id_user = b.id_user";
      $result = mysqli_query($con, $query);
      if(!$result){
        die ("Query Error: ".mysqli_errno($con).
           " - ".mysqli_error($con));
      }
      $no = 1;
      while($data = mysqli_fetch_assoc($result))
      {
                                        echo "<tr>";
                                            echo "<td>$no</td>";
                                            echo "<td>$data[pengajuan]</td>";
                                            echo "<td>$data[username]</td>";
                                            echo "<td>$data[jenis_pengajuan]</td>";
                                            echo "<td>$data[tanggal_pengajuan]</td>";
                                            echo "<td>$data[biaya]</td>";
                                            echo "<td>$data[status]</td>";
                                            echo '<td align="center">';
    if($data['username']== $username_login ){
        if($data['status'] == "menunggu" ){
                                            echo '
                                                <a href="detail_pengajuan.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill">
                                                        <i class="fa fa-eye"> </i>
                                                    </button>
                                                </a>
                                                <a href="edit_pengajuan.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Ubah Pengajuan" class="btn btn-primary btn-fill">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="system/hapus_user.php?id='.$data['id_pengajuan'].'" onclick="return confirm(\'Anda yakin akan menghapus data pengguna?\')">
                                                    <button type="button" rel="tooltip" title="Batalkan Pengajuan" class="btn btn-danger btn-fill">
                                                        <i class="fa fa-trash"> </i>
                                                    </button>
                                                </a>';
        }
        else if ($data['status'] == "proses" ){
                                            echo '
                                                <a href="detail_pengajuan.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill">
                                                        <i class="fa fa-eye"> </i>
                                                    </button>
                                                </a>';
        }
        else{
                                            echo '
                                                <a href="detail_pengajuan.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="system/hapus_user.php?id='.$data['id_pengajuan'].'" onclick="return confirm(\'Anda yakin akan menghapus data pengguna?\')">
                                                    <button type="button" rel="tooltip" title="Batalkan Pengajuan" class="btn btn-danger btn-fill">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>';
        }
    }
    else {
        echo '
                                                <a href="detail_pengajuan.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>';

    }
                                            echo '</td>';
                                        echo "</tr>";
                                        $no++;
    }
?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
        });
    </script>

</html>