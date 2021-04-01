<?php ob_start(); ?>

<div class="container">
    <h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire de modification de grade</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="">
                <div class="row mt-3">
                    <div class="col">
                        <label for="">Id</label>
                        <input class="form-control" type="text" value="<?=$grade->getId_g();?>" name="id" readonly>
                    </div>
                    <div class="col">
                        <label for="grade">Grade</label>
                        <input type="text" id="grade" name="grade" class="form-control" value="<?=$grade->getNom_g();?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary text-warning col-12 mt-4" name="soumis" style="border-radius: 30px;">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>