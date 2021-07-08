<?php
		//koneksi database
		$server = "localhost";
		$user = "root";
		$pass = "";
		$database = "dlogin";


		$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));



		//Tombol simpan di klik
		if(isset($_POST['bupdate']))
		{
			//PENGUJIAN APAKAH DATA AKAN DI EDIT ATAU SIMPAN BARU
			if($_GET['hal'] == "edit")
			{
				//Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tadm set
												 user = '$_POST[user]',
												 katasandi = '$_POST[katasandi]',
												 nama_lengkap = '$_POST[nama_lengkap]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Jika edit sukses
			{
				echo "<script>
						alert('Update Data Sukses!');
						document.location='editupdatedata.php';
					  </script>";
			}
			else //Jika edit gagal
			{
				echo "<script>
						alert('Update Data GAGAL!');
						document.location='editupdatedata.php';
					  </script>";
			}
			}else
			{
				//Data akan disimpan baru
				$simpan = mysqli_query($koneksi, "INSERT INTO tadm (user, katasandi)
											  VALUES ('$_POST[katasandi]', 
											  		  '$_POST[pass]',
													  '$_POST[nama_lengkap]'
											  		 				)
											 ");
			if($simpan) //Jika simpan sukses
			{
				echo "<script>
						alert('Login Success!');
						document.location='editupdate.php';
					  </script>";
			}
			else //Jika simpan gagal
			{
				echo "<script>
						alert('Login Failed!');
						document.location='editupdate.php';
					  </script>";
			}
			}
			
		}

		//PENGUJIAN TOMBOL EDIT / HAPUS DI KLIK
		if(isset($_GET['hal']))
		{
			//PENGUJIAN DATA YANG AKAN DI EDIT
			if($_GET['hal'] == "edit")
			{
				//TAMPILKAN DATA YANG AKAN DI EDIT
				$tampil = mysqli_query($koneksi, "SELECT * FROM tadm WHERE id_adm = '$_GET[id]' ");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan, maka data ditampung ke dalam variabel
					$vnama = $data['user'];
					$vnim = $data['katasandi'];
				}
			}
			else if ($_GET['hal'] == "hapus")
			{
				//Persiapan hapus data
				$hapus = mysqli_query($koneksi, "DELETE FROM tadm WHERE id_adm = '$_GET[id]' ");
				if($hapus)
				{
					echo "<script>
						alert('Hapus Data Sukses!');
						document.location='editupdatedata.php';
					  </script>";
			}
				}
			}
			//Tombol back di klik
		if(isset($_POST['back']))
		{
			if($_GET['hal'] == "edit")
			{
				//Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tadm set
												 user = '$_POST[user]',
												 katasandi = '$_POST[katasandi]',
												 nama_lengkap ='$_POST[nama_lengkap]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Button back
			{
				echo "<script>
						document.location='menulogin.php';
						alert('Apakah Anda Yakin Ingin Kembali ?');
					  </script>";
			}
		}
	}
		
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- My CSS-->
    <link rel="stylesheet" href="style.css" />
    <title>Dashboard Admin</title>
  </head>
  <body>
    <!-- START NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: rgb(212, 79, 79) ">
        <div class="container">
          <a class="navbar-brand" href="home_admin.php">DASHBOARD ADMIN</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home_admin.php">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="editupdatedata.php">UPDATE</a>
              </li>
			  <li class="nav-item">
                <a class="btn btn-dark" aria-current="page" href="logout.php">LOGOUT</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- END NAVBAR-->

    <!-- START JUMBOTRON-->
    <section class="jumbotron text-center">
        <img src="img/logotelkom2.png" alt="Laboratorium Mikroprosesor" width="150" class="rounded-circle img-thumbnail" />
        <h1 class="display-4">Telkom Indonesia</h1>
        <p class="lead">Selamat datang di website resmi Performance</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,32L80,26.7C160,21,320,11,480,32C640,53,800,107,960,144C1120,181,1280,203,1360,213.3L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
      </section>
    <!-- END JUMBOTRON-->

     <!-- START WELCOME-->
     <section id="welcome">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>WELCOME!!</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5 text-center">
                <div class="col-md-4">
                    <p>Selamat anda telah berhasil login sebagai administrator</p>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#b3273a" fill-opacity="1" d="M0,160L60,133.3C120,107,240,53,360,48C480,43,600,85,720,117.3C840,149,960,171,1080,165.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
     </section>
     <!-- END WELCOME-->

     <!-- START INFO
        <section id="info">
            <div class="container">
                <div class="row text-center mb-3 text-white">
                    <div class="col">
                        <h2>Info Terkini</h2>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="img/23 24.jpg" class="card-img-top" alt="Info 1">
                                <div class="card-body">
                                  <p class="card-text">Sedang berlangsung praktikum online menggunakan platform Google Meet yang dilaksanakan untuk mahasiswa semester 4 tahun ajaran 2020/2021.</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="img/14 15.jpg" class="card-img-top" alt="Info 2">
                                <div class="card-body">
                                  <p class="card-text">Sedang berlangsung praktikum online menggunakan platform Google Meet yang dilaksanakan untuk mahasiswa semester 4 tahun ajaran 2020/2021.</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="img/Screenshot_18.jpg" class="card-img-top" alt="Info 3">
                                <div class="card-body">
                                  <p class="card-text">Sedang berlangsung praktikum online menggunakan platform Google Meet yang dilaksanakan untuk mahasiswa semester 4 tahun ajaran 2020/2021.</p>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    </html>
-->
<p class="mt-5 mb-3 text-muted text-center"> PT. Telkom Indonesia, Tbk &copy;2021</p>
  </body>
</html>