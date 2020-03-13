<?php

$title = 'Aggiungi account';
include './dbManager/checkLogged.php';
$loginmanager = new loginManager;
$dbmanager = new dbManager;
$dbmanager->setUsername($loginmanager->toNumber());
$dbmanager->connect();
$students = $dbmanager->runQuery("SELECT IdStudente, Nome, Cognome FROM Studenti");
$accountType = $dbmanager->runQuery("SELECT IdTA, Nome FROM tipiaccount");
$dbmanager->closeConnection();

function printStudents($var){
    if (mysqli_num_rows($var) > 0) {
        while ($row = mysqli_fetch_assoc($var)) {
            echo '<option value="' . $row['IdStudente'] .'">' . $row['Nome'] . ' '. $row['Cognome'] . '</option>\n';
        }
    }
}
function printAccountType($var){
    if (mysqli_num_rows($var) > 0) {
        while ($row = mysqli_fetch_assoc($var)) {
            echo '<option value="' . $row['IdTA'] .'">' . $row['Nome'] . '</option>\n';
        }
    }
}
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


    if ($loginmanager->getStatus() && $loginmanager->getAccounttype() === "admin") {
        echo '<div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Aggiungi account</h3>
                            <form class="uk-form-stacked" method="POST" action="addAccountResult.php">
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Studente</label>
                                    <select class="uk-select" name="student">';
                                        printStudents($students);
                                echo '</select>
                                </div>
                                <div class="uk-margin">
                                    <span class="uk-text-middle">Studente non trovato? Aggiungi uno </span>
                                        <div uk-form-custom>
                                            <span class="uk-link"><a href="addStudent.php">studente</a></span>
                                        </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Username</label>
                                    <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                                            <input class="uk-input uk-form-large" type="text" name="username" required maxlength="50">
                                        </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Tipologia account</label>
                                    <select class="uk-select" name="accounttype">';
                                        printAccountType($accountType);
                                echo '</select>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-text">Password</label>
                                    <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input uk-form-large" type="password" required maxlength="500" name="password">
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