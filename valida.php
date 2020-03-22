<?php

$title = 'Valida';

include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';
$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);

$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$query = "SELECT IdArticolo, Titolo, Abstract, DataInizioVis FROM articolo WHERE Visionatore IS NULL";

$res = $dbmanager->runQuery($query);

$today1 = date("Y/m/d");
$today2 = date("Y-m-d");

function getHW($idArt)
{
    $query = 'SELECT hotwords.HotWord FROM hotwords, HA WHERE HA.articolo = ' . $idArt . ' and HA.HotWord = idHW';
    $tmpdbmanager = new dbManager;
    $tmpdbmanager->setUsername(1000);
    $tmpdbmanager->connect();
    $var = $tmpdbmanager->runQuery($query);
    $tmpdbmanager->closeConnection();
    return $var;
}

$qryCat = "SELECT IdCategoria, Nome FROM categorie";
$cat = $dbmanager->runQuery($qryCat);

$dbmanager->closeConnection();

?>

<html>

<head>
    <title>
        <?php echo "$title"; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body class="uk-animation-fade">
    <nav class="uk-navbar uk-navbar-container uk-margin">
        <?php
        $uimanager->sxMenu($title,$cat);
        ?>
        <div class="uk-navbar-right">
            <div>
                <a class="uk-navbar-toggle" uk-search-icon href="#"></a>
                <div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">
                    <form class="uk-search uk-search-navbar uk-width-1-1">
                        <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
        <?php
        $i = 0;
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                    if ($i % 2 === 0) {
                        $uimanager->printsxVal($row, $today1, $today2, getHW($row['IdArticolo']));
                    } else {
                        $uimanager->printdxVal($row, $today1, $today2, getHW($row['IdArticolo']));
                    }
                    $i++;
            }
        }
        ?>
    </div>

</body>

</html>