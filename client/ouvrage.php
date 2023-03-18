<?php
session_start();
$first_name =  $_SESSION['first_name'];
$last_name =  $_SESSION['last_name'];
$disponible = "";
if (isset($_POST["id"])) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$id = $_POST["id"];
	$con = mysqli_connect('localhost', 'Root', '', 'library');

	$id_membre = $_SESSION["id_membre"];
	$membre = $id_membre;
	$query = "SELECT *
	 FROM ouvrage
	 WHERE name_ouvrage='$id' AND state_ouvrage='EXCELLENT' AND id_ouvrage IN (
	  SELECT MIN(id_ouvrage)
	  FROM ouvrage
	  WHERE state_ouvrage='EXCELLENT'
	  AND id_ouvrage NOT IN (
	SELECT id_ouvrage FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) = 0)GROUP BY name_ouvrage)";

	$resultes = mysqli_query($con, $query);
	if (mysqli_num_rows($resultes) == 0) {
		$query_meduim = "SELECT *
		FROM ouvrage
		WHERE name_ouvrage='$id' AND state_ouvrage='MEDUIM' AND id_ouvrage IN (
		SELECT MIN(id_ouvrage)
		FROM ouvrage
		WHERE state_ouvrage='MEDUIM'
		AND id_ouvrage NOT IN (
		SELECT id_ouvrage FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) = 0)GROUP BY name_ouvrage)";
		$resultes_meduim = mysqli_query($con, $query_meduim);
		if (mysqli_num_rows($resultes_meduim) == 0) {
			$disponible = "Not available now";
		} else {
			$row_meduim = mysqli_fetch_assoc($resultes_meduim);
			$id_state_ouvrage_meduim = $row_meduim["id_ouvrage"];
			$sql_check_medium = "SELECT * FROM emprunts";
			$result_check_meduim = mysqli_query($con, $sql_check_medium);
			if (mysqli_num_rows($result_check_meduim) == 0) {
				$sql_three_meduim = "INSERT INTO reservation (date_reservation,state_reservation,id_membre,id_ouvrage)VALUES(NOW(),'Being Processed','$id_membre','$id_state_ouvrage_meduim')";
				if (mysqli_query($con, $sql_three_meduim)) {
					header("refresh:0");
				}
			} else {
				$query_four_meduim = "SELECT *
				FROM ouvrage
				WHERE id_ouvrage = '$id_state_ouvrage_meduim' AND id_ouvrage IN (
					SELECT id_ouvrage
					FROM emprunts
					WHERE id_reservation IN (
						SELECT id_reservation
						FROM (
							SELECT DISTINCT r.id_reservation
							FROM reservation r
							INNER JOIN emprunts e ON r.id_reservation = e.id_reservation
							WHERE e.date_retour IS NOT NULL
						) AS subquery
					)
				)";
				$resultes_four_meduim = mysqli_query($con, $query_four_meduim);
				if (mysqli_num_rows($resultes_four_meduim) == 0) {
					$disponible = "Not available now";
				} else {
					$sql_four_meduim = "INSERT INTO reservation (date_reservation,state_reservation,id_membre,id_ouvrage)VALUES(NOW(),'Being Processed','$id_membre','$id_state_ouvrage_meduim')";
					if (mysqli_query($con, $sql_four_meduim)) {
						header("refresh:0");
					}
				}
			}
		}
	} else {
		$rows_two = mysqli_fetch_assoc($resultes);
		$id_state_ouvrage_two = $rows_two["id_ouvrage"];
		$sql_check = "SELECT * FROM emprunts";
		$result_check = mysqli_query($con, $sql_check);
		if (mysqli_num_rows($result_check) == 0) {
			$sql_three = "INSERT INTO reservation (date_reservation,state_reservation,id_membre,id_ouvrage)VALUES(NOW(),'Being Processed','$id_membre','$id_state_ouvrage_two')";
			if (mysqli_query($con, $sql_three)) {
				header("refresh:0");
			}
		} else {
			$query_four = "SELECT *
			FROM ouvrage
			WHERE id_ouvrage = '$id_state_ouvrage_two' AND id_ouvrage IN (
				SELECT id_ouvrage
				FROM emprunts
				WHERE id_reservation IN (
					SELECT id_reservation
					FROM (
						SELECT DISTINCT r.id_reservation
						FROM reservation r
						INNER JOIN emprunts e ON r.id_reservation = e.id_reservation
						WHERE e.date_retour IS NOT NULL
					) AS subquery
				)
			)";
			$resultes_four = mysqli_query($con, $query_four);
			if (mysqli_num_rows($resultes_four) == 0) {
				$disponible = "Not available now";
			} else {
				$sql_four = "INSERT INTO reservation (date_reservation,state_reservation,id_membre,id_ouvrage)VALUES(NOW(),'Being Processed','$id_membre','$id_state_ouvrage_two')";
				if (mysqli_query($con, $sql_four)) {
					header("refresh:0");
				}
			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Ouvrage</title>
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
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

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

							<li class="active-menu">
								<a>Books</a>
							</li>

							<li>
								<a href="myReservation.php?">My Reservations</a>
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

				<li class="active-menu">
					<a>Books</a>
				</li>

				<li>
					<a href="myReservation.php?">My Reservations</a>
				</li>

				<li>
					<a href="about.php">About us</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
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

	<style>
		/* Style the dropdown button */
		.dropbtn {
			color: rgb(133, 133, 133);
			padding: 5px;
			font-size: 14px;
			border: none;
			cursor: pointer;
		}

		.dropbtn:hover {
			color: #000;
			text-decoration: underline;
			border: none;
			cursor: pointer;
		}

		/* Style the dropdown content */
		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f1f1f1;
			min-width: 160px;
			z-index: 1;
		}

		/* Style the links inside the dropdown */
		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			cursor: pointer;
		}

		/* Change the background color of the dropdown links on hover */
		.dropdown-content a:hover {
			background-color: #ddd;
		}

		/* Show the dropdown menu when the button is clicked */
		.show {
			display: block;
		}
	</style>



	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">

					<form action="" method="post">
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" name="alltype">
							ALL TYPE
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


					<div class="dropdown" style="margin-top: -4px;">
						<form action="" method="post">
							<button class="dropbtn" type="submit" name="Books">BOOKS</button>
						</form>
					</div>



				</div>



				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-w flex-c-m m-tb-10">
						<form action="" method="post">
							<div class="input-group">
								<select class="form-select " aria-label="Default select example" style="border:3px solid #7A1616;width:10vw;color:#7A1616;" name="select_state">
									<option selected>Select State</option>
									<option value="EXCELLENT">EXCELLENT</option>
									<option value="MEDUIM">MEDUIM</option>
								</select>
								<input type="search" class="form-control rounded" placeholder="Title" name="textSearch" aria-label="Search" aria-describedby="search-addon" style="margin-left: 3%;" />
								<button type="submit" name="search" class="btn text-light" style="background-color: #7A1616;">Search</button>
							</div>
						</form>
					</div>
				</div>



			</div>


			<?php

			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			$con = mysqli_connect('localhost', 'Root', '', 'library');
			$numberPage = 16;
			$lienPage = isset($_GET['page']) ? $_GET['page'] : 1;
			$startPage = (intval($lienPage) - 1) * $numberPage;
			$query = "";
			$result = "";
			$query_pages = "";

			if (isset($_POST["NOVELS"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='NOVEL' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT * FROM ouvrage WHERE type_ouvrage = 'NOVEL' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)LIMIT $startPage, $numberPage;";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["Books"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='BOOK' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT * FROM ouvrage WHERE type_ouvrage = 'BOOK' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)LIMIT $startPage, $numberPage;";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["select_states"])) {
				$stateOUVRAGES = $_POST["select_state"];
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE state_ouvrage='$stateOUVRAGES' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT * FROM ouvrage WHERE state_ouvrage='$stateOUVRAGES' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["showCD"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='CD' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT * FROM ouvrage WHERE type_ouvrage = 'CD' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)LIMIT $startPage, $numberPage;";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST["MAGAZINEs"])) {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE type_ouvrage='MAGAZINE' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$resulte = mysqli_query($con, $query_pages);
				$rowe = mysqli_fetch_assoc($resulte);
				$AllData = $rowe['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT * FROM ouvrage WHERE type_ouvrage = 'MAGAZINE' AND id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)LIMIT $startPage, $numberPage;";
				$result = mysqli_query($con, $query);
			} elseif (isset($_POST['search'])) {
				$search_name = $_POST["textSearch"];
				$stateOUVRAGES = $_POST["select_state"];
				if (!empty($search_name)) {
					$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE name_ouvrage LIKE '%$search_name%' AND id_ouvrage IN (
						SELECT MIN(id_ouvrage)
						FROM ouvrage 
						GROUP BY name_ouvrage
					)";
					$resulte = mysqli_query($con, $query_pages);
					$rowe = mysqli_fetch_assoc($resulte);
					$AllData = $rowe['numberData'];
					$AllPage = ceil($AllData / $numberPage);

					$query = "SELECT * FROM ouvrage WHERE name_ouvrage LIKE '%$search_name%' AND id_ouvrage IN (
						SELECT MIN(id_ouvrage)
						FROM ouvrage 
						GROUP BY name_ouvrage
					)
					LIMIT $startPage, $numberPage;";
					$result = mysqli_query($con, $query);
				} elseif (!empty($stateOUVRAGES)) {
					$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE state_ouvrage ='$stateOUVRAGES' AND id_ouvrage IN (
						SELECT MIN(id_ouvrage)
						FROM ouvrage 
						GROUP BY name_ouvrage
					)";
					$resulte = mysqli_query($con, $query_pages);
					$rowe = mysqli_fetch_assoc($resulte);
					$AllData = $rowe['numberData'];
					$AllPage = ceil($AllData / $numberPage);

					$query = "SELECT * FROM ouvrage WHERE state_ouvrage='$stateOUVRAGES' AND id_ouvrage IN (
						SELECT MIN(id_ouvrage)
						FROM ouvrage 
						GROUP BY name_ouvrage
					)
					LIMIT $startPage, $numberPage;";
					$result = mysqli_query($con, $query);
				}
			} else {
				$query_pages = "SELECT COUNT(*) as numberData FROM ouvrage WHERE id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)";
				$result_all = mysqli_query($con, $query_pages);
				$row_all = mysqli_fetch_assoc($result_all);
				$AllData = $row_all['numberData'];
				$AllPage = ceil($AllData / $numberPage);
				$result_all = mysqli_query($con, $query_pages);
				$row_all = mysqli_fetch_assoc($result_all);
				$AllData = $row_all['numberData'];
				$AllPage = ceil($AllData / $numberPage);

				$query = "SELECT *
				FROM ouvrage
				WHERE id_ouvrage IN (
					SELECT MIN(id_ouvrage)
					FROM ouvrage 
					GROUP BY name_ouvrage
				)
				LIMIT $startPage, $numberPage";
				$result = mysqli_query($con, $query);
			}


			echo "<div id='div-card' class='row isotope-grid'>";
			while ($row = mysqli_fetch_assoc($result)) {
				$name_ouvrage = $row['name_ouvrage'];
			?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img width="50vw" height="220vh" src="<?php echo $row['image_main']; ?>" alt="IMG-PRODUCT">
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="font-size: 1em;color:#7A1616">
									Title : <span style="font-weight: bold;color: #000;"> <?php echo $row['name_ouvrage']; ?></span>
								</p>
								<span class="stext-105 cl3" style="color:#7A1616">
									Date Edition : <span style="font-weight: bold;color: #000;"> <?php echo $row['date_edition']; ?></span>
								</span>
								<span class="stext-105 cl3" style="color:#7A1616">
									Type : <span style="font-weight: bold;color: #000;"> <?php echo $row['type_ouvrage']; ?></span>
								</span>
								<span class="stext-105 cl3" style="color:#7A1616">
									Quantity Excellent: <span style="font-weight: bold; color: #000;">
										<?php
										$query_count = "SELECT state_ouvrage, count(*) as count_ouvrage
                                        FROM ouvrage
                                        WHERE name_ouvrage = '$name_ouvrage' AND state_ouvrage = 'EXCELLENT'
                                        GROUP BY name_ouvrage, state_ouvrage";
										$result_query = mysqli_query($con, $query_count);
										$row_query = mysqli_fetch_assoc($result_query);
										if (!empty($row_query["count_ouvrage"])) {
											$count_ouvrages = $row_query["count_ouvrage"];
											echo $count_ouvrages;
										} else {
											echo "0";
										}

										?>
									</span>

								</span>
								<span class="stext-105 cl3" style="color:#7A1616">
									Quantity Meduim: <span style="font-weight: bold; color: #000;">
										<?php
										$query_counts = "SELECT state_ouvrage, count(*) as count_ouvrages
                                        FROM ouvrage
                                        WHERE name_ouvrage = '$name_ouvrage' AND state_ouvrage = 'MEDUIM'
                                        GROUP BY name_ouvrage, state_ouvrage";
										$result_querys = mysqli_query($con, $query_counts);
										$row_querys = mysqli_fetch_assoc($result_querys);
										if (!empty($row_querys["count_ouvrages"])) {
											$count_ouvrages = $row_querys["count_ouvrages"];
											echo $count_ouvrages;
										} else {
											echo "0";
										}

										?>
									</span>

								</span>
								<p style="color:red;"><?php echo $disponible; ?></p>
							</div>
						</div>
						<form class="my-form" style="margin-top: 4%;">
							<input type="hidden" name="id" value="<?php echo $row['name_ouvrage']; ?>">


							<?php
							$con = mysqli_connect('localhost', 'Root', '', 'library');
							$id_membre = $_SESSION['id_membre'];

							$sql_counts = "SELECT COUNT(*) AS num_reservations
							FROM reservation r
							INNER JOIN emprunts e ON r.id_reservation = e.id_reservation
							WHERE r.id_membre = $id_membre
							AND e.date_emprunt IS NOT NULL
							AND e.date_retour IS NULL";
							$reservation_count = "SELECT COUNT(*) AS num_reservation FROM reservation WHERE DATEDIFF(CURRENT_DATE(), date_reservation) = 0 AND id_membre='$id_membre'";
							$result_counts = mysqli_query($con, $sql_counts);
							$result_count = mysqli_query($con, $reservation_count);
							$number_reservations = mysqli_fetch_assoc($result_counts)['num_reservations'];
							$forID = $row['name_ouvrage'];

							$number_reservation = mysqli_fetch_assoc($result_count)['num_reservation'];
							if ($number_reservations == 3 || $number_reservation == 3) {
								echo "<button type='button' class='btn text-light' data-bs-toggle='modal' data-bs-target='#exampleModal' style='width: 100%;margin-top:3%;background-color:#7A1616;'>
									BOOK NOW
								</button>";
							} elseif ($number_reservations == 1) {
								if ($number_reservation < 2) {
									echo "<button type='button' class='submit-form btn text-light' style='width: 100%;margin-top:3%;background-color:#343a40;' data-form-id='$forID'>BOOK NOW</button>";
								} else {
									echo "<button type='button' class='btn text-light' data-bs-toggle='modal' data-bs-target='#exampleModal' style='width: 100%;margin-top:3%;background-color:#7A1616;'>
									BOOK NOW
								    </button>";
								}
							}elseif ($number_reservations == 2) {
								if ($number_reservation < 1) {
									echo "<button type='button' class='submit-form btn text-light' style='width: 100%;margin-top:3%;background-color:#343a40;' data-form-id='$forID'>BOOK NOW</button>";
								} else {
									echo "<button type='button' class='btn text-light' data-bs-toggle='modal' data-bs-target='#exampleModal' style='width: 100%;margin-top:3%;background-color:#7A1616;'>
									BOOK NOW
								    </button>";
								}
							} 
							 else {
								echo "<button type='button' class='submit-form btn text-light' style='width: 100%;margin-top:3%;background-color:#343a40;' data-form-id='$forID'>BOOK NOW</button>";
							}

							?>
						</form>
					</div>
				</div>


			<?php
			}
			echo "</div>";
			echo "<ul style='display:flex;flex-wrap:wrap;' class='container'>";
			for ($i = 1; $i <= $AllPage; $i++) {
				echo "<a href='?page=$i?#about' class='btn' style='margin-left:1%;background-color:#7A1616;color:#fff;'>$i</a>";
			}
			echo "</ul>";
			?>

		</div>
	</div>

	<script>
		$(document).on('click', '.submit-form', function() {

			var form = $(this).closest('.my-form');
			var formData = new FormData(form[0]);
			var formId = $(this).data('form-id');
			formData.append('form_id', formId);
			var submitBtn = $(this);
			$.ajax({
				type: 'POST',
				url: 'ouvrage.php',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					submitBtn.addClass('animated zoomIn');
					submitBtn.text('SUCCESSFULLY BOOKING');
					submitBtn.css('background-color', '#90EE90');
					submitBtn.removeClass('text-light');
					submitBtn.addClass('text-dark');
					setTimeout(function() {
						$('#div-card').load('ouvrage.php #div-card');
					}, 2000);


				},
				error: function(xhr, status, error) {
					alert(error);
				}
			});
		});
	</script>

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

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:10%;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p style='color:red;'>You have maximum 3 reservation</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
				</div>
			</div>
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
	<script src="bootstrap.bundle.min.js"></script>
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