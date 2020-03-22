<?php

$title = 'Scrivi';
include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);
$today = date("Y/m/d");

$dbmanager->setUsername(100);
$dbmanager->connect();
$qryCat = "SELECT IdCategoria, Nome FROM categorie";
$cat = $dbmanager->runQuery($qryCat);
$catForm = $dbmanager->runQuery($qryCat);
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
                                    <textarea name="abstract" class="uk-textarea" rows="3" placeholder="Abstract..." required maxlength="250"></textarea>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Testo</label>
                                    <textarea name="testo" class="uk-textarea" rows="5" placeholder="Testo..."></textarea>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Hot Words</label>
                                    <textarea name="hotWord" class="uk-textarea" rows="3" placeholder="#prova #hotWord #ecc..."></textarea>
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
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Categoria</label>
                                    <select class="uk-select" name="category">';
                                    if (mysqli_num_rows($catForm) > 0) {
                                        while ($row = mysqli_fetch_assoc($catForm)) {
                                            echo '<option value="' . $row['IdCategoria'] . '">' . $row['Nome'] . '</option>';
                                        }
                                    }
                                    echo '</select>
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