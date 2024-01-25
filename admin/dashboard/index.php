<?php
require "../../config/koneksi.php";
$get1 = mysqli_query($conn, "select * from siswa");
$count1 = mysqli_num_rows($get1);

$get2 = mysqli_query($conn, "select * from rekap_absen where status = 'hadir'");
$count2 = mysqli_num_rows($get2);

$get3 = mysqli_query($conn, "select * from rekap_absen where status = 'sakit'");
$count3 = mysqli_num_rows($get3);

$get4 = mysqli_query($conn, "select * from rekap_absen where status = 'izin'");
$count4 = mysqli_num_rows($get4);

session_start();
if($_SESSION['tingkat'] == "") {
  echo '<script>
          alert("username atau Password Salah!");
          document.location.href="../../login/sign.php";
        </script>';
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" type="text/css" href="../../css/styleBS.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-home nav_logo-icon'></i> <span class="nav_logo-name">Rumah IT Bandung</span> </a>
                <div class="nav_list"> 
                    <a href="index.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="../siswa/siswa.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Data Siswa</span> </a> 
                    <a href="../time/time.php" class="nav_link"> <i class='bx bx-time'></i> <span class="nav_name">Setting Absen</span> </a> 
                    <a href="../riwayat/absensi.php" class="nav_link"> <i class='bx bxs-book'></i><span class="nav_name">Data Absensi Siswa</span> </a> 
                     
                        
                </div>
            </div> 
            <a href="../../login/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h1 style="text-align: center;">ABSENSI KEHADIRAN PESERTA PKL</h1>
        <hr> 
        <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Siswa</div>
              <div class="number"><?= $count1; ?> </div>
              <div class="indicator">
                <i class='bx bx-up-arrow-alt'></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class='bx bxs-user cart'></i>
          </div>

          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Kehadiran Siswa</div>
              <div class="number"><?= $count2; ?></div>
              <div class="indicator">
                <i class='bx bx-up-arrow-alt'></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class='bx bxs-calendar-check cart two'></i>
          </div>

          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Siswa Sakit</div>
              <div class="number"><?= $count3; ?></div>
              <div class="indicator">
                <i class='bx bx-up-arrow-alt'></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class='bx bxs-band-aid cart three'></i>
          </div>
        
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Siswa Izin</div>
              <div class="number"><?= $count4; ?></div>
              <div class="indicator">
                <i class='bx bx-down-arrow-alt down'></i>
                <span class="text">Down From Today</span>
              </div>
            </div>
            <i class='bx bxs-notepad cart four'></i>
          </div>

        </div>
        </div>
    <!--Container Main end-->

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   // Validate that all variables exist
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   // show navbar
   nav.classList.toggle('show')
   // change icon
   toggle.classList.toggle('bx-x')
   // add padding to body
   bodypd.classList.toggle('body-pd')
   // add padding to header
   headerpd.classList.toggle('body-pd')
   })
   }
   }
   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   /*===== LINK ACTIVE =====*/
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))
   
    // Your code to run since DOM is loaded and ready
   });
    </script>
</body>
</html>