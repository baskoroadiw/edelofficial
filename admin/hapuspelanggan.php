<?php 
	$query=$conn->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	$data= $query->fetch_assoc();

	$conn->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	echo "<script>alert('Pelanggan Berhasil Dihapus');</script>";
	echo "<script>location='index.php?halaman=pelanggan';</script>";
?>