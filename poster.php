<html>
	<head>
		<link rel="stylesheet" href="http://watershed.20miletech.net/Build/assets/css/styles.css">
		<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "16080090-0488-4053-b8f8-c42db1bf4dd2", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
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
		<h1>Your Watershed Facts</h1>
	</section>
	<div class="row">
		<div class="columns small-12">
	
<?

	include('db.php');
	$watershed = $_GET['watershed'];
	// echo "<h2>" . $watershed . "</h2>";
	$q = "Select * from watershed_data where short_name = '" . $watershed . "'";
	$r = mysql_query($q);
	$data = mysql_fetch_object($r);
	// print_r($data);
	{
		// echo "<h1>" . $data->name . "</h1>";
		// echo "<p>" . $data->size . " acres</p>";
		// echo "<p>Water usage: " . number_format($data->water_usage) . " gallons/day</p>";
		// echo "<p>Wastewater: " . number_format($data->wastewater) . " gallons/day</p>";
		// echo "<p>Nitrogen: " . number_format($data->nitrogen_load) . " pounds/year</p>";
		// echo "<p>Water Threat Level: " . $data->threat_level . "</p>";

	}
	
	$white_house = imagecreatefrompng('/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/house_white_icon.png');
	$yellow_house = imagecreatefrompng('/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/house_yellow.png');

	$num_white_houses = $data->yr_households/100;
	$num_yellow_houses = $data->smr_households/100;
	$startx = 362;
	$starty = 444;
	$ttl_houses = 1;



$infographic = imagecreatefrompng('/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/poster_background.png');
	for ($i=0; $i < $num_white_houses; $i++) 
	{ 
		if ($ttl_houses%11 == 0)
		{
			$starty += 63;
			$startx = 362;
		}
		imagecopymerge($infographic, $white_house, $startx, $starty, 0, 0, 57, 63, 100);
		$startx += 57;
		$ttl_houses++;
	}
	for ($i=0; $i < $num_yellow_houses; $i++) 
	{ 
		if ($ttl_houses%11 == 0)
		{
			$starty += 63;
			$startx = 362;
		}
		imagecopymerge($infographic, $yellow_house, $startx, $starty, 0, 0, 57, 63, 100);
		$startx += 57;
		$ttl_houses++;
	}


$detail_img = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/detail_" . $data->short_name . ".png";
$detail_image = imagecreatefrompng($detail_img);
$detail_width = getimagesize('assets/img/detail_' . $data->short_name . ".png");
imagecopymerge($infographic, $detail_image, 40, 421, 0, 0, $detail_width[0], $detail_width[1], 100);

// $map_img = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/map_" . $data->short_name . ".png";
// $map_image = imagecreatefrompng($map_img);
// imagecopymerge($infographic, $map_image, $data->outline_x, $data->outline_y, 0, 0, $data->outline_w, $data->outline_h, 100);




// $infographic = imagecreatefrompng('/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/poster_base.png');
$white = imagecolorallocate($infographic, 0xFF, 0xFF, 0xFF);
$yellow = imagecolorallocate($infographic, 0xF6, 0xAD, 0x00);
$orange = imagecolorallocate($infographic, 0xD3, 0x3C, 0x1A);



$startletterx = 64;
$filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/letter_";

$name = str_split($data->name);
foreach ($name as $key => $value) {
	// echo $value[0];
	if ($value[0] == " ") {
		$value[0] = "_";
	}
	$value[0] = strtoupper($value[0]);
	$imagename = "assets/img/letter_" . $value[0] . ".png";
	$imagefile = $filepath . $value[0] . ".png";
	$imgwidth = getimagesize($imagename);
	$letter_image = imagecreatefrompng($imagefile);

	// echo "<img src='/Build/assets/img/letter_" . $value[0] . ".png' />";
	
	imagecopymerge($infographic, $letter_image, $startletterx, 203, 0, 0, $imgwidth[0], 39, 100);
	$startletterx += $imgwidth[0];
}

$start_summer = 568;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/yellow_number_";
$smr_households = str_split(number_format($data->smr_households));
// echo $smr_households[0];
foreach ($smr_households as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/yellow_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_summer, 723, 0, 0, $num_width[0], 60, 100);
	$start_summer += $num_width[0];
}

