<?php
    session_start(); 
    include 'koneksi.php';
    include 'protect.php';
    error_reporting(0); 
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
                    <li class="active"> <a href="contact.php">Patners</a>
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
                    <!-- *** MENUS AND FILTERS ***-->
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">Daftar Warung</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <?php 
                                $query=$conn->query("SELECT * FROM warung");

                                while ($data=$query->fetch_assoc()) {
                                    ?>
                                <li>
                                    <a href="warung.php?id=<?php echo $data['id_warung']; ?>"><?php echo $data['nama_warung']; ?></a>
                                </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h2>Warung Pilihan :</h2>
                        <?php 
                        $id_warung=$_GET['id'];
                        $query2=$conn->query("SELECT * FROM warung WHERE id_warung=$id_warung");
                        $data2=$query2->fetch_assoc();
                        ?>
                        <h1><?php echo $data2['nama_warung']; ?></h1>
                        <p><?php echo $data2['alamat_warung']; ?> <br>
                            <?php echo $data2['telepon_warung']; ?></p>
                        </div>
                    <div class="row products">
                        <?php
                        $id_warung=$_GET['id'];  
                        $query3=$conn->query("SELECT * FROM produk WHERE id_warung=$id_warung");
                        while ($data3=$query3->fetch_assoc()) {
                            ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>">
                                                    <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>">
                                                    <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>" class="invisible">
                                        <img src="foto_produk/<?php echo $data3['foto_produk']; ?>" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>"><?php echo $data3['nama_produk']; ?></a></h3>
                                        <p class="price">Stok : <?php echo $data3['stok']; ?></p>
                                        <p class="price">Rp.<?php echo number_format($data3['harga_produk']); ?></p>
                                        <p class="buttons">
                                            <a href="detail_produk.php?id=<?php echo $data3['id_produk']; ?>" class="btn btn-default">View detail</a>
                                            <a href="buy.php?id=<?php echo $data3['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- /.products -->
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
            <p class="pull-left">© E-DEL 2018</p>
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

</body>
</html>