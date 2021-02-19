<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.php" style="display: block;">
                        <img class="navbar__img" style=" display: block; margin-left: auto; margin-right: auto;" src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 navbar__menu">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class=""><a href="./index.php">Home</a></li>
                            <li><a href="./genre.php">Genre</a></li>
                            <li><a href="viewall.php?current=ongoing">Ongoing</a></li>
                            <li><a href="allanime.php">All Anime</a></li>
                            <li><a href="viewall.php?current=bookmark">Bookmark</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="navbar__search">
                <div class="header__right">
                    <form class="form-inline ml-3" action="viewallq.php" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="current" value="search">
                            <input class="form-control form-control-navbar" value="<?php  echo isset($_GET['q'])?$_GET['q']:'' ?>" type="search" name='q' placeholder="search" aria-label="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>