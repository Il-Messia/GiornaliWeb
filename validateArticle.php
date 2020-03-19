<?php

$title = 'Valida';

include './dbManager/checkLogged.php';
$loginmanager = new loginManager;

$dbmanager = new dbManager;

$id = $_GET['id'];

$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$query = "SELECT IdArticolo, Titolo, Abstract, Testo, DataInizioVis, DataFineVis, Autore FROM articolo WHERE IdArticolo = $id";

$res = $dbmanager->runQuery($query);

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $titolo = $row['Titolo'];
        $abstract = $row['Abstract'];
        $testo = $row['Testo'];
        $datain = $row['DataInizioVis'];
        $datafin = $row['DataFineVis'];
        $idScrittore = $row['Autore'];
    }
}

$query = "SELECT Nome, Cognome FROM studenti WHERE idStudente = $idScrittore";

$res = $dbmanager->runQuery($query);

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $nome = $row['Nome'];
        $cognome = $row['Cognome'];
    }
}

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
        <div class="uk-navbar-left">
            <a class="uk-navbar-toggle" href="index.php" uk-toggle="target: #offcanvas-push">
                <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
            </a>
            <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
                <div class="uk-offcanvas-bar">

                    <button class="uk-offcanvas-close" type="button" uk-close></button>

                    <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                        <li class="uk-nav-header">Pagina corrente</li>
                        <li class="uk-active"><a href="index.php"><?php echo "$title"; ?></a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">Menu</a>
                            <ul class="uk-nav-sub">
                                <li><a href="index.php">Home</a></li>
                                <?php
                                if ($loginmanager->getAccounttype() === "admin" || $loginmanager->getAccounttype() === "validatore" || $loginmanager->getAccounttype() === "scrittore") {
                                    echo '<li><a href="write.php">Scrivi</a></li>';
                                }
                                ?>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="testDBconnection.php">Test</a></li>
                                <?php
                                if ($loginmanager->getAccounttype() === "admin" || $loginmanager->getAccounttype() === "validatore") {
                                    echo '<li><a href="valida.php">Da validare</a></li>';
                                }
                                ?>
                                <?php
                                if ($loginmanager->getAccounttype() === "admin") {
                                    echo '<li><a href="addAccount.php">Aggiungi account</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                    </ul>
                </div>
            </div>
        </div>

    </nav>
    <div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-exapand uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Validazione</h3>
                            <?php echo '<form class="uk-form-stacked" method="POST" action="validationResult.php?id=' . $id . '">';?>
                            
                                <div class="uk-margin">
                                    <h2><?php echo $titolo ?></h2>
                                </div>
                                <hr class="uk-divider-small">
                                <div class="uk-margin">
                                    <h4><?php echo $abstract ?></h4>
                                </div>
                                <hr class="uk-divider-small">
                                <div class="uk-margin">
                                    <h5><?php echo $testo ?></h5>
                                </div>
                                <hr class="uk-divider-small">
                                <div class="uk-margin">
                                    <ul class="uk-list">
                                        <li>
                                            <span class="uk-margin-small-right uk-icon" uk-icon="calendar"></span>
                                            <?php echo $datain; ?>
                                        </li>
                                        <li>
                                            <span class="uk-margin-small-right uk-icon" uk-icon="calendar"></span>
                                            <?php echo $datafin; ?>
                                        </li>
                                    </ul>
                                </div>
                                <hr class="uk-divider-small">
                                <div class="uk-margin">
                                        <span class="uk-margin-small-right uk-icon" uk-icon="user"></span>
                                        <?php echo $nome . ' ' . $cognome; ?>
                                </div>
                                <hr class="uk-divider-small">
                                <div class="uk-margin">
                                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">
                                        Valida
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>