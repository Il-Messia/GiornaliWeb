<?php

$title = 'Scrivi';
include './dbManager/checkLogged.php';
$loginmanager = new loginManager;
$dbmanager = new dbManager;
$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$titolo = $_POST['titolo'];
$abstract = $_POST['abstract'];
$testo = $_POST['testo'];
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
                        <li class="uk-active"><a href="write.php"><?php echo "$title"; ?></a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">Menu</a>
                            <ul class="uk-nav-sub">
                                <li><a href="index.php"></span class="uk-margin-small-left">Home<span></a></li>
                                <li><a href="write.php">Scrivi</a></li>
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