<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "produkt.php";
?>

<!DOCTYPE HTML>
 <html lang="pl">
 <head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title> Księgarnia internetowa - sklep </title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	
	
 </head>
 
 <body>

<div id="container">

<div id="logo">
Sklep
</div>



<div id="konto">
<?php
	
	echo "<p>Witaj ".$_SESSION['imie']."!";
	$id=$_SESSION['id'];
	$imie=$_SESSION['imie'];
	$nazwisko=$_SESSION['nazwisko'];
	$login=$_SESSION['login'];
	$haslo=$_SESSION['haslo'];
	$mail=$_SESSION['mail'];
	$adres=$_SESSION['adres'];
	$wyksztalcenie=$_SESSION['wyksztalcenie'];
	


	echo "<h2> Koszyk produktów:</h2>";
	
	if(isset($_POST['dodaj'])){
		
		require_once "polaczenie.php";
		$conn= @new mysqli($host, $db_user, $db_password, $db_name);
		$cena=0;
		

		if(isset($_SESSION['cart']))
		{
			$produkty_id_array=array_column($_SESSION['cart'],"id_produktu");
			$zliczanie=count($_SESSION['cart']);
			$produkty=$_POST['id_produktu'];
			$_SESSION['cart'][$zliczanie]=$produkty;
			foreach($_SESSION['cart'] as $ksiazka) 
			{
				$pozycja = $conn->query("SELECT * FROM produkty WHERE id='$ksiazka'");
				$poz=$pozycja->fetch_assoc();
				echo $poz['nazwa'].":  ";
				echo $poz['cena']." zł<br/>";
				$cena+=$poz['cena'];
				
			}
		
		}
		else
		{	
			$produkty=$_POST['id_produktu'];
			$_SESSION['cart'][0]=$produkty;
	
			foreach($_SESSION['cart'] as $ksiazka) 
			{
				$pozycja = $conn->query("SELECT * FROM produkty WHERE id='$ksiazka'");
				$poz=$pozycja->fetch_assoc();
				echo $poz['nazwa'].":  ";
				echo $poz['cena']." zł<br/>";
				$cena+=$poz['cena'];
				
			}
		}
		
		echo"<br/>SUMA: ".$cena." zł<br/>";

	}

echo "<br/><a href=\"wyslij.php\"> [ Wyślij ] </a> ";

echo "<a href=\"usun.php\"> [ Usuń ] </a> <br/>";
	
echo "
	<br/><br/>
	<h2>Twoje dane: </h2>
	<table border=\"1\" cellpadding=\"10\" cellspacing=\"0\">
	<tr>
	<td>Imię: </td><td>$imie</td>
	</tr>
	<tr>
	<td>Nazwisko: </td><td>$nazwisko</td>
	</tr>
	<tr>
	<td>Login: </td><td>$login</td>
	</tr>
	<tr>
	<td>Hasło: </td><td>$haslo</td>
	</tr>
	<tr>
	<td>E-mail: </td><td>$mail</td>
	</tr>
	<tr>
	<td>Adres: </td><td>$adres</td>
	</tr>
	<tr>
	<td>Wykształcenie: </td><td>$wyksztalcenie</td>

	</table>
	<br />
	<h2>Zainteresowania: </h2>";

	require_once "polaczenie.php";
	$conn= @new mysqli($host, $db_user, $db_password, $db_name);

	$zainte = $conn->query("SELECT id_zain FROM zain_uz WHERE id_uz='$id'");  
	foreach($zainte as $wiersz2) 
	{
		$nr=$wiersz2['id_zain'];
		$nazwa=$conn->query("SELECT nazwa FROM zainteresowania WHERE id='$nr'");
		$zainteres=$nazwa->fetch_assoc();
		echo $zainteres['nazwa'];
		echo "<br/>";
	}
	
	echo "<br/><a href=\"wyloguj.php\"> [ Wyloguj ] </a> <br/><br/>";

 ?>
 
</div>



<div id="sklep">
Wybierz produkty do koszyka:
<br/><br/>


<?php

	require_once "polaczenie.php";
	$conn= @new mysqli($host, $db_user, $db_password, $db_name);

	$ksiazki = $conn->query("SELECT * FROM produkty");  
	foreach($ksiazki as $wiersz) 
	{
		produkt($wiersz['id'], $wiersz['nazwa'],$wiersz['cena'],$wiersz['zdjecie']);
	}
	

?>


</div>


<div id="footer">
	Projekt księgarni internetowej na przedmiot Techniki Internetu OKNO PW
</div>


</div>
 </body>
 </html>