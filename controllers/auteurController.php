<?php
$action=$_GET['action'];
switch($action){
        case 'list';
            $lesAuteurs = Auteur::findAll();
            include('vues/Auteur/listeAuteurs.php');
            break;

        case 'add';
            $mode="Ajouter";
            include('vues/Auteur/formAuteur.php');
            break;

        case 'update';
            $mode="Modifier";
            $Auteur=Auteur::findById($_GET['num']);
            include('vues/Auteur/formAuteur.php');
            break;

        case 'delete';
            $Auteur=Auteur::findById($_GET['num']);
            $nb=Auteur::delete($Auteur);
            if($nb==1){
                $_SESSION['message']=["success"=>"L'auteur a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"L'auteur a bien été supprimé"];
            }
            header('location:index.php?uc=auteurs&action=list');
            break;

        case 'valideForm';
            $Auteur=new Auteur();
            if(empty($_POST['num'])){//cas d'une création
                $Auteur->setLibelle($_POST['libelle']);
                $nb=Auteur::add($Auteur);
                $message ="ajouté"; 
            }else{//cas d'une modif
                $Auteur->setNum($_POST['num']);
                $Auteur->setLibelle($_POST['libelle']);
                $nb=Auteur::update($Auteur);
                $message ="modifié";
            }
            if($nb==1){
                $_SESSION['message']=["success"=>"Le Auteur a bien été $message"];
            }else{
                $_SESSION['message']=["danger"=>"Le Auteur n'a pas été $message"];
            }
            header('location:index.php?uc=auteurs&action=list');
            break;
}