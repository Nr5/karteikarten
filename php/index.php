<?php

require '../../credentials.php';
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
	die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$minlevel=0;
$maxlevel=2;
$keyword = "";
if (array_key_exists("minlevel",$_GET)){
	$minlevel=$_GET["minlevel"];
}
if (array_key_exists("maxlevel",$_GET)){
	$maxlevel=$_GET["maxlevel"];
}
if (array_key_exists("keyword",$_GET)){
	$keyword=$_GET["keyword"];
}

if ($minlevel > $maxlevel) $minlevel = $maxlevel;


$query = "SELECT *  FROM karteikarten WHERE schwierigkeit >= " . $minlevel . " and schwierigkeit <= " . $maxlevel . " and frage LIKE '%" . $keyword . "%' ;" ;
$result = $conn->query($query);

$i=0;
if (array_key_exists("i",$_GET)){
	$i = $_GET["i"];
}

$frageid=2;
$antwortid=3;
$schwierigkeitid=1;
$idid=0;

$arr = $result->fetch_all();

$conn->close();


$random = rand(0,count($arr)-1);

$frage = $arr[$random][$frageid];
$schwierigkeit = $arr[$random][$schwierigkeitid];
$antwort = $arr[$random][$antwortid];
$id = $arr[$random][$idid];
?>
<!DOCTYPE html>
<html lang="en">




<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- STYLESHEET -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../html-sidebar/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/faq_style.css">
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../css/kartenstyle.css">

    <style>
	body {
	    background-image: url('../image/background6.jpg');
	    background-size: cover;
	    /* Optional: Das Bild so skalieren, dass es den gesamten Hintergrund bedeckt */
	    background-repeat: no-repeat;
	    /* Optional: Wiederholung des Bildes deaktivieren */
	}
    </style>
    <link rel="icon" type="image/png" href="../image/favicon.ico">

</head>



<header>
    <div style="text-align: center;">
	<a href="index.php" ><img src="../image/logoblabla.png" alt="Dein Logo" class="logo" width="970" height="275"></a>
    </div>
</header>

<body>

<form action=#>
<?php require('../html-sidebar/sidebar.html'); ?>

<div class="centered-container">
<div class="frage_antwort">

        <!--<div class = "clicker" tabindex="1">Antwort anzeigen</div>-->
        <input id="cb" type="checkbox" class="flip" />
        <div class = "fliplabel" ><label for="cb" class="fliplabel"><img class="fliplabel" src="../image/flip.svg"/></label></div>
        <div class = "frage">
            <img src="../image/fragezeichen.svg" class="icon_qa" />
            <b> <?php echo $id ?> </b>
            <?php
            echo $frage;
            ?>
        </div>
        <div class = "antwort">
            <img src="../image/ausrufezeichen.svg" class="icon_qa" />
            <?php 
            echo $antwort;
            ?>
        </div>
       <img class="k_icon" src=<?php
                    if ($schwierigkeit == 2) {
                        echo '../image/schwer.svg';
                    } elseif ($schwierigkeit == 1) {
                        echo '../image/mittel.svg';
                    } else {
                        echo '../image/easy.svg';
                    }
       ?> />
</div>

	<input type = "hidden" name=i value = <?php echo $i + 1 ?> />
    <input type = "submit" value=">" class="next" />
</div>
</form>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

    <footer>
	<div class="footer-content">
	    <ul class="footer-links">
		<li><a href="agb.html">AGB</a></li>
		<li><a href="acordion.html">FAQ</a></li>
		<li><a href="#">Kontakt</a></li>
	    </ul>
	    <p class="footer-email">E-Mail: <a href="mailto:info@example.com">info@example.com</a></p>
	</div>
    </footer>

</html>
