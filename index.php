<?php
require 'koneksi.php';
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO berita (id_berita, judul, isi, gambar, pengirim)
										  VALUES ('$_POST[id_berita]', 
										  		 '$_POST[judul]', 
										  		 '$_POST[isi]',
												 '$_POST[gambar]',  
										  		 '$_POST[pengirim]'
												   )
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='index.php';
				     </script>";
			}



		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM berita WHERE id_berita = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$id_berita = $data['id_berita'];
				$judul = $data['judul'];
                $isi = $data['isi'];
                $gambar = $data['gambar'];
                $pengirim = $data['pengirim'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM berita WHERE id_berita = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='index.php';
				     </script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tugas Crud OOP</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Penambahan Berita
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>ID Berita</label>
	    		<input type="number" name="id_berita" value="<?=@$id_berita?>" class="form-control" required>
	    	</div>

	    	<div class="form-group">
	    		<label>Judul Berita</label>
	    		<input type="text" name="judul" value="<?=@$judul?>" class="form-control" required>
	    	</div>

	    	<div class="form-group">
	    		<label>Isi</label>
	    		<textarea class="form-control" name="isi" ><?=@$isi?></textarea>
	    	</div>

            <div class="form-group">
	    		<label>Gambar</label>
	    		<input type="file" name="gambar" value="<?=@$gambar?>" class="form-control" required>
	    	</div>

            <div class="form-group">
	    		<label>Pengirim</label>
	    		<input type="text" name="pengirim" value="<?=@$pengirim?>" class="form-control" required>
	    	</div>

	    	<br>
	    	<button type="submit" class="btn btn-warning" name="bsimpan">Save</button>
	    	<button type="reset" class="btn btn-dark" name="breset">Clear</button>


	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Berita
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>No</th>
	    		<th>ID Berita</th>
	    		<th>Judul Berita</th>
	    		<th>Isi</th>
	    		<th>Gambar</th>
                <th>Pengirim</th>
	    	</tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from berita");
	    		while($data = mysqli_fetch_array($tampil)) :

	    	?>
	    	<tr>
	    		<td><?=$no++;?></td>
	    		<td><?=$data['id_berita']?></td>
	    		<td><?=$data['judul']?></td>
	    		<td><?=$data['isi']?></td>
                <td><?=$data['gambar']?></td>
                <td><?=$data['pengirim']?></td>
	    		<td>
	    			<a href="index.php?hal=edit&id=<?=$data['id_berita']?>" class="btn btn-primary"> Edit </a>
	    			<a href="index.php?hal=hapus&id=<?=$data['id_berita']?>" 
	    			   onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-success"> Hapus </a>
	    		</td>
	    	</tr>
	    <?php endwhile; //penutup perulangan while ?>
	    </table>

	  </div>
	</div>
	<!-- Akhir Card Tabel -->

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>