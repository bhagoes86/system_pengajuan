<?php
  include '../system/koneksi.php';



session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
    echo "<script type='text/javascript'>document.location='../login?proses=error ';</script>";
 }
 else {
   $logged_in = true;
 }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>User</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/dist/sweetalert.css">
  <script src="../assets/dist/sweetalert-dev.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="../assets/img/1.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
<?php
 $query_login = "SELECT * FROM user WHERE email ='$_SESSION[email]'";
    $result_login = mysqli_query($con, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data_login = mysqli_fetch_assoc($result_login);
    $username = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index">
                        <i class="pe pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="pengajuan">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li>
                    <a href="riwayat">
                        <i class="pe pe-7s-timer"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="active">
                    <a data-toggle="collapse" href="#componentsExamples" aria-expanded="true">
                        <i class="pe-7s-server"></i>
                        <p>Master</p>
                    </a>
                    <div class="collapse in" id="componentsExamples">
                        <ul class="nav">
                            <li class="active"><a href="user">User</a></li>
                            <li><a href="jenis_pengajuan">Jenis Pengajuan</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" onclick = "logout()">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>

                <script type="text/javascript">
                    function logout() {
                        swal({
                            title: "Konfirmasi ?",
                            text: "Apakah anda ingin keluar ",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#00cc00", 
                            confirmButtonText: "Logout",
                            cancelButtonText: "Batal",
                            closeOnConfirm: false
                        },
                        function(){
                            document.location="../logout";
                        })
                    }
                </script>

            </ul>
    	</div>
    </div>
<?php
if (isset($_GET['proses'])) {
    $proses = ($_GET["proses"]);
    if($proses == "delete"){
        echo'<script>
            swal({
                title: "Terhapus!",
                text: "Data user telah dihapus.",
                type: "success",
                showConfirmButton: true,
                confirmButtonColor: "#00ff00"
            })
        </script>';
    }
    else if ($proses == "edit") { 
        echo'<script>
            swal({
                title: "Terubah!",
                text: "Data user telah diubah.",
                type: "success",
                showConfirmButton: true,
                confirmButtonColor: "#00ff00"
            })
        </script>';
    }
  } 
?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Data Pengguna</h4>
                                        <a href="master"><p class="category"><i class="fa fa-arrow-left"></i> Klik di sini untuk kembali ke menu Master</p></a>
                                    </div>  
                                    <div class="col-md-6" align="right">
                                        <a href="tambah_user">
                                            <button type="button" class="btn btn-info btn-fill">
                                                <i class="fa fa-plus"></i> Tambah Pengguna
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <form id="form_pencarian"  action="pencarian_user" method="get">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="cari" id="cari" class="form-control" placeholder="Pencarian..." >
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-search"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Username</th>
                                    	<th>Email</th>
                                        <th>Role</th>
                                    	<th>Detail</th>
                                    </thead>
                                    <tbody>

<?php
      $query_user = "SELECT * FROM user ORDER BY id_user" ;
      $result_user = mysqli_query($con, $query_user);
      if(!$result_user){
        die ("Query Error: ".mysqli_errno($con).
           " - ".mysqli_error($con));
      }
      $query_tim = "SELECT * FROM user WHERE ROLE = 'tim'" ;
      $result_tim = mysqli_query($con, $query_tim);
      $no = 1;
      while($data_user = mysqli_fetch_assoc($result_user))
      {
                                        echo "<tr>";
                                            echo "<td>$no</td>";
                                        	echo "<td>$data_user[username]</td>";
                                            echo "<td>$data_user[email]</td>";
                                            echo "<td>$data_user[role]</td>";
                                            echo '<td> 
                                                <a href="detail_user?id='.$data_user['id_user'].'">
                                                    <button type="button" class="btn btn-info btn-sm btn-fill">
                                                        <i class="fa fa-eye"></i> Detail
                                                    </button>
                                                </a>';
                                            echo"</td>";
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
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){
        	demo.initChartist();
    	});
	</script>

</html>
