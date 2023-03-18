<?php
session_start();
$id_membre = $_SESSION["id_membre"];
$first_name =  $_SESSION['first_name'];
$last_name =  $_SESSION['last_name'];

if (isset($_POST["delete"])) {
	$id = $_POST["id"];
	$con = mysqli_connect('localhost', 'Root', '', 'library');
	$sql = "DELETE FROM reservation WHERE id_reservation = '$id'";
	if (mysqli_query($con, $sql)) {
		header("refresh:0");
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Reservation</title>
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
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">

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

					<div>
						<a href="#" class="logo">
							<img width="50vw" height="50vh" src="images/user.png" alt="IMG-LOGO">
						</a>
						<div style="margin-left: -18px;margin-top:4%;">
							<?php

							echo "<p>" . $first_name . " " . $last_name . "</p>";
							?>
						</div>

					</div>



					<div class="menu-desktop" style="margin-left: 4%;">
						<ul class="main-menu">
							<li>
								<a href="Home.php">Home</a>
							</li>

							<li>
								<a href="ouvrage.php">Books</a>
							</li>

							<li class="active-menu">
								<a>My Reservations</a>
							</li>

							<li>
								<a href="about.php">About us</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
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


			<ul class="main-menu">
				<li>
					<a href="Home.php">Home</a>
				</li>

				<li>
					<a href="ouvrage.php">Books</a>
				</li>

				<li class="active-menu">
					<a>My Reservations</a>
				</li>

				<li>
					<a href="about.php">About us</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>
	</header>
	<form action="" method="post">
		<div class="input-group">
			<input type="search" class="form-control rounded" placeholder="Name Of Book" name="nom" aria-label="Search" aria-describedby="search-addon" style="width: 10%;"/>
			<select class="form-select " aria-label="Default select example"  name="select_state">
				<option selected>Select State Reservation</option>
				<option value="The reservation has been confirmed">Confirmed</option>
				<option value="Being Processed">Being Processed</option>
			</select> 
			<button type="submit" name="search" class="btn text-light" style="background-color: #6c7ae0;">Search</button>
		</div>
	</form>

	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<?php
			$con = mysqli_connect('localhost', 'Root', '', 'library');
			$sql = "";
			$result="";
			if(isset($_POST["search"])){
				$select_state=$_POST["select_state"];
				$name=$_POST["nom"];
				if(!empty($name)){
					$sql = "SELECT ouvrage.name_ouvrage 
		            FROM reservation 
					JOIN ouvrage ON reservation.id_ouvrage = ouvrage.id 
					WHERE reservation.name_ouvrage = '$name' 
					AND reservation.id_membre = '$id_membre'";
					$result = mysqli_query($con, $sql);
				}elseif(!empty($select_state)){
					$sql = "SELECT * FROM reservation WHERE state_reservation='$select_state' AND id_membre = '$id_membre'";
					$result = mysqli_query($con, $sql);
				}
			}else{
				$sql = "SELECT * FROM reservation WHERE id_membre = '$id_membre'";
				$result = mysqli_query($con, $sql);
			}
			
			while ($rows = mysqli_fetch_assoc($result)) {
				$id_ouvrage = $rows["id_ouvrage"];
				$id_reservation = $rows["id_reservation"];
			?>
				<div class="wrapper container" style="height: 50vh;margin-top:3%;">
					<div class="booking-card-wrapper container" style="height: 100%;width: 100%;">
						<div class="booking-card-image">
							<?php
							$query = "SELECT * FROM ouvrage WHERE id_ouvrage = '$id_ouvrage'";
							$results = mysqli_query($con, $query);
							while ($row = mysqli_fetch_assoc($results)) {
							?>
								<img class="booking-card-image" src="<?php echo $row["image_main"] ?>" />

							<?php
							}

							?>
						</div>
						<div class="booking-card-content">
							<div class="booking-card-description">
								<?php
								$query = "SELECT * FROM ouvrage WHERE id_ouvrage = '$id_ouvrage'";
								$results = mysqli_query($con, $query);
								while ($row = mysqli_fetch_assoc($results)) {
								?>
									<h1 style="color:white;text-align:center;"><?php echo $row["name_ouvrage"] ?></h1>
								<?php
								}

								?>
							</div>
							<div class="booking-card-details">
								<div class="flex">
									<div>
										<?php
										$query = "SELECT * FROM ouvrage WHERE id_ouvrage = '$id_ouvrage'";
										$results = mysqli_query($con, $query);
										while ($row = mysqli_fetch_assoc($results)) {
										?>
											<p><span class="amount" style="font-weight: bold;color: #000;">Type :</span> <?php echo $row["type_ouvrage"] ?></p>
										<?php
										}

										?>


										<p><span class="amount" style="font-weight: bold;color: #000;">Date Reservation :</span> <?php echo $rows["date_reservation"] ?></p>

										<p style="color:<?php echo $rows['state_reservation'] == 'The reservation has been confirmed' || $rows['state_reservation'] == 'The reservation has been returned successfully' ? 'green' : 'red' ?>;"><span class="amount" style="font-weight: bold;color: #000;">State Reservation :</span> <?php echo $rows["state_reservation"] ?></p>
										<p style="color:red;display:<?php echo $rows['state_reservation'] == 'The reservation has been confirmed' || $rows['state_reservation'] == 'The reservation has been returned successfully' ? 'none' : 'block'; ?>;"><span class="amount" style="font-weight: bold;color: #000;">Warning :</span>The reservation will be cancelled after 24h without confirmation en person </p>

										<?php
										$query_date = "SELECT * FROM emprunts WHERE id_reservation = '$id_reservation'";
										$result_date = mysqli_query($con, $query_date);

										while ($rows_date = mysqli_fetch_assoc($result_date)) {
											$date_valide = $rows_date["date_emprunt"];
											$date_emprunt = date('Y-m-d H:i:s', strtotime($date_valide));
											$date_retour = date('Y-m-d H:i:s', strtotime($date_emprunt . ' +15 days'));
										?>
											<p style="display: <?php echo $rows['state_reservation'] == 'The reservation has been confirmed' ? 'block' : 'none' ?>;"><span class="amount" style="font-weight: bold;color: #000;">Date Emprunt :</span> <?php echo $date_emprunt; ?></p>
											<p style="color:red;display: <?php echo $rows['state_reservation'] == 'The reservation has been confirmed' ? 'block' : 'none' ?>;"><span class="amount" style="font-weight: bold;color: #000;">Date Max Of Retour :</span> <?php echo $date_retour; ?></p>
										<?php
										}

										?>
									</div>
									<div class="right-align">
										<form action="" method="post">
											<input type="hidden" name="id" value="<?php echo $rows["id_reservation"] ?>">
											<button class="btn-danger" type="submit" name="delete" style="display:<?php echo $rows['state_reservation'] == 'The reservation has been confirmed' || $rows["state_reservation"] == 'The reservation has been returned successfully' ? 'none' : 'block' ?>;">Cancellation </button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>

	<style>
		.booking-card-wrapper {
			height: 200px;
			width: 300px;
			background-color: var(--spring-wood);
			box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.2);
			display: flex;
		}

		.booking-card-image {
			flex: 1;
			height: 100%;
			width: 100%;
			object-fit: cover;
		}

		.price {
			font-weight: 700;
		}

		.booking-card-content {
			flex: 3;
			display: flex;
			flex-direction: column;
		}

		.booking-card-description {
			padding-top: 10px;
			padding-left: 20px;
			padding-bottom: 10px;
			background-color: #6c7ae0;
		}

		.booking-card-description h1 {
			font-size: 24px;
			font-weight: 700;
			margin: 5px 0px;
			color: hsle(0, 0%, 13%)
		}

		.booking-card-details {
			flex: 1;
			padding-left: 20px;
			padding-top: 20px;
			background-color: #fff;
		}

		i.fa-star {
			color: var(--faded-jade);
			font-size: 16px;
		}

		.reviews {
			font-size: 10px;
			color: hsl(0, 0%, 45%);
			margin-top: 5px;
		}

		.reviews .amount {
			padding-left: 3px;
		}

		.side-note {
			margin-top: 10px;
			font-size: 10px;
			color: hsl(0, 0%, 45%);
		}

		button {
			outline: none;
			display: inline-block;
			font-weight: 400;
			vertical-align: middle;
			border: 1px solid transparent;
			padding: .575rem .95rem;
			border-radius: .25rem;
			box-shadow: 0 8px 8px 0 hsla(0, 0%, 0%, 0.2);
		}

		button:hover {
			opacity: 0.8;
		}

		.btn-primary {
			background-color: var(--hippie-blue);
			color: var(--spring-wood);
			font-weight: 700;
		}

		.right-align {
			margin: auto auto;
		}

		.flex {
			display: flex;
		}
	</style>


	<!-- Footer -->
	<footer class="bg3 p-t-25 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								BOOKS
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								MAGAZINE
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								NOVEL
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								CD
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns
							</a>
						</li>


						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved |Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


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
	<script>
		/* Toggle between showing and hiding the dropdown menu */
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}

		/* Close the dropdown menu if the user clicks outside of it */
		window.onclick = function(event) {
			if (!event.target.matches('.dropbtn')) {
				var dropdowns = document.getElementsByClassName("dropdown-content");
				for (var i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>