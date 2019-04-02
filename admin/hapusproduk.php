<?php 
	$query=$conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$data= $query->fetch_assoc();
	$fotoproduk = $data['foto_produk'];
	if (file_exists("../foto_produk/$fotoproduk")) {
		unlink("../foto_produk/$fotoproduk");
	}

	$conn->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

	echo "<script>alert('Produk Berhasil Dihapus');</script>";
	echo "<script>location='index.php?halaman=produk'</script>";
?> 