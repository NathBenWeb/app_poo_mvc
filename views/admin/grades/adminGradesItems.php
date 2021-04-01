<?php ob_start(); ?>

<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des grades</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allGrade as $grade){?>

            
        <tr>
            <td><?=$grade->getId_g();?></td>
            <td><?=$grade->getNom_g();?></td>
            <td class="text-center">
                <a class="btn btn-info" href="index.php?action=edit_g&id=<?= $grade->getId_g();?>">
                <i class="fas fa-pen"></i></a>
            </td>
            <?php if($_SESSION["Auth"]->id_g !=3){?>
            <td class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_g&id=<?= $grade->getId_g();?>"
                onclick="return confirm('Etes-vous sûr de vouloir supprimer')">
                <i class="fas fa-trash"></i></a>
            </td>
            <?php } ?>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>