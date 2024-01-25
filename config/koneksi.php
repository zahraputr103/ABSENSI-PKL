<?php

$conn = new mysqli('localhost', 'root', '', 'absensi');

function query ($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data){
    global $conn;
    //ambil data dari tiap element dalam form
    $nik = htmlspecialchars($data["no_induk"]);
    $nama = htmlspecialchars($data["nama"]);
    $sekolah = htmlspecialchars($data["asal_sekolah"]);
    
   
 
    //query insert data
    $query = "INSERT INTO siswa
                VALUES
            ('','$nik', '$nama', '$sekolah')
            ";
    mysqli_query ($conn, $query);
    return mysqli_affected_rows($conn);
}


function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE siswa_id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;
    
    $siswa_id = $data["siswa_id"];
    $nik = htmlspecialchars($data["no_induk"]);
    $nama = htmlspecialchars($data["nama"]);
    $sekolah = htmlspecialchars($data["asal_sekolah"]);
    
    


    //query insert data
    $query = "UPDATE siswa SET 
                no_induk = '$nik',
                nama = '$nama',
                asal_sekolah = '$sekolah'  
            WHERE siswa_id = $siswa_id
              ";

    
    mysqli_query ($conn, $query);


    return mysqli_affected_rows($conn);

}

function edit($data) {
    global $conn;
    
    $waktu_id = $data["waktu_id"];
    $start = htmlspecialchars($data["jam_mulai"]);
    $end = htmlspecialchars($data["jam_selesai"]);
    $querytime = "UPDATE waktu SET
                jam_mulai = '$start',
                jam_selesai = '$end'
                WHERE waktu_id = $waktu_id
                ";
    mysqli_query ($conn, $querytime);   

}

function cari($search2){
    $query = "SELECT * FROM siswa 
                WHERE 
            no_induk LIKE '%$search2%' OR
            nama LIKE '%$search2%' OR
            asal_sekolah LIKE '%$search2%'

            ";

            return query($query);
}


//====================== USER ===============================//
   

function add($data) {
    // ambil data dari tiap elemen dalam form
    global $conn;
   
    $tanggal = htmlspecialchars($data["tanggal"]);
    $status = htmlspecialchars($data["status"]);
   
   
    // upload dan check upload gambar
    $lampiran = upload_file();
    if( !$lampiran ) {
       return false;
    
    }
   
      // query insert data
      $query = "INSERT INTO absen
                  VALUES
               ('', '$tanggal', '$status', '$lampiran')
   
                ";
   mysqli_query($conn, $query);
   
   return mysqli_affected_rows($conn);
   }


   function tambahkegiatan($data) {
       // ambil data dari tiap elemen dalam form
       global $conn;
      
       $tanggal = htmlspecialchars($data["tanggal"]);
       $bidang_pekerjaan = htmlspecialchars($data["bidang_pekerjaan"]);
       $kegiatan = htmlspecialchars($data["kegiatan"]);
      
      
         // query insert data
         $query = "INSERT INTO kegiatan
                     VALUES
                  ('', '$tanggal', '$bidang_pekerjaan', '$kegiatan')
      
                   ";
      mysqli_query($conn, $query);
      
      return mysqli_affected_rows($conn);
      }
   
   function upload_file() {
       $namaFIle = $_FILES['keterangan']['name'];
       $ukuranFile = $_FILES['keterangan']['size'];
       $error = $_FILES['keterangan']['error'];
       $tmpName = $_FILES['keterangan']['tmp_name'];
   
       // check file yang diupload
       $extensifileValid = ['jpg', 'jpeg', 'png', 'pdf'];
       $extensifile = explode('.', $namaFIle);
       $extensifile = strtolower(end($extensifile));
   
       if (!in_array($extensifile, $extensifileValid)) {
   
           echo "<script>alert('Format File Tidak Valid');
           document.location.href = 'add.php';
           </script>";
           die();
       }
   
       //check ukuran file 2 MB
       if ($ukuranFile > 2048000) {
   
           echo "<script>alert('Ukuran File Max 2 Mb');
           document.location.href = 'add.php';
           </script>";
           die();
       }
   
       // generate nama file baru
       $namaFIleBaru = uniqid();
       $namaFIleBaru .= '.';
       $namaFIleBaru .= $extensifile;
   
       //pindahkan ke folder local
       move_uploaded_file($tmpName, 'img/lampiran/'. $namaFIle);
       return $namaFIle;
   
   
   }
   
   // Ambil data file dari database (sesuaikan dengan kebutuhan Anda)
   $fileData = query("SELECT * FROM absen WHERE id = 1");
   if (!empty($fileData)) {
       $fileName = $fileData[0]['keterangan'];
       $fileUrl = 'img/lampiran/' . $fileName;
       // Lakukan sesuatu dengan $fileUrl
       
   
   } else {
       // Penanganan jika array kosong
   }
   
   
   function cari1($keyword) {
       global $conn;
   
       $query = "SELECT * FROM absen 
                  WHERE 
   
                  tanggal LIKE '%$keyword%' OR
                  status LIKE '%$keyword%'
       ";
       return query($query);
   }
   
   function cari2($keyword) {
       global $conn;
   
       $query = "SELECT * FROM kegiatan
                  WHERE 
   
                  tanggal LIKE '%$keyword%' OR
                  bidang_pekerjaan LIKE '%$keyword%' OR
                  kegiatan LIKE '%$keyword%'
       ";
       return query($query);
   }



//REGISTRASI

function registrasi($id){
    global $conn;
    $username = stripslashes($id['username']);
    $password = mysqli_real_escape_string ($conn, $id['password']);
    $password2 = mysqli_real_escape_string ($conn, $id['password2']);
    $level = strtolower (stripslashes($id['tingkat']));

    if ($password!==$password2){
        echo "<script>
            alert('Confirm password does not match!');
            document.location.href='sign.php';
            </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        
        if (mysqli_fetch_assoc($result)){
            echo "<script> 
                alert('Username already Used!');
            </script>";
            return false;
        }

    mysqli_query($conn, "INSERT INTO user VALUES('',  '$username', '$password', '$level')");

    return mysqli_affected_rows($conn);
}


?>