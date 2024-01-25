<?php

session_start();
if($_SESSION['tingkat'] !== "siswa") {
  echo '<script>
                    alert("username atau Password Salah!");
                    document.location.href="../login/sign.php";
                    </script>';
            exit; 
}


require '../../config/koneksi.php';
$absen = query("SELECT * FROM absen");

// tombol cari ditekan

if( isset($_POST["cari1"])) {
  $absen = cari1($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> ABSENSI </title>
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

<style>
  .flex-container {
    display: flex;
    padding: 20px;
    justify-content: flex-end;
}
  
.flex-container > div {
    background-color: #f1f1f1;
    margin: 10px;
    text-align: center;
    font-size: 30px;
}

div.divSearchBar {
    background-color: white;
    margin: 0;
    text-align: center;
    font-size: 17px;
}

.absen {
    background: #17192C;
    color: white;
    height: 38px;
    width: 85px;
    font-size: 14px;
    border: none;
}

form.searchBar input[type=text] {
    padding: 10px;
    font-size: 14px;
    border: 1px solid grey;
    float: left;
    width: 80%;
    background: #ffffff;
  }
  
form.searchBar button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #17192C;
    color: white;
    font-size: 14px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
  }
  
  form.searchBar button:hover {
    background: #17192C;
  }
  
  form.searchBar::after {
    content: "";
    clear: both;
    display: table;
  }
</style>

   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-home' ></i>
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
        <span class="dashboard">Absensi</span>
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
                <div class="flex-container">
                <a href="add.php"><button class="absen" >+ Absen</button></a>
                <div></div>
                <div class="divSearchBar">
                <form class="searchBar" action="" method="post" style="margin:auto;max-width:300px" >
                    <input type="text" placeholder="Search ..." name="keyword" autocomplete="off">
                    <button type="submit" name="cari1"><i class='bx bx-search-alt'></i></button>
                </form>
                </div>
                </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>status</th>
                                <th>Keterangan</th>
                            </tr>

                            <?php $i = 1; ?>
                            <?php foreach( $absen as $row ) : ?>

                              <tr>
                              <td><?= $i; ?></td>
                              <td><?= $row['tanggal']; ?></td>
                              <td><?= $row['status']; ?></td>
                              <td><?= $row['keterangan']; ?></td>
                              

                              </tr>
                              <?php $i++; ?>
                              <?php endforeach; ?>

                            </thead>

    </table>
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






