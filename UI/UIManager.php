<?php
class UImanager
{
    private $loginmanager;
    private $url;
    private $urlSearch;
    private $urlCategory;

    public function __construct($loginmanager)
    {
        $this->loginmanager = $loginmanager;
        $this->url = "readArticle.php?id=";
        $this->urlSearch = "index.php?search=";
        $this->urlCategory = "index.php?cat=";
    }

    function printsx($var, $t1, $t2, $HW)
    {
        echo '<div uk-scrollspy="cls: uk-animation-slide-left; repeat: true">
                <a class="uk-link-reset" href="' . $this->url . $var['IdArticolo'] . '">
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">';
        if ($var['DataInizioVis'] === $t1 || $var['DataInizioVis'] === $t2) {
            echo '<div class="uk-card-badge uk-label">New</div>';
        }
        echo '               
                        <h3 class="uk-card-title">' . $var['Titolo'] . '</h3>
                        <p class="uk-text-meta uk-margin-remove-top"><time datetime="' . $var['DataInizioVis'] . 'T19:00">' . $var['DataInizioVis'] . '</time></p>
                        <p>' . $var['Abstract'] . '</p>
                        <p class="uk-text-meta uk-margin-remove-top">';
        if (mysqli_num_rows($HW) > 0) {
            while ($row = mysqli_fetch_array($HW)) {
                echo '<a href="' . $this->urlSearch . $row['HotWord'] . '">#' . $row['HotWord'] . '</a>';
            }
        }
        echo '</p>
                    </div>
                </a>

            </div>';
    }

    function printdx($var, $t1, $t2, $HW)
    {
        $HW = getHW($var['IdArticolo']);
        echo '<div uk-scrollspy="cls: uk-animation-slide-right; repeat: true">
        <a class="uk-link-reset" href="' . $this->url . $var['IdArticolo'] . '">
        <div class="uk-card uk-card-default uk-card-hover uk-card-body">';
        if ($var['DataInizioVis'] === $t1 || $var['DataInizioVis'] === $t2) {
            echo '<div class="uk-card-badge uk-label">New</div>';
        }
        echo '               
            <h3 class="uk-card-title">' . $var['Titolo'] . '</h3>
            <p class="uk-text-meta uk-margin-remove-top"><time datetime="' . $var['DataInizioVis'] . 'T19:00">' . $var['DataInizioVis'] . '</time></p>
            <p>' . $var['Abstract'] . '</p>
            <p class="uk-text-meta uk-margin-remove-top">';
        if (mysqli_num_rows($HW) > 0) {
            while ($row = mysqli_fetch_array($HW)) {
                echo '<a href="' . $this->urlSearch . $row['HotWord'] . '">#' . $row['HotWord'] . '</a>';
            }
        }
        echo '</p>
        </div>
    </a>

    </div>';
    }

    public function sxMenu($title, $cat)
    {
        echo '<div class="uk-navbar-left ">
        <a class="uk-navbar-toggle" href="index.php" uk-toggle="target: #offcanvas-push">
        <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
        </a>
        <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
            <div class="uk-offcanvas-bar uk-background-primary">

                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                    <li class="uk-nav-header">Pagina corrente</li>
                    <li class="uk-active"><a href="#">' . $title . '</a></li>
                    <li class="uk-nav-divider"></li>
                    <li class="uk-parent">
                        <a href="#">Menu</a>
                        <ul class="uk-nav-sub">
                            <li><a href="index.php">Home</a></li>';

        if ($this->loginmanager->getAccounttype() === "admin" || $this->loginmanager->getAccounttype() === "validatore" || $this->loginmanager->getAccounttype() === "scrittore") {
            echo '<li><a href="write.php">Scrivi</a></li>';
        }
        echo '<li><a href="login.php">Login</a></li>
                            <li><a href="testDBconnection.php">Test</a></li>';

        if ($this->loginmanager->getAccounttype() === "admin" || $this->loginmanager->getAccounttype() === "validatore") {
            echo '<li><a href="valida.php">Da validare</a></li>';
        }
        if ($this->loginmanager->getAccounttype() === "admin") {
            echo '<li><a href="addAccount.php">Aggiungi account</a></li>';
        }
        echo '</ul>
                    </li>
                    <li class="uk-nav-divider"></li>
                </ul>
                <ul uk-accordion>
                                <li>
                                    <a class="uk-accordion-title" href="#">Categorie</a>
                                    <div class="uk-accordion-content">
                                        <ul>';
                                        if (mysqli_num_rows($cat) > 0) {
                                            while ($row = mysqli_fetch_array($cat)) {
                                                echo '<li><a href="' . $this->urlCategory . $row['IdCategoria'] . '">' . $row['Nome'] .'</a></li>';
                                            }
                                        }
                                        echo '</ul>
                                    </div>
                                </li>
                            </ul>
            </div>
        </div>
    </div>';
    }
}
