<?php
	session_start();
	
	if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "polaczenie.php";
	
	$polaczenie= @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo"Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo=htmlentities($haslo, ENT_QUOTES, "UTF-8");
		
	
		if($wynik=@$polaczenie->query("SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$haslo'"))
	{
		$ilu_uz=$wynik->num_rows;
		if($ilu_uz>0)
		{
			$_SESSION['zalogowany']=true;
			$wiersz=$wynik->fetch_assoc();
			$_SESSION['id']=$wiersz['id'];
			$_SESSION['imie']=$wiersz['imie'];
			$_SESSION['nazwisko']=$wiersz['nazwisko'];
			$_SESSION['login']=$wiersz['login'];
			$_SESSION['haslo']=$wiersz['haslo'];
			$_SESSION['mail']=$wiersz['mail'];
			$_SESSION['adres']=$wiersz['adres'];
			$_SESSION['wyksztalcenie']=$wiersz['wyksztalcenie'];
			
			$wynik->free_result();
			header('Location: konto.php');
		
			
		} else {
			$_SESSION['error_logowanie']="Niepoprawne dane logowania";
			header('Location: index.php');
			
		}
	
	
	
	$polaczenie->close();
	}
	}
	

?>