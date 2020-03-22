<?php

/*
De Leo Alex 5^CIA
Pagina per testare la connessione al DB
*/

$title = 'Test';
include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';
$loginmanager = new loginManager;
$test = new dbManager;
$uimanager = new UImanager($loginmanager);

$test->test();

$qryCat = "SELECT IdCategoria, Nome FROM categorie";
$cat = $test->runQuery($qryCat);

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
        <?php $uimanager->sxMenu($title,$cat); ?>
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