<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Voucher Game No. 1 Indonesia">
    <meta name="author" content="Wahyu Arief">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo $heading; ?> - Funatic Game</title>
    <link rel="stylesheet" href="https://funatic.id/assets/funatic/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://funatic.id/assets/funatic/css/styles.css">
</head>
<body class="bg-black">
    <div class="container-md">
        <div class="site-name text-center">
            <img src="https://funatic.id/assets/funatic/images/funatic.png" alt="funatic" width="200">
        </div>
        <div class="main-wrapper">

			<div class="bg-red-black rounded-4 text-center text-white" style="height: 27rem;">
				<div style="padding:10rem 10px;">
					<h2><?php echo $heading; ?></h2>
					<?php echo $message; ?>
				</div>
			</div>
    	</div>
		<footer class="main-footer text-secondary text-center mt-2">
			<small>Copyright &copy; 2022 Funatic Game Store, All Rights Reserved.</small>
		</footer>
	</div>
    <script src="https://funatic.id/assets/funatic/js/bootstrap.bundle.min.js"></script>
    </body>
</html>