<!-- layout.html.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="ps.css">
	<script src="https://ajax.googleapis.com/ajax/libs/
	jquery/3.3.1/jquery.min.js"></script>
	<title><?=$title?></title>
</head>
<body>
	<header>
		<h1>Boy Scout Plant Sale</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a class="arrow" href="#">Scouts</a>
				<ul>
					<li>
						<a href="addScout.php">Add Scout</a>
					</li>
					<li>
						<a href="scouts.php">List Scouts</a>
					</li>
				</ul>
			</li>
			<li><a class="arrow" href="#">Customers</a>
				<ul>
					<li>
						<a href="addCustomer.php">Add Customer</a>
					</li>
					<li>
						<a href="customers.php">List Customers</a>
					</li>
				</ul>
			</li>
			<li><a class="arrow" href="">Orders</a>
				<ul>
					<li>
						<a href="addOrder.php">Add Order</a>
					</li>
					<li>
						<a href="orders.php">List Orders</a>
					</li>
				</ul>
			</li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<main>
		<?=$output?>
	</main>
	<footer>
		 &copy; BSPS <?=date('Y')?>
	</footer>
</body>
</html>