<?php require_once 'pages/layout/head.php'; ?>
<?php require_once 'pages/layout/nav.php'; ?>
<img src="../public/img/logo1.jpg">
<?php 
	if(isset($_SESSION['cuenta'])){
		header('Location:pages/');
		die();
	}else{
		header('Location:pages/login');
	}
?>

<?php require_once 'pages/layout/footer.php'; ?>