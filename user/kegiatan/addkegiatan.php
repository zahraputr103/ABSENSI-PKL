<?php
require "../../config/koneksi.php";
// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if( tambahkegiatan($_POST) > 0 ) {
      echo "
      <script>
      alert('berhasil ditambahkan');
      document.location.href = 'kegiatan.php';
      </script>
      ";
  
    } else {
      echo "
      <script>
      alert('gagal ditambahkan');
      document.location.href = 'kegiatan.php';
      </script>
      ";
    }
  }
  
  // Set tanggal ke tanggal saat ini 
  $_POST["tanggal"] = date('Y-m-d');


  // Mengecek apakah sudah ada catatan kegiatan untuk tanggal tersebut
  $existingKegiatan= getKegiatanByDate1($_POST["tanggal"]);

  if ($existingKegiatan) {
      echo "
      <script>
      alert('Anda sudah isi kegiatan pada hari ini');
      document.location.href = 'kegiatan.php';
      </script>
      ";
      exit(); // Menghentikan eksekusi jika sudah ada catatan absen
  }

session_start();
if($_SESSION['tingkat'] !== "siswa") {
  echo '<script>
                    alert("username atau Password Salah!");
                    document.location.href="../login/sign.php";
                    </script>';
            exit; 
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> KEGIATAN HARIAN > INPUT KEGIATAN </title>
    <link rel="stylesheet" type="text/css" href="../../css/style-user.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-home'></i>
      <span class="logo_name">Rumah IT Bandung</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="../index.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../hadir/absen.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Absensi</span>
          </a>
        </li>
        <li>
          <a href="kegiatan.php" class="active">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Kegiatan Harian</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../../login/logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">INPUT ABSEN</span>
      </div>
      <div class="profile-details">
      <img src="../pic/dew.jpg" alt="">
        <span class="admin_name" style="padding-left:10px;"><?php echo $_SESSION['username']; ?></span> 
      </div>
     </nav>
     
     <div class="home-content">
     <div class="container-xl">
     <div class="table-responsive">
     <div class="table-wrapper">
      <div class="col-6">
  <div class="mb-3">
  <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                   <!-- Tanggal dihilangkan dan nilainya diatur secara otomatis -->
                   <input type="hidden" name="tanggal" class="form-control" id="tanggal" value="<?= date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                <label class="control-label" for="bidang_pekerjaan">Bidang Pekerjaan</label>
                <input type="text" name="bidang_pekerjaan" class="form-control" id="bidang_pekerjaan">
            </div>
            <div class="form-group">
                <label class="control-label" for="kegiatan">Kegiatan</label>
                <input type="text" name="kegiatan" class="form-control" id="kegiatan">
            </div>
            <div class="modal-footer">
                <a href="kegiatan.php" class="btn btn-secondary">Cancel</a>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
            </div>
      </div>
   </div>
     </div>
     </div>
     </div>
     </form>
</section>

<script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

 </script>
</body>
</html>

