 <?php
	session_start();
	
	if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
	{
		header('Location: konto.php');
		exit();
	}
	
	if (isset($_POST['submit']))
	{
		$walidacja=true;
		
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		$login=$_POST['login1'];
		$haslo=$_POST['haslo'];
		$haslo2=$_POST['haslo2'];
		$mailik=$_POST['mailik'];
		$adres=$_POST['adres'];
		$wyksztalcenie=$_POST['wyksztalcenie'];
		$zainteresowania=$_POST['zainteresowania'];
		
		if (ctype_alpha($imie)==false)
		{
			$walidacja=false;
			$_SESSION['error_imie']="Imię może zawierać wyłącznie litery, bez polskich znaków";
		}
		
		if (ctype_alpha($nazwisko)==false)
		{
			$walidacja=false;
			$_SESSION['error_nazwisko']="Nazwisko może zawierać wyłącznie litery, bez polskich znaków";
		}
	
		if((strlen($login)<4) || (strlen($login)>11))
		{
			$walidacja=false;
			$_SESSION['error_login']="Nieprawidłowa liczba znaków (login musi posiadać od 4 do 11 znaków)";
		}
		
		if (ctype_alnum($login)==false)
			
		{
			$walidacja=false;
			$_SESSION['error_login']="Login może zawierać tylko cyfry i litery, bez polskich znaków";
		}
		
		if ((strlen($haslo)<4) || (strlen($haslo)>11))
		{
			$walidacja=false;
			$_SESSION['error_haslo']="Nieprawidłowa liczba znaków (haslo musi posiadać od 4 do 11 znaków)";
		}
	
		if ($haslo!=$haslo2)
		{
			$walidacja=false;
			$_SESSION['error_haslo']="Podane hasła nie są takie same";
		}
		
		
		require_once "polaczenie.php";
		$conn= @new mysqli($host, $db_user, $db_password, $db_name);

		
		if ($conn->connect_error) 
		{
		die("Błąd połączenia z bazą danych: " . $conn->connect_error);
		}
		

		if($wynik1=$conn->query("SELECT id FROM uzytkownicy WHERE mail='$mailik'")) 
			
		$mailexist = $wynik1->num_rows;
			if($mailexist>0)
			{
				$walidacja=false;
				$_SESSION['error_mail']="E-mail już istnieje w bazie";
			}
			
		if($wynik2=$conn->query("SELECT id FROM uzytkownicy WHERE login='$login'"))
				
		$loginexist = $wynik2->num_rows;
			if($loginexist>0)
			{
				$walidacja=false;
				$_SESSION['error_login']="Login już istnieje w bazie";
			}
				
		if($walidacja==true)
		{
			
			$last_id=$conn->query("SELECT MAX(id) FROM uzytkownicy");
			while($id=$last_id->fetch_assoc())
			{
				$new_id=implode($id)+1;
			}
		
			$sql = "INSERT INTO uzytkownicy (id, imie, nazwisko, login, haslo, mail, adres, wyksztalcenie) VALUES ('$new_id', '$imie','$nazwisko','$login','$haslo','$mailik','$adres','$wyksztalcenie')";

			if ($conn->query($sql) === TRUE) 
			{
				echo"Nowe Konto zostało utworzone. Zaloguj się, używając podanych danych.";
			} 
			else 
			{
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}
				
				
			foreach ($zainteresowania as &$war) 
			{
				$conn->query("INSERT INTO zain_uz (id, id_uz, id_zain) VALUES (NULL, '$new_id','$war')");
				
			}
			unset($war); 
				
		}
			$conn->close();
	}
	
?>
 
 <!DOCTYPE HTML>
 <html lang="pl">
 <head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title> Księgarnia internetowa - logowanie i rejestracja </title>
	<link rel="stylesheet" href="style.css" type="text/css" /><link rel="preconnect" href="https://fonts.googleapis.com">

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	
 </head>
 
 <body>
 <div id="container">
	
	<div id="logo">
	Logowanie i rejestracja do księgarni
	</div>
 
	<div id="logowanie">
	<h1> Logowanie </h1>
	<form action="zaloguj.php" method="post">
	
	Login: 
	<input type="text" name="login"/>
	<br />
	Hasło:
	<input type="password" name="haslo"/>
	<br />
	<input type="submit" value="Zaloguj się" />
		
		<?php
			if (isset($_SESSION['error_logowanie']))
			{
				echo'<div class="error">'.$_SESSION['error_logowanie'].'</div>';
				unset($_SESSION['error_logowanie']);
			}
		?>
	</form>
	</div>
	
	
	<div id="rejestracja">
	
	<h1> Formularz rejestracji</h1>
	<form method="post">
		Imię:
		<input type="text" name="imie"/>
		<br />
		<?php
			if (isset($_SESSION['error_imie']))
			{
				echo'<div class="error">'.$_SESSION['error_imie'].'</div>';
				unset($_SESSION['error_imie']);
			}
		?>
		
		Nazwisko:
		<input type="text" name="nazwisko" />
		<br />
		<?php
			if (isset($_SESSION['error_nazwisko']))
			{
				echo'<div class="error">'.$_SESSION['error_nazwisko'].'</div>';
				unset($_SESSION['error_nazwisko']);
			}
		?>
		
		
		Login:
		<input type="text" name="login1"/>
		<br />
		<?php
			if (isset($_SESSION['error_login']))
			{
				echo'<div class="error">'.$_SESSION['error_login'].'</div>';
				unset($_SESSION['error_login']);
			}
		?>
	
		Hasło:
		<input type="password" name="haslo"/>
		<br />
		<?php
			if (isset($_SESSION['error_haslo']))
			{
				echo'<div class="error">'.$_SESSION['error_haslo'].'</div>';
				unset($_SESSION['error_haslo']);
			}
		?>
		
		Powtórz hasło:
		<input type="password" name="haslo2"/>
		<br />
		
		E-mail: 
		<input type="email" name="mailik"/>
		<br />
		<?php
			if (isset($_SESSION['error_mail']))
			{
				echo'<div class="error">'.$_SESSION['error_mail'].'</div>';
				unset($_SESSION['error_mail']);
			}
		?>
		
		Adres:
		<input type="text" name="adres"/>
		<br />
		
		<label for "wyksztalcenie"> Wykształcenie </label>
		<select id="wyksztalcenie" name="wyksztalcenie">
			<option value="Podstawowe">Podstawowe</option>
			<option value="Średnie"selected>Średnie</option>
			<option value="Wyższe">Wyższe</option>
		</select>
		<br />
		
	
		<legend> Zainteresowania: </legend>
			<div><label><input type="checkbox" name="zainteresowania[]" value="1"> Polityka </label></div>
			<div><label><input type="checkbox" name="zainteresowania[]" value="2"> Podróże </label></div>
			<div><label><input type="checkbox" name="zainteresowania[]" value="3"> Ekonomia </label></div>
			<div><label><input type="checkbox" name="zainteresowania[]" value="4"> Science Fiction </label></div>
			<div><label><input type="checkbox" name="zainteresowania[]" value="5"> Psychologia </label></div>
			<div><label><input type="checkbox" checked name="zainteresowania[]" value="6"> Książki </label></div>
		

		
		<input type="submit" name="submit" value="Zarejestruj dane" />
		</form>
		
		</div>

	<div id="footer">
		Projekt księgarni internetowej na przedmiot Techniki Internetu OKNO PW
	</div>
	
	</div>
 </body>
 </html>