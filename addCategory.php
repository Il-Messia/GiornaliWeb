<?php

$title = 'Aggiungi categoria';
include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);


$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();
$qryCat = "SELECT IdCategoria, Nome FROM categorie";
$cat = $dbmanager->runQuery($qryCat);
if (isset($_POST['nomeCat']) && $_POST['nomeCat'] != "") {
    $tmpQuery = 'INSERT INTO Categorie (Nome) VALUES ("' . $_POST['nomeCat'] . '")';
    $res = $dbmanager->runQuery($tmpQuery);
    if ($res) {
        echo '<div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Aggiunto con successo</p>
            </div>';
    } else {
        echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Errore inserimento</p>
            </div>';
    }
}else{
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
        <?php
        $uimanager->sxMenu($title, $cat);
        ?>
    </nav>
    <?php


    if ($loginmanager->getStatus() && $loginmanager->getAccounttype() === "admin") {
        echo '<div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Aggiungi categoria</h3>
                            <form class="uk-form-stacked" method="post" action="addCategory.php">
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Nome</label>
                                    <div class="uk-inline uk-width-1-1">
                                            <input class="uk-input uk-form-large" type="text" name="nomeCat" required>
                                        </div>
                                </div>
                                <div class="uk-margin">
                                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">
                                            Aggiungi  
                                    </button>
                                </div>
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