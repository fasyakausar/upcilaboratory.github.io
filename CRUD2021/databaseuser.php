<?php
		//koneksi database
		$server = "localhost";
		$user = "root";
		$pass = "";
		$database = "dlogin";


		$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));


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
					$vnim = $data['pass'];
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
						document.location='konfirmasiedit.php';
					  </script>";
			}
				}
			}
			
		
?>


<!DOCTYPE html>
<html>
<head>
<title>Database User</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- My CSS-->
    <link rel="stylesheet" href="style.css" />
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <a class="nav-link active" aria-current="page" href="register.php">REGISTER USER</a>
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
        <h1 class="display-4 text-white">PT. Telkom Indonesia, Tbk</h1>
        <p class="lead text-white">Database User</p>
      </section>
    <!-- END JUMBOTRON-->
	


<!--awal card tabel -->
<div class="card mt-5">
  	  <div class="card-header bg-success text-white">
    List Data User
	<a class="btn btn-dark" aria-current="page" href="editupdatedata.php">Edit Data</a>
  </div>
  <div class="card-body">
  	<table class="table table-bordered table-black-50">
  		<tr>
  			<th>No.</th>
  			<th>Nama User</th>
  			<th>Username</th>
  			<th>Password</th>
  			<th>Role</th>
  		</tr>
  		<?php
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from tadm order by id_adm desc");
  			while($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['nama_lengkap']?></td>
  			<td><?=$data['user']?></td>
  			<td><?=$data['kata_sandi']?></td>
  			<td><?=$data['posisi']?></td>
  		</tr>
  	<?php endwhile; //penutup while ?>
  	</table>
  </div>
	</div>
<!-- akhir card tabel -->
<p class="mt-5 mb-3 text-muted text-center">&copy; PT. Telkom Indonesia, Tbk 2021</p>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
</body>
</html>