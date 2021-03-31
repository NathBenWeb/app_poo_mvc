<?php ob_start(); ?>

<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des utilisateurs</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Grade</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $user){?>

            
        <tr>
            <td><?=$user->getId();?></td>
            <td><?=$user->getNom();?></td>
            <td><?=$user->getPrenom();?></td>
            <td><?=$user->getLogin();?></td>
            <td><?=$user->getEmail();?></td>
            <td><?=$user->getGrade()->getNom_g();?></td>
            <td class="text-center">
                
                <?php echo($user->getStatut())
                    ?'<a href="index.php?action=list_u&id='.$user->getId()."&statut=".$user->getStatut().'"onclick="return confirm(`Etes-vous sûr de vouloir désactiver cet utilisateur?`)" class="btn btn-success"><i class="fas fa-unlock"></i> DESACTIVER</a>'    
                    :'<a href="index.php?action=list_u&id='.$user->getId()."&statut=".$user->getStatut().'"onclick="return confirm(`Etes-vous sûr de vouloir activer cet utilisateur?`)" class="btn btn-danger"><i class="fas fa-lock"></i> ACTIVER</a>';
                ?>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>