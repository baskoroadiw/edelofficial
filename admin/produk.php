<?php include 'protect.php'; ?>
<h2>Data Produk</h2>

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Warung</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Stok</th>
				<th>Foto</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			<?php $ambil=$conn->query("SELECT * FROM produk JOIN warung ON produk.id_warung=warung.id_warung"); ?>
			<?php while ($data=$ambil->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $data['nama_warung']; ?></td>
					<td><?php echo $data['nama_produk']; ?></td>
					<td>Rp.<?php echo number_format($data['harga_produk']); ?></td>
					<td><?php echo $data['stok']; ?></td>
					<td><img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100"></td>
					<td>
						<a href="index.php?halaman=hapusproduk&id=<?php echo $data['id_produk']; ?>" class="btn-danger btn">Hapus</a>
						<a href="index.php?halaman=ubahproduk&id=<?php echo $data['id_produk']; ?>" class="btn btn-warning">Ubah</a>
					</td>
				</tr>
				<?php
			} ?>
		</tbody>	
	</table>
</div>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>