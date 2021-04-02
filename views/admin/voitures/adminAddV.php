<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire d'ajout de voiture</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center" enctype="multipart/form-data">

                <div class="row mt-3">
                    <div class="col">
                        <label for="marque">Marque</label>
                        <input type="text" id="marque" name="marque" class="form-control" placeholder="Marque">
                    </div>
                    <div class="col">
                        <label for="modele">Modèle</label>
                        <input type="text" id="modele" name="modele" class="form-control" placeholder="Modèle">
                    </div>
                    <div class="col">
                        <label for="cat">Catégorie</label>
                        <select id="cat" name="cat" class="form-select">
                            <option value="">Choisir</option>
                            <?php foreach ($tabCat  as $cat) {; ?>
                            <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix">
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité">
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="annee" name="annee" class="form-control" placeholder="Année">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" >
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="desc">Description</label>
                        <textarea  id="desc" name="desc" class="form-control" placeholder="commentaires ..." ></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>