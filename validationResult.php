<?php

$title = 'Valida';

include './dbManager/checkLogged.php';
$loginmanager = new loginManager;

$dbmanager = new dbManager;

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