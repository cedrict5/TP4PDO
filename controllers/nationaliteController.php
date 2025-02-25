<?php
$action=$_GET['action'];
switch($action){
    case 'list';
    //traitement du form de recherche
    $libelle="";
    $continentSel="Tous";
    if(!empty($_POST['libelle']) || !empty($_POST['continentSel'])){
        $libelle=$_POST['libelle'];
        $continentSel=$_POST['continentSel'];
    }
    $lesContinents=Continent::findAll();
    $lesNationalites=Nationalite::findAll($libelle,$continentSel);
    $lesNationalites = Nationalite::findAll();
            include('vues/nationalite/listeNationalites.php');
            break;

        case 'add';
            $mode="Ajouter";
            include('vues/nationalite/formNationalite.php');
            break;

        case 'update';
            $mode="Modifier";
            $nationalite=Nationalite::findById($_GET['num']);
            include('vues/nationalite/formNationalite.php');
            break;

        case 'delete';
            $nationalite=Nationalite::findById($_GET['num']);
            $nb=Nationalite::delete($nationalite);
            if($nb==1){
                $_SESSION['message']=["success"=>"Le nationalite a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"Le nationalite a bien été supprimé"];
            }
            header('location:index.php?uc=nationalites&action=list');
            break;

        case 'valideForm';
            $nationalite=new Nationalite();
            if(empty($_POST['num'])){//cas d'une création
                $nationalite->setLibelle($_POST['libelle']);
                $nb=Nationalite::add($nationalite);
                $message ="ajouté"; 
            }else{//cas d'une modif
                $nationalite->setNum($_POST['num']);
                $nationalite->setLibelle($_POST['libelle']);
                $nb=Nationalite::update($nationalite);
                $message ="modifié";
            }
            if($nb==1){
                $_SESSION['message']=["success"=>"Le nationalite a bien été $message"];
            }else{
                $_SESSION['message']=["danger"=>"Le nationalite n'a pas été $message"];
            }
            header('location:index.php?uc=nationalites&action=list');
            break;
}