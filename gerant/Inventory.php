<?php
session_start();

if (isset($_POST["delete"])) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$id_gerant = $_SESSION["id_gerant"];

	$id = $_POST["id"];
	$con = mysqli_connect('localhost', 'Root', '', 'library');
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_query($con, 'SET foreign_key_checks = 0');
	$sql = "DELETE FROM ouvrage WHERE id_ouvrage = '$id'";
	if (mysqli_query($con, $sql)) {
		$query = "INSERT INTO gestion (id_ouvrage, id_gerant, type_operation, date_operation) VALUES('$id','$id_gerant', 'Delete', NOW())";
		if (mysqli_query($con, $query)) {
			header("Location:index.php");
			exit();
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($con);
		}
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	mysqli_query($con, 'SET foreign_key_checks = 1');
	mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Inventory</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">

	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->


			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="#" class="logo">
						<img src="images/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="home.php">Home</a>
							</li>

							<li>
								<a href="reservation.php">Reservation</a>
							</li>

							<li>
								<a href="OperationReservation.php">Operation Reservation</a>
							</li>

							<li class="active-menu">
								<a href="">Inventory</a>
							</li>

							<li>
								<a href="Operation.php">Operation Inventory</a>
							</li>

							<li>
								<a href="AccountBanned.php">Suspended Accounts</a>
							</li>
						</ul>
					</div>


				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.html"><img src="images/logo.png" alt="IMG-LOGO"></a>
			</div>


			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">

			<ul class="main-menu-m">
				<li>
					<a href="home.php">Home</a>
				</li>

				<li>
					<a href="reservation.php">Reservation</a>
				</li>

				<li>
					<a href="OperationReservation.php">Operation Reservation</a>
				</li>

				<li class="active-menu">
					<a href="">Inventory</a>
				</li>

				<li>
					<a href="Operation.php">Operation Inventory</a>
				</li>

				<li>
					<a href="AccountBanned.php">Suspended Accounts</a>
				</li>
			</ul>
		</div>


	</header>





	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<form action="" method="post">
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" name="alltype">
							ALL TYPE
						</button>
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="books">
							BOOKS
						</button>
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="showCD">
							CD
						</button>
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="NOVELS">
							NOVEL
						</button>
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="MAGAZINEs">
							MAGAZINE
						</button>
					</form>
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<form action="" method="post">
						<div class="input-group">
							<input type="search" class="form-control rounded" placeholder="Title" name="titre" aria-label="Search" aria-describedby="search-addon" />
							<button type="submit" name="search" class="btn text-light" style="background-color: #7A1616;">search</button>
						</div>
					</form>
				</div>

			</div>

			<?php

			$con = mysqli_connect('localhost', 'Root', '', 'library');
			$numberPage = 12;
			$lienPage = isset($_GET['page']) ? $_GET['page'] : 1;
			$startPage = ($lienPage - 1) * $numberPage;
			$query = "";
			$result = "";
			$query_pages = "";


			if (isset($_POST["NOVELS"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='NOVEL'";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage WHERE type_ouvrage='NOVEL' LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["books"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='BOOK'";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage WHERE type_ouvrage='BOOK' LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["showCD"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='CD'";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage WHERE type_ouvrage='CD' LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["MAGAZINEs"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='MAGAZINE'";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage WHERE type_ouvrage='MAGAZINE' LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["search"])) {
				$title = $_POST["titre"];
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE name_ouvrage='$title'";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage WHERE name_ouvrage='$title' LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} else {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$query = "SELECT * FROM ouvrage LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			}


			echo "<div class='row isotope-grid'>";
			while ($row = mysqli_fetch_assoc($result)) {
			?>

				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img width="50vw" height="220vh" src="<?php echo $row['image_main']; ?>" alt="IMG-PRODUCT">
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="font-size: 1em;">
									<?php echo $row['name_ouvrage']; ?>
								</p>
								<span class="stext-105 cl3">
									<span style="font-weight: bold;color: #000;">State :</span> <?php echo $row['state_ouvrage']; ?>
								</span>
								<span class="stext-105 cl3">
									<span style="font-weight: bold;color: #000;">Type :</span> <?php echo $row['type_ouvrage']; ?>
								</span>
								<span class="stext-105 cl3">
									<span style="font-weight: bold;color: #000;">Date of buy :</span> <?php echo $row['date_achat']; ?>
								</span>
								<form action="" method="post" style="margin-top: 4%;">
									<input type="hidden" name="id" value="<?php echo $row['id_ouvrage']; ?>">
									<a href="editInvantory.php?id=<?php echo $row['id_ouvrage']; ?>" class="btn btn-success">Edit</a>

									<button type="submit" name="delete" class="btn btn-danger">Delete</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			<?php
			}
			echo "</div>";
			echo "<ul style='display:flex;flex-wrap:wrap;' class='container'>";
			for ($i = 1; $i <= $AllPage; $i++) {
				echo "<a href='?page=$i?#about' class='btn' style='margin-left:2%;background-color:#7A1616;color:#fff;'>$i</a>";
			}
			echo "</ul>";
			?>
		</div>
	</div>



	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>



	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function() {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function() {
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>


	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>