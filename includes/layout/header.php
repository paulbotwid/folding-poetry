<?php
ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
	<title>folding poetry - creative collaboration in the blind</title>
	<meta name="description" content="A global game of exquisite corpse poetry, write a line - fold it down - pass it on. Creative collaboration in the blind.">
	<meta property="og:title" content="folding poetry - creative collaboration in the blind" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Folding Poetry" />
	<meta property="og:description" content="A global game of exquisite corpse poetry, write a line - fold it down - pass it on. Creative collaboration in the blind." />
	<meta property="og:url" content="http://www.foldingpoetry.com" />
	<meta property="og:image" content="http://www.foldingpoetry.com/img/cover.jpg" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
	<link href="style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.typeit/4.3.0/typeit.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"type="text/javascript"></script>
	<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
	<script src="//twemoji.maxcdn.com/2/twemoji.min.js?2.3.0"></script>
	<script src="js/min/modernizer-min.js"></script>
	<script src="js/js.cookie.js"></script>
	<script src="js/min/foldingpoetry-min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Arbutus+Slab|Shrikhand|Yeseva+One|Rakkas|Abril+Fatface|Audiowide|Josefin+Slab:400,600|Anton|Questrial" rel="stylesheet">
	<!-- FAVICON START -->
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="manifest" href="manifest.json">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="msapplication-config" content="browserconfig.xml">
	<meta name="theme-color" content="#fafafa">
</head>
<body>
	<div id="message-overlay" class="fullpage">
		<div>
			<h2 id="alert-title">Are you there?</h2>
			<span id="alert-first">If not, we're gonna let someone else have a go :)</span>
			<span id="alert-second">Letting it go in <span id="countdown">10</span> seconds</span><br>
			<button onclick="stay()" id="stay">Keep writing</button>
		</div>
	</div>
<main>
	<section id="top-page">
	<div id='location_display'></div>
	<header ondblclick="clear_cookies()">
		<a class="nav-link" id="page-title" href="http://www.foldingpoetry.com"><span>folding poetry</span></a>
		<nav>
			<a id="write-poetry-link" href="index.php">write poetry</a>
			<a id="arrow-down" class="nav-link" href="#under">read poetry</a>
			<!-- <a id="my-poems-link" class="nav-link" href="my_poems.php">my poems</a> -->
			<a id="about-link" class="nav-link" href="about.php">about</a>
		</nav>
	</header>
