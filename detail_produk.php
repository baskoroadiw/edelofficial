<?php 
session_start();
include 'koneksi.php';
include 'protect.php';
$id_produk=$_GET['id'];
$query=$conn->query("SELECT * FROM produk JOIN warung ON produk.id_warung=warung.id_warung WHERE id_produk='$id_produk'");
$data=$query->fetch_assoc();
$id_pelanggan=$_SESSION['login']['id_pelanggan'];
error_reporting(0);

if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $hasil = $conn->query("SELECT * FROM produk WHERE id_produk=$postid");
    $baris = $hasil->fetch_assoc();
    $n = $baris['likes'];

    $conn->query("UPDATE produk SET likes=$n+1 WHERE id_produk=$postid");
    $conn->query("INSERT INTO likes(id_pelanggan, id_produk) VALUES($id_pelanggan, $postid)");
    exit();
}
if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $hasil = $conn->query("SELECT * FROM produk WHERE id_produk=$postid");
    $baris = $hasil->fetch_assoc();
    $n = $baris['likes'];

    $conn->query("UPDATE produk SET likes=$n-1 WHERE id_produk=$postid");
    $conn->query("DELETE FROM likes WHERE id_produk=$postid AND id_pelanggan=$id_pelanggan");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <title>
        E-Del : Information Delivery Order Tel-U
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="asset/css/font-awesome.css" rel="stylesheet">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/animate.min.css" rel="stylesheet">
    <link href="asset/css/owl.carousel.css" rel="stylesheet">
    <link href="asset/css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="asset/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="asset/css/custom.css" rel="stylesheet">

    <script src="asset/js/respond.min.js"></script>

    <link rel="shortcut icon" href="logo.png">



</head>

<body>
    <!-- *** TOPBAR ***
     _________________________________________________________ -->
     <div id="top">
        <div class="container">
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="profile.php">Welcome, <?php echo $_SESSION['login']['nama_pelanggan']; ?></a>
                    </li>
                    <li><a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
     _________________________________________________________ -->

     <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="logo.png" class="hidden-xs">
                    <img src="logo.png" class="visible-xs"><span class="sr-only">E-Del - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="cart.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Keranjang Belanja</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li> <a href="all-menu.php">Menu</a>
                    </li>
                    <li class="active"> <a href="warung.php">Patners</a>
                    </li>
                    <li> <a href="contact.php">Contact Us</a>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <?php
                error_reporting(0);                     
                    if (!$_SESSION['keranjang']) {
                    ?>
                        <div class="navbar-collapse collapse right" id="basket-overview">
                            <a href="cart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang Belanja</span></a>
                        </div>
                    <?php        
                    }
                    else{
                    $item = count($_SESSION['keranjang']);
                    ?>
                        <div class="navbar-collapse collapse right" id="basket-overview">
                            <a href="cart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Keranjang Belanja (<?php echo $item;?>)</span></a>
                        </div>
                    <?php
                    }
                ?>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                        </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
                     _________________________________________________________ -->
                     <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Daftar Warung</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                 <?php 
                                $query2=$conn->query("SELECT * FROM warung");

                                while ($data2=$query2->fetch_assoc()) {
                                    ?>
                                <li>
                                    <a href="warung.php?id=<?php echo $data2['id_warung']; ?>"><?php echo $data2['nama_warung']; ?></a>
                                </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>


                    <!-- *** MENUS AND FILTERS END *** -->
                </div>

                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="foto_produk/<?php echo $data['foto_produk']; ?>" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h2 class="text-center"><?php echo $data['nama_produk']; ?> (<?php echo $data['nama_warung']; ?>)</h2>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Detail Menu</a>
                                </p>
                                <p class="price">Stok : <?php echo $data['stok']; ?></p>
                                <p class="price">Rp.<?php echo number_format($data['harga_produk']); ?></p>
                                <form method="post">
                                    <center><input type="number" min="1" name="jumlah" style="width: 50px; height: 28px;"></center><br>
                                    <center><button class="btn btn-primary" name="beli"><i class="fa fa-shopping-cart"></i>Add To Cart</button></center><br>
                                </form>
                                <?php 
                                if (isset($_POST['beli'])) {
                                    $jumlah=$_POST['jumlah'];
                                    $stok_update = $data['stok'] - $jumlah;
                                    if ($jumlah < 1) {
                                        echo "<script>alert('Masukkan banyaknya item');</script>";
                                    }
                                    else if ($stok_update < 0) {
                                        echo "<script>alert('Stok tidak memenuhi');</script>";
                                    }
                                    else{
                                        $_SESSION['keranjang'][$id_produk] += $jumlah;
                                        echo "<script>alert('Item berhasil masuk ke keranjang');</script>";
                                        echo "<script>location='cart.php'</script>";
                                    }
                                }
                                ?>
                                <?php
                                    $query3=$conn->query("SELECT*FROM likes WHERE id_pelanggan=$id_pelanggan AND id_produk=$id_produk");
                                    $result=$query3->fetch_assoc();
                                    if ($result>0) {
                                        ?>
                                        <center><a href="" class="btn btn-default unlike" id="<?php echo $id_produk; ?>"><i class="fa fa-star fa-2x"></i> <b><?php echo $data['likes']; ?> Like</b></a></center>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <center><a href="" class="btn btn-default like" id="<?php echo $id_produk; ?>"><i class="fa fa-star-o fa-2x"></i> <b><?php echo $data['likes']; ?> Like</b></a></center>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="box" id="details">
                        <p>
                            <h4>Detail Menu</h4>
                            <!-- <p><?php echo $data['deskripsi_produk']; ?></p> -->
                            <blockquote>
                                <p><em><?php echo $data['deskripsi_produk']; ?></em>
                                </p>
                            </blockquote>

                            <hr>
                        </div>

                    </div>
                    <!-- /.col-md-9 -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /#content -->

        <!-- *** COPYRIGHT ***
         _________________________________________________________ -->
         <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© E-Del 2018</p>
                </div>
                <div class="col-md-6">
                    <p class="pull-right">Alright Reserved by 11Fingers
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->
    </div>
    <!-- /#all -->

    <!-- *** SCRIPTS TO INCLUDE ***
     _________________________________________________________ -->
     <script src="asset/js/jquery-1.11.0.min.js"></script>
     <script src="asset/js/bootstrap.min.js"></script>
     <script src="asset/js/jquery.cookie.js"></script>
     <script src="asset/js/waypoints.min.js"></script>
     <script src="asset/js/modernizr.js"></script>
     <script src="asset/js/bootstrap-hover-dropdown.js"></script>
     <script src="asset/js/owl.carousel.min.js"></script>
     <script src="asset/js/front.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
        //saat pencet like
        $('.like').click(function(){
            var postid = $(this).attr('id');
            $.ajax({
                url: 'detail_produk.php',
                type: 'post',
                async: false,
                data:{
                    'liked': 1,
                    'postid': postid
                },
                success:function(){

                }
            });
        });
    });
    // saat pencet unlike
    $(document).ready(function(){
        //saat pencet like
        $('.unlike').click(function(){
            var postid = $(this).attr('id');
            $.ajax({
                url: 'detail_produk.php',
                type: 'post',
                async: false,
                data:{
                    'unliked': 1,
                    'postid': postid
                },
                success:function(){

                }
            });
        });
    });         
     </script>
 </body>

 </html>