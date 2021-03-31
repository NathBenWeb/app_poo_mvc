<?php ob_start(); ?>

<div class="row">
    <div class="col-4 offset-8">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group">
            <input class="form-control" type="search" name="search" id="search" placeholder="Rechercher">
            <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
        </form>
    </div>

</div>

<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des voitures</h2>
<table class="table table-striped">
      <thead>
          <tr>
            <th>Id</th>
            <th>Marque</th>
            <th>Modele</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Quantite</th>
            <th>Année</th>
            <th>Description</th>
            <th>Categorie</th>
            <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          
          <tr>
          <?php if(is_array($cars)){ foreach ($cars as  $car) { ?>
              <td><?=$car->getId_v();?></td>
              <td><?=$car->getMarque();?></td>
              <td><?=$car->getModele();?></td>
              <td><?=$car->getPrix();?></td>
              <td><img src="./assets/images/<?=$car->getImage();?>" alt="" width="100"></td>
              <td><?=$car->getQuantite();?></td>
              <td><?=$car->getAnnee();?></td>
              <td ><?=substr($car->getDescription(),0, 19);?></td>
              <td><?=$car->getCategorie()->getNom_cat();?></td>
              <td class="text-center">
                <a class="btn btn-info" href="index.php?action=edit_v&id=<?= $car->getId_v();?>">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              <td  class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_v&id=<?= $car->getId_v();?>"
                    onclick="return confirm('Etes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
          </tr>
          <?php }}else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$cars."</td></tr>";} ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
