<?php

$title = 'Login';
include './dbManager/checkLogged.php';
$loginmanager = new loginManager;
if (isset($_POST['username'])) {
    $user = $_POST['username'];
}
if (isset($_POST['password'])) {
    $pass = $_POST['password'];
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $loginmanager->login($user, $pass);
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
                        <li class="uk-active"><a href="login.php"><?php echo "$title"; ?></a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-parent">
                            <a href="#">Menu</a>
                            <ul class="uk-nav-sub">
                                <li><a href="index.php"></span class="uk-margin-small-left">Home<span></a></li>
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
    </nav>
    <?php
    if ($loginmanager->getStatus()) {
        echo '<div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
            <div class="uk-width-1-1">
                <div class="uk-container">
                    <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                        <div class="uk-width-1-1@m">
                            <div
                                class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                                <h3 class="uk-card-title uk-text-center">Bentornato!</h3>
                                <form method="post" action="logout.php">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                                            <span class="uk-input uk-form-large">';
        echo $loginmanager->getUsername();
        echo '
                                            </span>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: world"></span>
                                            <span class="uk-input uk-form-large">';
        echo $loginmanager->getAccounttype();
        echo '
                                            </span>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">
                                            Logout   
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
        echo '
        <div class="uk-section uk-section-muted uk-flex uk-flex-middle" uk-height-viewport>
            <div class="uk-width-1-1">
                <div class="uk-container">
                    <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                        <div class="uk-width-1-1@m">
                            <div
                                class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                                <h3 class="uk-card-title uk-text-center">Benvenuto!</h3>
                                <form method="post" action="login.php">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                                            <input class="uk-input uk-form-large" type="text" name="username">
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input uk-form-large" type="password" name="password">
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <button
                                            class="uk-button uk-button-primary uk-button-large uk-width-1-1">Login</button>
                                    </div>
                                </form>
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