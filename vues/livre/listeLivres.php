
<div class="container mt-5">
    
    <div class="row pt-3">
        <div class="col-9">
            <h2>Liste des livres</h2>
        </div>
        <div class="col-3"><a href="index.php?uc=livres&action=add" class='btn btn-success'><i class="fas fa-plus-circle"></i> Créer un livre</a> </div>
        
    </div>

    <table class="table table-hover table-striped">
        <thead>
            <tr class="d-flex">
            <th scope="col" class="col-md-1">Numéro</th>
            <th scope="col" class="col-md-2">ISBN</th>
            <th scope="col" class="col-md-3">Titre</th>
            <th scope="col" class="col-md-1">Prix</th>
            <th scope="col" class="col-md-1">Editeur</th>
            <th scope="col" class="col-md-1">Année</th>
            <th scope="col" class="col-md-1">Langue</th>
            <th scope="col" class="col-md-2">Auteur</th>
            <th scope="col" class="col-md-1">Genre</th>
        </tr>
        </thead>
    <tbody>
        <?php
        foreach($lesLivres as $livre){
            echo "<tr class='d-flex'>";
            echo "<td class='col-md-1'>".$livre->getnum()."</td>";
            echo "<td class='col-md-2'>".$livre->getisbn()."</td>";
            echo "<td class='col-md-3'>".$livre->gettitre()."</td>";
            echo "<td class='col-md-1'>".$livre->getprix()."</td>";
            echo "<td class='col-md-1'>".$livre->getediteur()."</td>";
            echo "<td class='col-md-1'>".$livre->getannee()."</td>";
            echo "<td class='col-md-1'>".$livre->getlangue()."</td>";
            echo "<td class='col-md-2'>".$livre->getauteur()."</td>";
            echo "<td class='col-md-1'>".$livre->getgenre()."</td>";

            echo "<td class='col-md-2'>
                <a href='index.php?uc=livres&action=update&num=".$livre->getNum()."' class='btn btn-primary'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppression' data-toggle='modal' data-message='Voulez vous supprimer ce livre ?' data-suppression='index.php?uc=livres&action=delete&num=".$livre->getNum()."' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }

        ?>
            
    </tbody>
    </table>

</div>