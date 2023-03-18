<?php
session_start();
$id_gerant = $_SESSION["id_gerant"];

if (isset($_POST["validation"])) {
	$id = $_POST["id"];
	$con = mysqli_connect("localhost", "Root", "", "library");
	$sql = "INSERT INTO emprunts(date_emprunt,date_retour,id_reservation,id_gerant_valide,id_gerant_retour) 
          VALUES (NOW(),NULL,'$id','$id_gerant',NULL)";
	if (mysqli_query($con, $sql)) {
		$query = "UPDATE reservation SET state_reservation ='The reservation has been confirmed' WHERE id_reservation = '$id'";
		if (mysqli_query($con, $query)) {
			header("refresh:0");
		}
	}
}

$hidde = "";

if (isset($_POST["retour"])) {
	$id = $_POST["id"];
	$con = mysqli_connect("localhost", "Root", "", "library");
	$sql = "UPDATE emprunts SET date_retour = NOW() ,id_gerant_retour ='$id_gerant' WHERE id_reservation ='$id'";
	if (mysqli_query($con, $sql) == TRUE) {
		$query_retour = "UPDATE reservation SET state_reservation = 'The reservation has been returned successfully' WHERE id_reservation ='$id'";
		if (mysqli_query($con, $query_retour)) {
			header("refresh:0");
		}
	}
	$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM reservation WHERE id_reservation = '$id'"));
	$date_emprunt = strtotime($row['date_emprunt']);
	$date_retour = strtotime($row['date_retour']);
	$days_diff = floor(($date_retour - $date_emprunt) / (60 * 60 * 24));
	if ($days_diff > 15) {
		$id_membre = $row['id_membre'];
		$query_banned = "UPDATE membre SET banned = banned + 1 WHERE id_membre ='$id_membre'";
		mysqli_query($con, $query_banned);
	}
}

