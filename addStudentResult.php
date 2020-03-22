<?php

$title = 'Aggiungi studente';
include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);
$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();

$name = $_POST['nome'];
$cognome = $_POST['cognome'];
$citta = $_POST['luogo'];
$data = $_POST['data'];

$query = 'INSERT INTO studenti (Nome,Cognome,Citta,DataNascita) VALUES ("' . $name . '","' . $cognome . '","' . $citta . '","' . $data . '")';
$result = $dbmanager->runQuery($query);
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
                                    echo "<font color='#03fc9d'>Inserimento avvenuto correttamente</font>";
                                    echo '  <br><span class="uk-text-middle">Torna alla aggiunta </span>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="addAccount.php">account</a></span>
                                            </div>';
                                } else {
                                    echo "<font color='#fc3503'>Inserimento fallito</font>";
                                    echo '  <br><span class="uk-text-middle">Torna alla aggiunta </span>
                                            <div uk-form-custom>
                                                <span class="uk-link"><a href="addStudent.php">studenti</a></span>
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