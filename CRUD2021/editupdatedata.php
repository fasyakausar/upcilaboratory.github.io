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
												 kata_sandi = '$_POST[kata_sandi]',
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
					$vnim = $data['kata_sandi'];
					$vnamalengkap = $data['nama_lengkap'];
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
			
		
?>


<!DOCTYPE html>
<html>
<head>
	<title>EDIT DATA</title>
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
        <h1 class="display-4 text-white">Telkom Indonesia</h1>
        <p class="lead text-white">Silahkan edit data user yang diperlukan!</p>
      </section>
    <!-- END JUMBOTRON-->
	

<!--start update form -->
	<div class="card mt-5">
  	  <div class="card-header bg-info text-white">
    Edit Data User
  </div>
  <div class="card-body">
  	<form method="post" action=" ">
	  <div class="form-group">
  			<label>Nama Lengkap</label>
  			<input type="text" name="nama_lengkap" value="<?=@$vnamalengkap?>" class="form-control" placeholder="Input Nama Lengkap Baru">
  		</div>
  		
  		<div class="form-group">
  			<label>Username</label>
  			<input type="text" name="user" value="<?=@$vnama?>" class="form-control" placeholder="Input Username Baru">
  		</div>
  		<div class="form-group">
  			<label>Password</label>
  			<input type="text" name="kata_sandi" value="<?=@$vnim?>" class="form-control" placeholder="Input Password Baru">
  		</div>
		  <div class="form-group font-weight-bold">
  			<label>Pilih </label>
  			<select class="form-control" name="posisi">
  				<option value="Administrator">Administrator</option>
  				<option value="PIC Regional">PIC Regional</option>
				<option value="PIC Witel">PIC Witel</option>
  			</select>
  		</div>
  		
  		<button type="update" class="btn btn-primary" name="bupdate">Update</button>
		<a href="editupdatedata.php?hal=edit&id=<?=$data['id_adm']?>" class="btn btn-danger text-white"> Undo </a>
  	</form>
  </div>
	</div>
<!-- end update form -->

<!--awal card tabel -->
<div class="card mt-5">
  	  <div class="card-header bg-success text-white">
    List Data 
	<a class="btn btn-warning" aria-current="page" href="databaseuser.php">Database</a>
  </div>
  <div class="card-body">
  	<table class="table table-bordered table-black-50">
  		<tr>
  			<th>No.</th>
  			<th>Nama User</th>
  			<th>Username</th>
  			<th>Password</th>
  			<th>Role</th>
  			<th>Action</th>
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
  			<td>
  				<a href="editupdatedata.php?hal=edit&id=<?=$data['id_adm']?>" class="btn btn-danger text-white"> EDIT </a>
  				<a href="editupdatedata.php?hal=hapus&id=<?=$data['id_adm']?>" onclick ="return confirm('Apakah yakin ingin mengahapus ?')" class="btn btn-dark"> HAPUS </a>
  			</td>
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