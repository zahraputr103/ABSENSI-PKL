<?php
require "../../config/koneksi.php";

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

      // cek apakah data berhasil di tambahkan atau tidak
  if( add($_POST) > 0 ) {
    echo "
    <script>
    alert('absen berhasil');
    document.location.href = 'absen.php';
    </script>
    ";

  } else {
    echo "
    <script>
    alert('absen gagal');
    document.location.href = 'absen.php';
    </script>
    ";
  }

}

 // Set tanggal ke tanggal saat ini 
 $_POST["tanggal"] = date('Y-m-d');


// Mengecek apakah sudah ada catatan absen untuk tanggal tersebut
    $existingAbsen = getAbsenByDate($_POST["tanggal"]);

    if ($existingAbsen) {
        echo "
        <script>
        alert('Anda sudah absen pada hari ini');
        document.location.href = 'absen.php';
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
    <title> ABSENSI > INPUT ABSENSI </title>
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
          <a href="absen.php" class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Absensi</span>
          </a>
        </li>
        <li>
          <a href="../kegiatan/kegiatan.php">
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
            <label class="control-label" for="status">Status</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="Hadir">
              <label class="form-check-label" for="flexRadioDefault1">Hadir</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="Izin">
              <label class="form-check-label" for="flexRadioDefault2">Izin</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault3" value="Sakit">
              <label class="form-check-label" for="flexRadioDefault3">Sakit</label>
            </div>
           
            <div class="form-group">
                <label class="control-label" for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan">

            </div>
            <div class="modal-footer">
                <a href="absen.php" class="btn btn-secondary">Cancel</a>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-success" name="submit" value="submit">Simpan</button>
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

document.addEventListener('DOMContentLoaded', function () {
    // Function to toggle the attachment form based on the selected radio button
    function toggleAttachmentForm() {
      const attachmentForm = document.getElementById('keterangan');
      const statusRadioButtons = document.getElementsByName('status');

      // Loop through radio buttons to find the selected one
      let selectedStatus = '';
      for (const radioButton of statusRadioButtons) {
        if (radioButton.checked) {
          selectedStatus = radioButton.value;
          break;
        }
      }

      // Enable or disable the attachment form based on the selected status
      attachmentForm.disabled = selectedStatus !== 'Izin' && selectedStatus !== 'Sakit';
    }

    // Attach event listeners to the radio buttons to update the attachment form status
    const statusRadioButtons = document.getElementsByName('status');
    for (const radioButton of statusRadioButtons) {
      radioButton.addEventListener('change', toggleAttachmentForm);
    }

    // Initialize the attachment form status based on the default selected radio button
    toggleAttachmentForm();
  });

 </script>
</body>
</html>

