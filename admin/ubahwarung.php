<?php include 'protect.php'; ?>
<h2>Ubah Warung</h2>
<?php 
	$query=$conn->query("SELECT * FROM warung WHERE id_warung='$_GET[id]'");
	$data=$query->fetch_assoc();
?>
<form role="form" method="POST">
	<div class="form-group">
		<label>Nama Warung</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_warung']; ?>">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat_warung']; ?>">
	</div>
	<div class="form-group">
		<label>Telepon</label>
		<input type="number" class="form-control" name="telepon" value="<?php echo $data['telepon_warung']; ?>">
	</div>
	<button class="btn btn-primary" name="submit">Ubah</button>
</form>
<?php 
	if (isset($_POST['submit'])) {
		$query = $conn->query("UPDATE warung SET nama_warung='$_POST[nama]', alamat_warung='$_POST[alamat]', telepon_warung='$_POST[telepon]' WHERE id_warung='$_GET[id]'");
		echo "<script>alert('Data Berhasil Diubah');</script>";
		echo "<script>location='index.php?halaman=warung';</script>";
	}
?>