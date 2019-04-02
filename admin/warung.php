<?php include 'protect.php'; ?>
<h2>Data Warung</h2>

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>ID Warung</th>
				<th>Nama Warung</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			<?php $ambil=$conn->query("SELECT * FROM warung"); ?>
			<?php while ($data=$ambil->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $data['id_warung']; ?></td>
					<td><?php echo $data['nama_warung']; ?></td>
					<td><?php echo $data['alamat_warung']; ?></td>
					<td><?php echo $data['telepon_warung']; ?></td>
					<td>	
						<a href="index.php?halaman=ubahwarung&id=<?php echo $data['id_warung']; ?>" class="btn btn-warning">Ubah</a>
					</td>
				</tr>
				<?php
			} ?>
		</tbody>
	</table>	
</div>
<a href="index.php?halaman=tambahwarung" class="btn btn-primary">Tambah Warung</a>