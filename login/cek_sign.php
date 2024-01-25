<?php
require "../config/koneksi.php";

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        if (password_verify($password, $data['password'])) {
            // Login berhasil
            if ($data['tingkat'] == "admin") {
                $_SESSION['username'] = $username;
                $_SESSION['tingkat'] = "admin";
                header("location:../admin/dashboard/index.php");
                exit;
            } elseif ($data['tingkat'] == "siswa") {
                $_SESSION['username'] = $username;
                $_SESSION['tingkat'] = "siswa";
                header("location:../user/index.php");
                exit;
            } else {
                // Tingkat pengguna tidak valid
                echo '<script>
                        alert("Tingkat pengguna tidak valid!");
                        document.location.href="sign.php";
                     </script>';
                exit;
            }
        } else {
            // Password tidak sesuai
            echo '<script>
                    alert("Username atau Password Salah!");
                    document.location.href="sign.php";
                 </script>';
            exit;
        }
    } else {
        // Pengguna tidak ditemukan
        echo '<script>
                alert("Pengguna tidak ditemukan!");
                document.location.href="sign.php";
             </script>';
        exit;
    }
}

?>