<?php
require "../../config/koneksi.php";

// ambil data di url
$waktu_id = $_GET["waktu_id"];

// query data siswa berdasarkan nik
$tm = query("SELECT * FROM waktu WHERE waktu_id = $waktu_id")[0];

if( isset($_POST["submit"]) ) {
    //cek data berhasil diupdate or no
    if(edit($_POST) > 0){
        echo "
            <script>
                alert('data berhasil di Update');
                document.location.href = 'time.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data berhasil di Update');
                document.location.href = 'time.php';
            </script>
        ";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETTING TIME</title>
    <link rel="stylesheet" type="text/css" href="../../css/styleBS.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    label{
        display: block;
        margin-bottom:8px ;
        margin-left: 14px;
        font-size: 16px;
        font-family: 'Work Sans', sans-serif;
    }

    input{
        display: inline;
        padding: 15px;
        margin-bottom:25px ;
        margin-left: 20px;
        height: 33px;
        border: 1px solid black;
        border-radius: 3px;
        text-align: justify ;
        background: #EDEDED;
        width: 200px;
        font-size: 15px;
    }
    p{
        margin : 25px 70px  ;
    }
    ul{
        margin-left: 80px;
    }   
    li{
       list-style: none;
    }
    button.submit{
        margin-left: 100px;
        margin-top: 30px;
        height: 30px;
        width: 100px;
        background: #6571FE;
        color: white;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button.cancel{
        margin-left: 20px;
        background: #EE5353;
        border: 1px solid #ccc;
        height: 30px;
        width: 100px;
        color: white;
        border-radius: 5px;
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
                    <a href="../time/time.php" class="nav_link active"> <i class='bx bx-time'></i> <span class="nav_name">Setting Absen</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bxs-book'></i><span class="nav_name">Data Absensi Siswa</span> </a> 
                     
                </div>
            </div> 
            <a href="../../login/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h1 style="display: inline; margin: 0; padding: 0;">Setting Jam Absen </h1>
        <p style="display: inline; margin: 0; padding: 0;">>> Update</p>
        <hr>
        <p><b>Update Aturan Jam Absen</b></p>
        
        <form action="" method="post">
            <input type="hidden" name="waktu_id" value="<?= $tm["waktu_id"]; ?>">
            <ul>
                <li>
                    <label for="jam_masuk" >Jam Mulai </label>
                    <input type="time" name="jam_mulai" id="jam_mulai" required value="<?=$tm["jam_mulai"];?>">
                </li>
                <li>
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" required value="<?=$tm["jam_selesai"];?>"> 
                </li>
                
                <li>
                    <button type="submit" name="submit" class="submit">Update</button>
                    <a href="time.php"><button type="button" name="cancel" class="cancel">Cancel</button></a>
                </li>
            </ul>
        </form>
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