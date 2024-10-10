 <?php
 	session_start();
	$to='sylwiniek4@wp.pl';
	$from='slvunia@gmail.com';
	$subject="Zamowienie";
	$message=implode(",", $_SESSION['cart']);
	$headers='From: '.$from."\r\n";
	mail($to, $subject, $message, $headers);
	
	unset($_SESSION['cart']);
	header('Location:konto.php');
?>
 