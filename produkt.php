<?php
function produkt($id, $nazwa, $cena, $zdjecie){
	$ksiazka="
	<form method=\"post\">
	<div class=\"produkt\">
	$nazwa<br/>
	<img src=\"$zdjecie\"> <br/> 
	$cena zł 
	<button type=\"submit\" name=\"dodaj\"> Dodaj </button>
	<input type='hidden' name='id_produktu' value='$id'>
	
	</div>
	</form>";
	echo $ksiazka;
	
}