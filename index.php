<?php session_start(); 
include "modeles/Continent.php";
include "modeles/monPdo.php";
include "vues/header.php";
include "vues/messageFlash.php";

$uc =empty($_GET['uc'])? "accueil" : $_GET['uc'];

switch($uc){
case 'accueil':
include('vues/Accueil.php');
break;
case 'continents':
include('controllers/continentController.php');
break;
}
include "vues/footer.php";
?>