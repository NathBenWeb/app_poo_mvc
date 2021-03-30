
<!-- La view permet l'affichage
Sert à mémoriser des données et ne pas les afficher tout de suite. Et en le rappelant il affichera ce qui aura été intégré dedans -->
<?php ob_start(); ?>

<!-- <div class=""><a class="btn btn-secondary" href="index.php?action=ajout_cat&id="><i class="text-warning fas fa-plus-square"></i></a></div> -->
<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des catégories</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allCat as $cat){?>

            
        <tr>
            <td><?=$cat->getId_cat();?></td>
            <td><?=$cat->getNom_cat();?></td>
            <td class="text-center">
                <a class="btn btn-info" href="index.php?action=edit_cat&id=<?= $cat->getId_cat();?>">
                <i class="fas fa-pen"></i></a>
            </td>
            <td class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_cat&id=<?= $cat->getId_cat();?>"
                onclick="return confirm('Etes-vous sûr de vouloir supprimer')">
                <i class="fas fa-trash"></i></a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>