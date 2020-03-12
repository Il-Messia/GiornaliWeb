<?php

$title = 'Test';
include './dbManager/connect.php';

$test = new dbManager;

$test->test();
$test->closeConnection();

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
                                <li><a href="index.php"></span class="uk-margin-small-left">Home<span></a></li>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="testDBconnection.php">Test</a></li>
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
                    if ($test->getStatus()) {
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
                                <?php if ($test->getStatus()) {
                                    echo "<font color='#03fc9d'>Connessione effettuata correttamente</font>";
                                } else {
                                    echo "<font color='#fc3503'>Connessione fallita</font>";
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