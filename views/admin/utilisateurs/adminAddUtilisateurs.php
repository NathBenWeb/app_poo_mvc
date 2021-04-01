<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire d'inscription Utilisateur</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center">

                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom">
                    </div>
                    <div class="col">
                        <label for="grade">Grade</label>
                        <select id="grade" name="grade" class="form-select">
                            <option value="">Choisir</option>
                            <?php foreach ($tabGrade  as $grade) {; ?>
                            <option value="<?=$grade->getId_g();?>"><?=$grade->getNom_g();?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col">
                        <label for="pass">Mot de passe</label>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe">
                    </div>
                    <!-- <div class="col">
                        <label for="statut">Statut</label>
                        <input type="number" id="statut" name="statut" class="form-control" placeholder="Statut">
                    </div> -->
                    <!-- <div class="col">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login">
                    </div> -->
                </div>

                <!-- <div class="row mt-3">
                    <div class="col">
                        <label for="pass">Pass</label>
                        <input type="text" id="pass" name="pass" class="form-control" >
                    </div>
                </div> -->

                <button type="submit" class="btn btn-secondary text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>