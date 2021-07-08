<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['nama_lengkap']);
unset($_SESSION['posisi']);

session_destroy();
echo "<script>alert('Anda Telah Logout Sebagai PIC Witel');document.location='menulogin.php' </script>";