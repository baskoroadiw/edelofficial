<?php include 'protect.php'; ?>
<h2>Data Pembelian</h2>

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal</th>
				<th>Total</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			<?php $query=$conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan") ?>
			<?php while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['nama_pelanggan']; ?></td>
					<td><?php echo $data['tanggal_pembelian']; ?></td>
					<td>Rp.<?php echo number_format($data['total_pembelian']); ?></td>
					<td>
						<a href="index.php?halaman=detail&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info">Detail</a>
					</td>
				</tr>
				<?php
			} ?>
		</tbody>
	</table>	
</div>