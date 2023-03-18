<!DOCTYPE html>
<html lang="en">

<head>
	<title>Operation Reservation</title>
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
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">


			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="#" class="logo">
						<img width="120vw" height="200vh" src="images/logo.png" alt="IMG-LOGO">
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

							<li class="active-menu">
								<a href="">Operation Reservation</a>
							</li>

							<li>
								<a href="Inventory.php">Inventory</a>
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
				<a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
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

				<li class="active-menu">
					<a href="">Operation Reservation</a>
				</li>

				<li>
					<a href="Inventory.php">Inventory</a>
				</li>

				<li>
					<a href="Operation.php">Operation Inventory</a>
				</li>

				<li>
					<a href="AccountBanned.php">Suspended Accounts</a>
				</li>

			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>



	<table class="table container" style="margin-top: 10%;border: 2px solid #868686;">
		<thead class="thead-dark" style="background-color: #7A1616;border: 2px solid #868686;">
			<tr>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">Gerant</th>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">ID Reservation</th>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">Valide Reservation</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$con = mysqli_connect('localhost', 'Root', '', 'library');
			if (!$con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM emprunts";
			$result = mysqli_query($con, $sql);

			while ($row = mysqli_fetch_assoc($result)) {
				$id_gerant_valide = $row["id_gerant_valide"];
				$sql_gerant = "SELECT first_name, last_name FROM gerant WHERE id_gerant ='$id_gerant_valide'";
				$result_gerant = mysqli_query($con, $sql_gerant);
				$gerant = mysqli_fetch_assoc($result_gerant);
			?>
				<tr style="text-align: center;">
					<td style='color: #000;border: 4px solid #868686;'><?php echo $gerant['first_name'] . " " . $gerant['last_name']; ?></td>
					<td style="color: #000;border: 4px solid #868686;"><?php echo $row['id_reservation']; ?></td>
					<td style="color: #000;border: 4px solid #868686;"><?php echo $row['date_emprunt']; ?></td>
				</tr>
			<?php
			}
			mysqli_close($con);
			?>
		</tbody>
	</table>
	<table class="table container" style="margin-top: 3%;border: 2px solid #fff;">
		<thead class="thead-dark" style="background-color: #7A1616;">
			<tr>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">Gerant</th>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">ID Reservation</th>
				<th style="color: #fff;border: 4px solid #868686;text-align: center;" scope="col">Retour Reservation</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$con = mysqli_connect('localhost', 'Root', '', 'library');
			if (!$con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM emprunts";
			$result = mysqli_query($con, $sql);

			while ($row = mysqli_fetch_assoc($result)) {
				$id_gerant_retour = $row["id_gerant_retour"];
				$sql_gerant = "SELECT first_name, last_name FROM gerant WHERE id_gerant ='$id_gerant_retour'";
				$results_gerant = mysqli_query($con, $sql_gerant);
				$gerants = mysqli_fetch_assoc($results_gerant);
			?>
				<tr style="text-align: center;">
					<td style='color: #000;border: 4px solid #868686;'><?php echo $gerants['first_name'] . " " . $gerants['last_name']; ?></td>
					<td style="color: #000;border: 4px solid #868686;"><?php echo $row['id_reservation']; ?></td>
					<td style="color: #000;border: 4px solid #868686;"><?php echo $row['date_retour']; ?></td>
				</tr>
			<?php
			}
			mysqli_close($con);
			?>
		</tbody>
	</table>









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
		$('.js-addwish-b2').on('click', function(e) {
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