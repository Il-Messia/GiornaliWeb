<?php

if(isset($_GET['id'])){
    $title = 'Funziona';
}



include './dbManager/checkLogged.php';
$loginmanager = new loginManager;

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
                                    echo '<li><a href="valida.php">Aggiungi account</a></li>';
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
            <div>
                <a class="uk-navbar-toggle" uk-search-icon href="#"></a>
                <div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">
                    <form class="uk-search uk-search-navbar uk-width-1-1">
                        <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
        <div uk-scrollspy="cls: uk-animation-slide-left; repeat: true">
            <a class="uk-link-reset" href="testDBconnection.php">
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <div class="uk-card-badge uk-label">New</div>
                    <h3 class="uk-card-title">Test</h3>
                    <p>OnClick testing</p>
                </div>
            </a>

        </div>
        <div uk-scrollspy="cls: uk-animation-slide-right; repeat: true">
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="uk-card-title">Prova articolo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <?php


        for ($i = 0; $i < 23; $i++) {
            if($i%2===0){
                echo '<div uk-scrollspy="cls: uk-animation-slide-left; repeat: true">
                            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                                <h3 class="uk-card-title">Prova articolo</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>';
            }else{
                echo '<div uk-scrollspy="cls: uk-animation-slide-right; repeat: true">
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">Prova articolo</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>';
            }
            
        }
        ?>
    </div>

</body>

</html>