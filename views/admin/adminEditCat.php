<?php ob_start(); ?>

<div class="container">
    <h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire de modification de catégorie</h2>
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center">
                <label for="">Id</label>
                <input class="form-control" type="text" value="<?=$cat->getId_cat();?>" name="id" readonly>
                
                <label for="categorie">Catégorie</label>
                <input type="text" id="categorie" name="categorie" class="form-select mt-3" value="<?=$cat->getNom_cat();?>">
                <button type="submit" class="btn btn-secondary text-warning col-12 mt-3" name="soumis">Modifier</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>