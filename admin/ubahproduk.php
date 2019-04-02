<?php include 'protect.php'; ?>
<h2>Ubah Produk</h2>
<?php 
	$query=$conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$data=$query->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga(Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $data['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" value="<?php echo $data['stok']; ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="5">
			<?php echo $data['deskripsi_produk']; ?>
		</textarea>
	</div>
	<div class="form-group">
		<label>Foto Produk &nbsp</label>
		<img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100">
	</div>
	<div class="form-group">
		<label>Ubah Produk</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="submit">Ubah</button>
</form>

<?php 
if (isset($_POST['submit'])) {
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

		$namaproduk=$_POST['nama'];
		$harga=$_POST['harga'];
		$stok=$_POST['stok'];
		$deskripsi=$_POST['deskripsi'];

		$conn->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',stok='$_POST[stok]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
	}
	else{
		$conn->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',stok='$_POST[stok]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('Data Berhasil Diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>