<?php

$title = 'Scrivi';
include './dbManager/checkLogged.php';
$loginmanager = new loginManager;
$today = date("Y/m/d");

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
    </nav>
    <?php


    if ($loginmanager->getStatus() and ($loginmanager->getAccounttype() === "scrittore" || $loginmanager->getAccounttype() === "admin" || $loginmanager->getAccounttype() === "validatore")) {
        echo '<div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-exapand uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Scrivi!</h3>
                            <form class="uk-form-stacked" method="POST" action="writeResult.php">
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Titolo</label>
                                    <div class="uk-form-controls">
                                        <input name="titolo" class="uk-input uk-form-width-large" id="form-stacked-text" type="text" placeholder="Titolo..." required maxlength="70">
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Abstract</label>
                                    <textarea name="abstract" class="uk-textarea" rows="5" placeholder="Abstract..." required maxlength="250"></textarea>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Testo</label>
                                    <textarea name="testo" class="uk-textarea" rows="5" placeholder="Testo..."></textarea>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Data inizio visibilità</label>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input name="datain" class="uk-input" placeholder="' . $today . '" required minlength="10" maxlength="10">
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Data fine visibilità</label>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input name="datafin" class="uk-input" placeholder="' . $today . '" required minlength="10" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                        <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">
                                            Carica  
                                        </button>
                                    </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } else {
        echo '<div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
            <div class="uk-width-1-1">
                <div class="uk-container">
                    <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                        <div class="uk-width-1-1@m">
                            <div
                                class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                                <h3 class="uk-card-title uk-text-center">Attenzione!</h3>
                                <div class="uk-text-small uk-text-center">
                                        <h4>Devi accedere con uaccount del tipo SCRITTORE o VALIDATORE</h4>
                                </div>    
                                <div class="uk-text-small uk-text-center">
                                        Torna al <a href="login.php">Login</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>
</body>

</html>