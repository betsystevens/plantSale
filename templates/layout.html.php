<!-- layout.html.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="ps3.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
	<title><?=$title?></title>
</head>
<body>
<div class="page">
	<nav class="top">
		<ul>
			<li><a class="logo" href="index.php">✽</a></l>
			<li><a href="scouts.php">Scouts</a> </li>
			<li><a href="customers.php">Customers</a></li>
			<li><a href="orders.php">Orders</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<nav class="side left">
		<ul>
			<li>Orders <span class="arrow"> &#x25bc </span> 
				<ul>
					<li>
						<a href="addOrder.php">Add Order</a>
					</li>
					<li>
						<a href="orders.php">List Orders</a>
					</li>
				</ul>
			</li>		
			<li>Customers <span class="arrow"> &#x25bc </span> 
				<ul>
					<li>
						<a href="addCustomer.php">Add Customer</a>
					</li>
					<li>
						<a href="customers.php">List Customers</a>
					</li>
				</ul>
			</li>
			<li>Scouts <span class="arrow"> &#x25bc </span>
				<ul>
					<li>
						<a href="addScout.php">Add Scout</a>
					</li>
					<li>
						<a href="scouts.php">List Scouts</a>
					</li>
				</ul>
			</li>			
			<li>Reports <span class="arrow"> &#x25bc </span>
				<ul>
					<li>
						<a href="scoutOrders.php">Scouts Orders</a>
					</li>
					<li>
						<a href="scoutsTotals.php">Scouts Totals</a>
					</li>
					<li>
						<a href="selectScout.php">Select Scout</a>
					</li>
				</ul>
			</li>			
			<li>Download<span class="arrow"> &#x25bc </span>
				<ul>
					<li>
						<a href="exportFile.php?report=flower">Flower Order</a>
					</li> 
					<li>
						<a href="exportFile.php?report=all">All Data</a>
					</li> 
				</ul>
			</li>	
		</ul>
	</nav>
	<main class="main">
		<?=$output?>
	</main>

	<footer>
		 <p>&copy; bsps <?=date('Y')?></p>
	</footer>
</div>
<script type="text/javascript" defer="defer"
		src="../js/order.js">
</script>
</body>
</html>