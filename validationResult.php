<?php

/*
De Leo Alex 5^CIA
Pagina che permette di vedere i risultati della validazione
*/

$title = 'Valida';

include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);

$id = $_GET['id'];

$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$user = $loginmanager->getUsername();
$query = "SELECT Studente FROM account WHERE Username = '$user'";
$res = $dbmanager->runQuery($query);

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $idStudente = $row['Studente'];
    }
}

$query = "UPDATE articolo SET Visionatore = $idStudente WHERE IdArticolo = $id";
$res = $dbmanager->runQuery($query);

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
        <?php $uimanager->sxMenu($title,$cat); ?>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <?php
                    if ($res) {
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
                                <?php if ($res) {
                                    echo "<font color='#03fc9d'>Articolo validato correttamente.</font>";
                                    echo '  <br>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="index.php">Home</a></span>
                                            </div>';
                                } else {
                                    echo "<font color='#fc3503'>Validamento fallito</font>";
                                    echo '  <br><span class="uk-text-middle">Errore validamento articolo, </span>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="valida.php">ritenta</a></span>
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