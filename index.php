<?php 
	session_start();
	include("server_side/bidder.php");
	include("server_side/item.php");
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Auction Helper </title>
 	<link rel="stylesheet" type="text/css" href="style/style.css">
 </head>
 <body>
	<header><?php include("modules/header.inc.php"); ?></header> 
	<section id="container">
		<nav><?php include("modules/nav.inc.php"); ?></nav>
		<main>
			<?php 
				if(isset($_REQUEST['content'])) {
					include($_REQUEST['content']. ".inc.php");
				} else {
					include("modules/main.inc.php");
				}
			 ?>
		</main>
		<aside>
			<?php include("modules/aside.inc.php"); ?>
		</aside>
	</section>
	<footer>
		<?php include("modules/footer.inc.php"); ?>
	</footer>
 </body>
 </html>