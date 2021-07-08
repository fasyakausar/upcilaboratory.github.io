<?php

//pangil koneksi database
include "koneksi_login.php";

$password = $_POST['kata_sandi'];
$username = mysqli_escape_string($koneksi, $_POST['user']);
$pass = mysqli_escape_string($koneksi, $pass);
$level = mysqli_escape_string($koneksi, $_POST['posisi']);

//cek username terdaftar atau tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM tadm WHERE user = '$username' and posisi='$level' ");
$user_valid = mysqli_fetch_array($cek_user);

//menguji jika username terdaftar

if($user_valid)
{
    //jika username terdaftar
    //cek password sesuai atau tidak
    if($pass == $user_valid['kata_sandi'])
    {
        //jika password sesuai
        //buat session
        session_start();
        $_SESSION['user'] = $user_valid['user'];
        $_SESSION['kata_sandi'] = $user_valid['kata_sandi'];
        $_SESSION['posisi'] = $user_valid['posisi'];

        //pengujian level user
        if($level == "PIC Regional")
        {
            header('location:home_picregion.php');
        }
        if ($level == "PIC Witel")
        {
            header('location:home_picwitel.php');
        }
        if ($level == "Administrator")
        {
            header('location:home_admin.php');
        }
    }
    else{
        echo "<script>
		alert('Login Gagal Password Tidak Sesuai');
		document.location='menulogin.php';
		 </script>";
    }
    }
    else {
    echo "<script>
    alert('Login Gagal Username Tidak Terdaftar');
    document.location='menulogin.php';
    </script>";
    }
?>
