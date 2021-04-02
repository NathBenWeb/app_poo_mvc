<?php ob_start(); ?>

<div class="container">
    <h2>Formulaire de commande</h2>
    <form action="" method="post">
        <input type="hidden" value="<?= $id; ?>">
        <input type="" value="nom" placeholder="Veuillez entrer votre nom">
        <input type="" value="prenom" placeholder="Veuillez entrer votre prénom">
        <input type="" value="email" placeholder="Veuillez entrer votre email">
        <input type="" value="tel" placeholder="Veuillez entrer votre téléphone">
        <input type="hidden" value="commentaire" placeholder="N'hésitez pas à nous faire part à vos commentaires">
    </form>

</div>



<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>