
<?php 
  session_start();

    require 'config.php';

    $username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);
	$msg = "";

	$sql = "select * from users where name = '$username' and password = '$password'";

    $json["hasil"]=array();
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	
    if($count > 0) {
		header("Location: ../dashboard.php");
		$_SESSION["LOGIN"] = true;
		$json["hasil"]["respon"]=true;
	}else{
		$err_msg = "password/username salah";
		header("Location: ../index.php");
		$json["hasil"]["respon"]=false;
	}
	echo json_encode($json);
?>