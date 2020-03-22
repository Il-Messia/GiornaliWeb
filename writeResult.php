<?php

$title = 'Scrivi';
include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);
$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$titolo = $_POST['titolo'];
$abstract = $_POST['abstract'];
$testo = $_POST['testo'];

$hwIndex = 0;
$hotwords = array();
array_push($hotwords, "");
$hotwordstmp = $_POST['hotWord'];
for ($i = 0; $i < strlen($hotwordstmp); $i++) {
    if ($hotwordstmp[$i] === '#' && $i != 0) {
        $hwIndex++;
        array_push($hotwords, "");
    } else {
        if ($hotwordstmp[$i] != '#') {
            $hotwords[$hwIndex] .= $hotwordstmp[$i];
        }
    }
}
$hwIndex++;

$datain = $_POST['datain'];
$datafin = $_POST['datafin'];

$querystudente = 'SELECT studente FROM account WHERE Username = "' . $loginmanager->getUsername() . '"';
$studente = $dbmanager->runQuery($querystudente);
if (mysqli_num_rows($studente) > 0) {
    while ($row = mysqli_fetch_assoc($studente)) {
        $query = 'INSERT INTO articolo (Titolo,Abstract,Testo,DataInizioVis, DataFineVis, Autore) VALUES ("' . $titolo . '","' . $abstract . '","' . $testo . '","' . $datain . '","' . $datafin . '",' . $row['studente'] . ')';
    }
    $result = $dbmanager->runQuery($query);
}

if ($result) {
    $queryId = 'SELECT idArticolo FROM articolo ORDER BY idArticolo DESC LIMIT 1';
    $idRes = $dbmanager->runQuery($queryId);
    if (mysqli_num_rows($idRes) > 0) {
        $row = mysqli_fetch_assoc($idRes);
        $idArt = $row['idArticolo'];
    }
    for ($i = 0; $i < $hwIndex; $i++) {
        $tmpQuery = 'SELECT idHW FROM hotwords WHERE HotWord = "' . $hotwords[$i] . '"';
        $res = $dbmanager->runQuery($tmpQuery);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $idHW = $row['idHW'];
            $tmpQuery = 'INSERT INTO HA (HotWord, Articolo) VALUES (' . $idHW . ', ' . $idArt . ')';
            $dbmanager->runQuery($tmpQuery);
        } else {
            $tmpQuery = 'INSERT INTO hotwords (HotWord) VALUES ("' . $hotwords[$i] . '")';
            $dbmanager->runQuery($tmpQuery);
            $tmpQuery = 'SELECT idHW FROM hotwords ORDER BY idHW DESC LIMIT 1';
            $restmp = $dbmanager->runQuery($tmpQuery);
            if (mysqli_num_rows($restmp) > 0) {
                $row = mysqli_fetch_array($restmp);
                $idHW = $row['idHW'];
                echo 'Insert the word: ' . $idHW;
                $tmpQuery = 'INSERT INTO HA (HotWord, Articolo) VALUES (' . $idHW . ', ' . $idArt . ')';
                $dbmanager->runQuery($tmpQuery);
            }
        }
    }
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
        <?php $uimanager->sxMenu($title, $cat); ?>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <?php
                    if ($result) {
                        echo "<span class='uk-label uk-label-success uk-margin-small-right'>Succes</span>";
                    } else {
                        echo "<span class='uk-label uk-label-danger uk-margin-small-right'>Failed</span>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">
                                <?php if ($result) {
                                    echo "<font color='#03fc9d'>Caricamento avvenuto correttamente</font>";
                                    echo '  <br><span class="uk-text-middle">Torna alla home in attesa che l articolo venga validato. </span>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="index.php">Home</a></span>
                                            </div>';
                                } else {
                                    echo "<font color='#fc3503'>Inserimento fallito</font>";
                                    echo '  <br><span class="uk-text-middle">Torna alla scrittura. </span>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="write.php">Scrivi</a></span>
                                            </div>';
                                } ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>