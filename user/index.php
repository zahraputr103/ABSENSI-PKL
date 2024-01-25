<?php
require "../config/koneksi.php";
$get1 = mysqli_query($conn, "select * from absen where status='hadir'");
$count1 = mysqli_num_rows($get1);
$get2 = mysqli_query($conn, "select * from absen where status='izin'");
$count2 = mysqli_num_rows($get2);
$get3 = mysqli_query($conn, "select * from absen where status='sakit'");
$count3 = mysqli_num_rows($get3);


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
    <title> DASHBOARD </title>
    <link rel="stylesheet" type="text/css" href="../css/style-user.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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
          <a href="index.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="hadir/absen.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Absensi</span>
          </a>
        </li>
        <li>
          <a href="kegiatan/kegiatan.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Kegiatan Harian</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../login/logout.php">
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
        <span class="dashboard">Absensi</span>
      </div>
      <div class="profile-details">
      <img src="pic/dew.jpg" alt="">
        <span class="admin_name" style="padding-left:10px;"><?php echo $_SESSION['username']; ?></span> 
      </div>
</nav>
<div class="home-content">
      <div class="overview-boxes">
      <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Hadir</div>
            <div class="number"><?= $count1;?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-calendar-check cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Izin</div>
            <div class="number"><?= $count2;?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-notepad cart four' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sakit</div>
            <div class="number"><?= $count3;?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-band-aid cart three' ></i>
        </div>
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