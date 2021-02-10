<?php
	require_once 'config.php';

	if($_POST['showdata'] == "movie") {
		pr('MOVIES', __FILE__.':'.__LINE__);
	} elseif ($_POST['showdata'] == "episode") {
		pr('EPISODE', __FILE__.':'.__LINE__);
	}
	
	$result = limitSql($sql, $pages, $limit);
?>