$start_yr = 364;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/white_number_";
$yr_households = str_split(number_format($data->yr_households));
// echo $smr_households[0];
foreach ($yr_households as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/white_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_yr, 723, 0, 0, $num_width[0], 60, 100);
	$start_yr += $num_width[0];
}

$start_size = 60;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/white_number_";
$size = str_split(number_format($data->size));
// echo $smr_households[0];
foreach ($size as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/white_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_size, 727, 0, 0, $num_width[0], 60, 100);
	$start_size += $num_width[0];
}

$start_usage = 629;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/white_number_";
$usage = str_split(number_format($data->water_usage));
// echo $smr_households[0];
foreach ($usage as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/white_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_usage, 932, 0, 0, $num_width[0], 60, 100);
	$start_usage += $num_width[0];
}

$start_waste = 158;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/dark_number_";
$waste = str_split(number_format($data->wastewater));
// echo $smr_households[0];
foreach ($waste as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/dark_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_waste, 1258, 0, 0, $num_width[0], 58, 100);
	$start_waste += $num_width[0];
}

$start_nitrogen = 575;
$num_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/dark_number_";
$nitrogen = str_split(number_format($data->nitrogen_load));
// echo $smr_households[0];
foreach ($nitrogen as $key => $value) {
	if ($value[0] == ",") {
		$value[0] = "_";
	}
	$num_img_name = "assets/img/dark_number_" . $value[0] . ".png";
	$num_img_file = $num_filepath . $value[0] . ".png";
	$num_width = getimagesize($num_img_name);
	$num_image = imagecreatefrompng($num_img_file);
	imagecopymerge($infographic, $num_image, $start_nitrogen, 1258, 0, 0, $num_width[0], 58, 100);
	$start_nitrogen += $num_width[0];
}

$start_threat = 70;
$threat_filepath = "/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/threat_";
$threat_img_name = "assets/img/threat_";

$level = strtolower($data->threat_level);
$img_width = getimagesize($threat_img_name . $level . ".png");
$threat_img = $threat_filepath . $level . ".png";
$threat_image = imagecreatefrompng($threat_img);
imagecopymerge($infographic, $threat_image, $start_threat, 1445, 0, 0, $img_width[0], 98, 100);

// imagestring($infographic, 10, 64, 203, $data->name, $white);
// imagestring($infographic, 4, 60, 713, $data->size, $white);
// imagestring($infographic, 4, 364, 726, number_format($data->yr_households), $white);
// imagestring($infographic, 4, 568, 727, number_format($data->smr_households), $yellow);
// imagestring($infographic, 4, 629, 932, number_format($data->water_usage), $white);
// imagestring($infographic, 4, 258, 1258, number_format($data->wastewater), $white);
// imagestring($infographic, 4, 575, 1258, number_format($data->nitrogen_load), $white);
// imagestring($infographic, 5, 89, 1450, $data->threat_level, $orange);


if(imagepng($infographic, '/var/www/vhosts/cch2o.org/httpdocs/Build/assets/img/poster_' . $watershed . '.png'))
{
	echo "<p><img src='/Build/assets/img/poster_" . $watershed . ".png' /></p>";
}
else
{
	echo "failed to create image";
}

?>
<!-- <p>The priority ranking criteria for this watershed is based on several measures; existing nitrogen levels, possible reductions through natural processes, and nitrogen reductions needed to meet water quality goals.</p> -->
			<p>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
				<span class='st_pinterest_large' displayText='Pinterest'></span>
				<span class='st_email_large' displayText='Email'></span>
				<span class='st_linkedin_large' displayText='LinkedIn'></span>
				<span class='st_sharethis_large' displayText='ShareThis'></span>
			</p>
		</div>
	</div>
</div>

<footer>
	<div class="row">
		<div class="columns large-10">
			<p>&copy;<SCRIPT>
				<!--
				var year=new Date();
				year=year.getYear();
				if (year<1900) year+=1900;
				document.write(year);
				//-->
				</SCRIPT> Cape Cod Commission</p>
		</div>
		<div class="columns large-2">
			<a href="http://www.20mile.in" target="_blank" id="20mile-mark"><img src="http://www.20mile.in/20mile-label-dark.png" alt="Made by 20Mile Interactive"></a>
		</div>
	</div>
</footer>

	</body>


</html>