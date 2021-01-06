<?php require "crud/config.php" 
?>

<html>

<head>
    <?php
    if (isset($_POST['but_upload']) ) {
        // if ($name != "") {
        //     $target_file = $target_dir . basename($_FILES["file"]["name"]);
        //     $extention = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //     // Valid file extensions
        //     $extensions_arr = array("jpg", "jpeg", "png", "gif");

        //     // Check extension
        //     if (in_array($extention, $extensions_arr)) {

        //         $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

        //         $image = "data::image/" . $extensions_arr . ";base64," . $image_base64;


        //         if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        //             $query = "INSERT INTO images (name,image) VALUES (' $name ', ' $image ')";
        //             mysqli_query($con, $query);
        //         }
        //     }

        // }
    }
    ?>
</head>

<body>
    <form method="post" action="" enctype='multipart/form-data'>
        <input type='file' name='file' />
        <input type='submit' value='Save name' name='but_upload'>
    </form>
</body>

</html>