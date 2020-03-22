<?php

$title = 'Valida';

include_once './dbManager/checkLogged.php';
include_once './UI/UIManager.php';

$loginmanager = new loginManager;
$dbmanager = new dbManager;
$uimanager = new UImanager($loginmanager);

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

$qryCat = "SELECT IdCategoria, Nome FROM categorie";
$cat = $dbmanager->runQuery($qryCat);

$dbmanager->closeConnection();

function getHW($idArt)
{
    $query = 'SELECT hotwords.HotWord FROM hotwords, HA WHERE HA.articolo = ' . $idArt . ' and HA.HotWord = idHW';
    $tmpdbmanager = new dbManager;
    $tmpdbmanager->setUsername(1000);
    $tmpdbmanager->connect();
    $var = $tmpdbmanager->runQuery($query);
    $tmpdbmanager->closeConnection();
    return $var;
}

$HW = getHW($id);

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
    </nav>
    <div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-exapand uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Validazione</h3>
                            <?php echo '<form class="uk-form-stacked" method="POST" action="validationResult.php?id=' . $id . '">'; ?>

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
                            <p class="uk-article-meta">
                                <?php if (mysqli_num_rows($HW) > 0) {
                                    while ($row = mysqli_fetch_array($HW)) {
                                        echo '#' . $row['HotWord'];
                                    }
                                }
                                ?>
                            </p>
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