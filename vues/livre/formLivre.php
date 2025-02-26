<div class="container mt-5">
<h2 class='pt-3 text-center'><?php echo $mode ?> Un livre</h2>
    <form action="index.php?uc=livres&action=valideForm" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
            <div class="form-group">
                <label for='titre' > Libellé </label>
                <input type="text" class='form-control' id='titre' placehoder='Saisir le titre' name='titre' 
                value="<?php if($mode == "Modifier") {echo $livre->getLibelle() ;} ?>">
            </div>
            <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier") {echo $livre->getNum();} ?>">
            <div class="row">
                <div class="col"> <a href="index.php?uc=livres&action=list" class='btn btn-warning btn-block'>Revenir à la liste</a> </div>
                <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $mode ?> </button> </div>
            </div>
    </form>
</div>
