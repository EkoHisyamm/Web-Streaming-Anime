<?php
require 'admin/crud/config.php';

// if(isset($_POST['submit'])){
//     header("Location: search.php");
// }
include 'tamplate/header.php';
?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include 'tamplate/navbar.php' ?>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <?php $result = mysqli_query($con, "SELECT * FROM `movies` WHERE judul LIKE '%".$_GET['judul']."%'");
                            if (mysqli_num_rows($result) != 0) {
                                while ($row = mysqli_fetch_array($result)) {
                            ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar'] ?>">
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    <?php
                                                    $genrelist = $row['genre'];
                                                    $genre = explode(",", $genrelist);
                                                    for ($i = 0; $i < count($genre); $i++) {
                                                        if ($i >= 4)
                                                            break;
                                                    ?>
                                                        <li><?php echo $genre[$i] ?></li>
                                                    <?php } ?>
                                                </ul>
                                                <h5><a href="./anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php include 'tamplate/footer.php' ?>

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>