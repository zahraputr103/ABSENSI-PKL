<?php
require '../../config/koneksi.php';
$siswa = query('SELECT * FROM siswa');

// tombol cari di kilk
if ( isset($_POST["cari"]) ){
    $siswa = cari ($_POST["search2"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAP ABSEN PESERTA PKL</title>
    <link rel="stylesheet" type="text/css" href="../../css/styleBS.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    td{
        text-align: center;
    }
    a{
        color:black;
    }
</style>

</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-home nav_logo-icon'></i> <span class="nav_logo-name">Rumah IT Bandung</span> </a>
                <div class="nav_list"> 
                <a href="../dashboard/index.php" class="nav_link "> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="../siswa/siswa.php" class="nav_link "> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Data Siswa</span> </a> 
                    <a href="../time/time.php" class="nav_link"> <i class='bx bx-time'></i> <span class="nav_name">Setting Absen</span> </a> 
                    <a href="absensi.php" class="nav_link active"> <i class='bx bxs-book'></i><span class="nav_name">Data Absensi Siswa</span> </a> 
                    
                </div>
            </div> 
            <a href="../../login/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
            <h1 class="title">Data Absensi Siswa</h1>
            <hr>
<br>
            <div class="flex-container">
            
                <div class="divSearchBar">
                <form class="searchBar" action="" method="post" style="margin:auto;max-width:300px" >
                        <input type="text" placeholder="Search ..." name="search2" autocomplete="off">
                        <button type="submit" name="cari"><i class='bx bx-search-alt'></i></button>
                    </form>
                 </div>
            </div>
<br>

            <table id="customers">

            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Action</th>
                
            </tr>

            <?php $no=1; ?>
            <?php foreach ($siswa as $sw): ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $sw["nama"];?></td>
                <td>
                    <a href="detail.php?siswa_id=<?= $sw["siswa_id"]; ?>" style="color: #4B0082;">Detail</a>
                </td>

            </tr>

            <?php $no++;?>
            <?php endforeach;?>
            
            </table>
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