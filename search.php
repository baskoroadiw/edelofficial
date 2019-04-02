<?php 
include 'koneksi.php';
$judul = strip_tags($_GET['judul']);

if($judul=="")
	echo "";
else{
	$query = "SELECT * FROM produk WHERE nama_produk LIKE '%$judul%'"; 
	$result = $conn->query($query) or die($conn->error.__LINE__);
	if($hasil = $result->num_rows > 0){
		while($rows= $result->fetch_assoc()){
			extract($rows);
			?>
			<div class="col-md-3 col-sm-4">
				<div class="product">
					<div class="flip-container">
						<div class="flipper">
							<div class="front">
								<a href="detail_produk.php?id=<?php echo $rows['id_produk']; ?>">
									<img src="foto_produk/<?php echo $rows['foto_produk'];?>" alt="" class="img-responsive">
								</a>
							</div>
							<div class="back">
								<a href="detail_produk.php?id=<?php echo $rows['id_produk']; ?>">
									<img src="foto_produk/<?php echo $rows['foto_produk'];?>" alt="" class="img-responsive">
								</a>
							</div>
						</div>
					</div>
					<a href="detail_produk.php?id=<?php echo $rows['id_produk']; ?>" class="invisible">
						<img src="foto_produk/<?php echo $rows['foto_produk'];?>" alt="" class="img-responsive">
					</a>
					<div class="text">
						<h3><a href="detail_produk.php?id=<?php echo $rows['id_produk']; ?>"><?php echo $rows['nama_produk']; ?></a></h3>
						<p class="price">Stok : <?php echo $rows['stok']; ?></p>
						<p class="price">Rp.<?php echo number_format($rows['harga_produk']); ?></p>
						<p class="buttons">
							<a href="detail_produk.php?id=<?php echo $rows['id_produk']; ?>" class="btn btn-default">View detail</a>
							<a href="buy.php?id=<?php echo $rows['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</p>
					</div>
					<!-- /.text -->
				</div>
				<!-- /.product -->
			</div>
			<?php
			}
		} else{
			?>
			 <center><h1>NOT FOUND !</h1></center>
			<?php
		} 

	}
?>