if (isset($_POST["delete"])) {
	$con = mysqli_connect("localhost", "Root", "", "library");
	$delete = "DELETE FROM reservation WHERE (DATEDIFF(CURRENT_DATE(), date_reservation) > 0) AND id_reservation NOT IN (SELECT id_reservation FROM emprunts)";
	if (mysqli_query($con, $delete)) {
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
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">


	<!--===============================================================================================-->
</head>

<body class="animsition">

	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->


			<div>
				<nav class="d-flex">

					<!-- Logo desktop -->
					<a href="#" class="logo">
						<img src="images/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop" style="margin-top: 5.8%;">
						<ul class="main-menu">
							<li>
								<a href="home.php">Home</a>
							</li>

							<li class="active-menu">
								<a href="">Reservation</a>
							</li>

							<li>
								<a href="OperationReservation.php">Operation Reservation</a>
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

				<li class="active-menu">
					<a>Reservation</a>
				</li>

				<li>
					<a href="OperationReservation.php">Operation Reservation</a>
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


	</header>


	<form action="" method="post" style="margin-top: 5%;">
		<div class="input-group">
			<input type="search" class="form-control rounded" placeholder="First Name" name="nom" aria-label="Search" aria-describedby="search-addon" />
			<input type="search" class="form-control rounded" placeholder="Last Name" name="prenom" aria-label="Search" aria-describedby="search-addon" />
			<input type="search" class="form-control rounded" placeholder="Identify Card" name="cni" aria-label="Search" aria-describedby="search-addon" />
			<select class="form-select " aria-label="Default select example" name="select_state">
				<option selected>Filter</option>
				<option value="date">Date > 24h</option>
				<option value="Being Processed">Being Processed</option>
				<option value="The reservation has been confirmed">Confirmed</option>

			</select>
			<input type="search" class="form-control rounded" placeholder="ID Reservation" name="idreservation" aria-label="Search" aria-describedby="search-addon" />
			<button type="submit" name="search" class="btn text-light" style="background-color: #7A1616;">search</button>
		</div>
	</form>



	<?php
	$con = mysqli_connect('localhost', 'Root', '', 'library');
	if (isset($_POST['search'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$select_state = $_POST['select_state'];
		$IDRESERVATION = $_POST["idreservation"];
		$cni = $_POST["cni"];
		if (!empty($nom) && !empty($prenom)) {
			$sql = "SELECT * FROM reservation r JOIN membre m ON r.id_membre = m.id_membre WHERE m.first_name = '$nom' AND m.last_name = '$prenom'";
			$result = mysqli_query($con, $sql);
		} elseif (!empty($IDRESERVATION)) {
			$sql = "SELECT * FROM reservation WHERE id_reservation ='$IDRESERVATION'";
			$result = mysqli_query($con, $sql);
		} elseif (!empty($select_state)) {
			if ($select_state == 'date') {
				$sql = "SELECT * FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) > 0 AND id_reservation NOT IN (SELECT id_reservation FROM emprunts)";
				$result = mysqli_query($con, $sql);
			} elseif ($select_state == 'Being Processed') {
				$sql = "SELECT * FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) = 0 AND state_reservation = '$select_state'";
				$result = mysqli_query($con, $sql);
			} elseif ($select_state == 'The reservation has been confirmed') {
				$sql = "SELECT * FROM reservation WHERE state_reservation = '$select_state'";
				$result = mysqli_query($con, $sql);
			}
		} elseif (!empty($cni)) {
			$sql = "SELECT * FROM reservation r JOIN membre m ON r.id_membre = m.id_membre WHERE m.ID_card = '$cni'";
			$result = mysqli_query($con, $sql);
		}
	} else {
		$sql = "SELECT * FROM reservation";
		$result = mysqli_query($con, $sql);
	}

	if ($select_state == 'date') {
		$query = "SELECT * FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) > 0 AND id_reservation NOT IN (SELECT id_reservation FROM emprunts)";
		$result_query = mysqli_query($con, $query);
		if (mysqli_num_rows($result_query) == 0) {
			echo "<h1 class='container' style='display:flex;justify-content:center;align-items:center;'>No reservations found</h1>";
		} else {
			echo "<form method='POST'>";
			echo "<button class='btn-danger'id='delete' type='submit' style='width:100%;margin-top:3%;' name='delete'>Delete All Reservations</button>";
			echo "</form>";
		}
	}


	while ($rows = mysqli_fetch_assoc($result)) {
		$id_ouvrage = $rows["id_ouvrage"];
		$id_membre = $rows["id_membre"];
		$id_reservation = $rows["id_reservation"];

	?>
		<div class="wrapper container" style="height: fit-content;margin-top:10%;">
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
							<h1><?php echo $row["name_ouvrage"] ?></h1>
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
								<p><span class="amount" style="font-weight: bold;color: #000;">Information membre :</span></p>

								<?php
								$sql_membre = "SELECT * FROM membre WHERE id_membre ='$id_membre'";
								$result_membre = mysqli_query($con, $sql_membre);
								while ($row_membre = mysqli_fetch_assoc($result_membre)) {
								?>
									<p><span class="amount" style="font-weight: bold;color: #000;">First Name :</span> <?php echo $row_membre["first_name"] ?></p>
									<p><span class="amount" style="font-weight: bold;color: #000;">Last Name :</span> <?php echo $row_membre["last_name"] ?></p>
									<p><span class="amount" style="font-weight: bold;color: #000;">Email:</span> <?php echo $row_membre["email"] ?></p>
									<p><span class="amount" style="font-weight: bold;color: #000;">Phone:</span> <?php echo $row_membre["phone"] ?></p>
								<?php
								}

								?>
							</div>
							<div class="right-align">
								<form action="" method="post">
									<input type="hidden" name="id" value="<?php echo $rows["id_reservation"] ?>">
									<?php if ($rows["state_reservation"] == "The reservation has been confirmed" || $rows["state_reservation"] == "The reservation has been returned successfully") : ?>
										<button class="btn-primary" type="submit" name="validation" style="display: none;">Valide</button>
									<?php else : ?>
										<button class="btn-primary" type="submit" name="validation">Valide</button>
									<?php endif; ?>
									<?php
									$sql_date = "SELECT date_retour FROM emprunts WHERE id_reservation ='$id_reservation'";
									$date = mysqli_query($con, $sql_date);
									$row_date = mysqli_fetch_assoc($date);

									if (!empty($row_date['date_retour']) || $rows["state_reservation"] == "The reservation has been cancelled" || $rows["state_reservation"] == "Being Processed") {
										echo "<button class='btn-success' type='submit' name='retour' style='display:none;'>Retour</button>";
									} else {
										echo "<button class='btn-success'id='return-message' type='submit' name='retour' style='display:block;'>Retour</button>";
									}
									?>

								</form>
								<?php
								if (!empty($row_date['date_retour'])) {
									echo "<p style='color: green;margin-top:5%;'>The reservation has been returned</p>";
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php


	}


	?>
	<div style="margin-top: 5%;color: #fff;">div</div>

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