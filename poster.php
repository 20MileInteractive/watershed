<html>
	<head>
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body>
		<header>
	<div class="row">
		<div class="columns large-12">
			<a class='current' href="index.html"><h1 class="site-id"><img src="assets/img/cch2o-logo.png"></h1></a>
		</div>
	</div>
	<div class="row">
		<div class="columns large-12">
			<nav>


			<ul>
				<li class='current'><a href="index.html" class="current active">The Problem</a></li>
				<li><a href="my-watershed.html">My Watershed</a></li>
				<li><a href="#">Find a Solution</a></li>
				<li><a href="learn-more.html">Learn More</a></li>
			</ul>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="columns large-12">
			<img src="assets/img/homes.png" id="homes">
		</div>
	</div>
</header>

<div class="page-content watershed-poster"> 

	<section class="intro">
		<h1>Watershed Stats</h1>
	</section>
	<div class="row">
		<div class="columns small-12">
	
<?

	include('db.php');
	$watershed = $_GET['watershed'];
	echo "<h2>" . $watershed . "</h2>";
	$q = "Select * from watershed_data where short_name = '" . $watershed . "'";
	$r = mysql_query($q);
	// while($data = mysql_fetch_object($r)
	// {
	// 	echo "<h1>" . $data->name . "</h1>";
	// 	echo "<p>Acreage: " . $data->size . "</p>";
	// }


?>
		</div>
	</div>
</div>

	</body>


</html>