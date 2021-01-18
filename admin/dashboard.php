<?php
session_start();

if(!isset($_SESSION["LOGIN"]) || $_SESSION["LOGIN"] !== true){
    header("Location: index.php");
    exit;
}

include "tamplate/header.php"
?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include "tamplate/navbar.php";
        include "tamplate/sidebar.php";
        ?>
        <!-- Content Wrapper. Contains page content -->
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    <?php
    include "tamplate/footer.php"
    ?>
    <!-- /.content-wrapper -->
</body>