<?php
$db_host = "localhost";
$db_user = "ubuntu";
$db_password = "ubuntu";
$db_name = "karteikarten_db";
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$minlevel = 0;
$maxlevel = 2;
$keyword = "";
if (array_key_exists("minlevel", $_GET)) {
    $minlevel = $_GET["minlevel"];
}
if (array_key_exists("maxlevel", $_GET)) {
    $maxlevel = $_GET["maxlevel"];
}
if (array_key_exists("keyword", $_GET)) {
    $keyword = $_GET["keyword"];
}

if ($minlevel > $maxlevel)
    $minlevel = $maxlevel;


$query = "SELECT *  FROM karteikarten WHERE schwierigkeit >= " . $minlevel . " and schwierigkeit <= " . $maxlevel . " and frage LIKE '%" . $keyword . "%' ;";
$result = $conn->query($query);

$i = 0;
if (array_key_exists("i", $_GET)) {
    $i = $_GET["i"];
}

$frageid = 2;
$antwortid = 3;
$schwierigkeitid = 1;
$idid = 0;

$arr = $result->fetch_all();

$conn->close();


$random = rand(0, count($arr) - 1);

$frage = $arr[$random][$frageid];
$schwierigkeit = $arr[$random][$schwierigkeitid];
$antwort = $arr[$random][$antwortid];

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
</head>



<header>
    <div style="text-align: center;">
        <img src="../image/logoblabla.png" alt="Dein Logo" class="logo" width="970" height="275">
    </div>
</header>

<body>
    <div class="container">
        <div class="sidebar active">
            <div class="menu-btn">
                <i class="ph-bold ph-caret-left"></i>
            </div>
            <div class="head">
                <div class="user-img">
                    <img src="../html-sidebar/user.jpg" alt="">
                </div>
                <div class="user-details">
                    <p class="title">web developer</p>
                    <p class="name">John Doe</p>
                </div>
            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-house-simple"></i>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-user"></i>
                                <span class="text">Audienc</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="text">Subscribers</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="#">
                                <i class="icon ph-bold ph-file-text"></i>
                                <span class="text">Post</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-calendar-blank"></i>
                                <span class="text">Schedules</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-chart-bar"></i>
                                <span class="text">Income</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">Earnings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="text">Funds</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="text">Declines</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="text">Payouts</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Settings</p>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-gear"></i>
                                <span class="text">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <p class="title">Account</p>
                <ul>
                    <li>
                        <a href="#">
                            <i class="icon ph-bold ph-info"></i>
                            <span class="text">Help</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon ph-bold ph-sign-out"></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous"></script>
    <script src="../html-sidebar/script.js"></script>

    <div class="frage_antwort">

        <input id="cb" type="checkbox" class="flip" />
        <div class="fliplabel"><label for="cb" class="fliplabel"><img class="fliplabel"
                    src="../image/flip.svg" /></label></div>
        <div class="frage">
            <?php
            echo $frage;
            ?>
        </div>

        <div class="antwort">
            <?php
            echo $antwort;
            ?>
        </div>
        <img class="KARTE_icon" src=<?php
        if ($schwierigkeit == 2) {
            echo '../image/schwer.svg';
        } elseif ($schwierigkeit == 1) {
            echo '../image/mittel.svg';
        } else {
            echo '../image/easy.svg';
        }
        ?> />

    </div>

    <br />
    <form action=#>

        <div class="radio">
            <div class="neue_frage" width=200px>minlevel</div>
            <br />
            <label><input type="radio" value=0 name="minlevel" <?php if ($minlevel == 0)
                echo "checked" ?> /><span /></label>
                <label><input type="radio" value=1 name="minlevel" <?php if ($minlevel == 1)
                echo "checked" ?> /><span /></label>
                <label><input type="radio" value=2 name="minlevel" <?php if ($minlevel == 2)
                echo "checked" ?> /><span /></label>
                <br />
                <div class="neue_frage" width=200px>maxlevel</div>
                <br />
                <label><input type="radio" value=0 name="maxlevel" <?php if ($maxlevel == 0)
                echo "checked" ?> /><span /></label>
                <label><input type="radio" value=1 name="maxlevel" <?php if ($maxlevel == 1)
                echo "checked" ?> /><span /></label>
                <label><input type="radio" value=2 name="maxlevel" <?php if ($maxlevel == 2)
                echo "checked" ?> /><span /></label>
                <input type="hidden" name=i value=<?php echo $i + 1 ?> />
            <br />
            <div class="neue_frage" width=200px>keyword</div>
            <br />
            <input type="text" name="keyword" value="<?php echo $keyword ?>" style="width: 155px;" />
            <br />
            <br />
            <div class="index">
                <?php echo $i ?>
            </div>
        </div>
        <input type="submit" value=">" class="next" />
    </form>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <footer>
        <div class="footer-content">
            <ul class="footer-links">
                <li><a href="landingpage/agb.html">AGB</a></li>
                <li><a href="#">Über uns</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
            <p class="footer-email">E-Mail: <a href="mailto:info@example.com">info@example.com</a></p>
        </div>
    </footer>
    </div>

</body>


</html>
