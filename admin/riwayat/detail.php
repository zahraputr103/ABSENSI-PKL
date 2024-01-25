<?php
require '../../config/koneksi.php';

$id= $_GET["siswa_id"];
$sw = query("SELECT * FROM siswa WHERE siswa_id = $id") [0];

$absen = query("SELECT * FROM rekap_absen WHERE siswa_id = $id ");


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
    .box{
        display: block;
        align-items: center;
        justify-content: center;
        width: 400px;
        background: #fff;
        margin-left: 60px;
        padding: 15px 14px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    p{
        display: block;
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
            <h1 class="title" style="display: inline; margin: 0; padding: 0;"><a href="absensi.php" style="color:black;">Data Absensi Siswa</a></h1> &ensp;
            <p style="display: inline; margin: 0; padding: 0;">>> Details</p>
            <hr>
<br>
            <div class="box">
                <p>NISN &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;: <?php echo $sw["no_induk"];?></p>
                <p>Nama Lengkap &ensp;: <?php echo $sw["nama"];?></p>
                <p>Asal Sekolah &ensp;&ensp; : <?php echo $sw["asal_sekolah"];?></p>
            </div>
<br>

            <table id="customers">

            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Status Kehadiran</th>
                <th>Keterangan</th>
                
            </tr>
            <?php $no=1; ?>
            <?php foreach ($absen as $row):?>
            <tr>
                <td><?= $no;?></td>
                <td><?= $row['tanggal'];?></td>
                <td><?= $row['status'];?></td>
                <td><?= $row['keterangan'];?></td>
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