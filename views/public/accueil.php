<?php ob_start(); 

?>

<div class="container">
        <div id="carouselExampleControls" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./assets/images/mercedes.jpg" class="d-block w-100 "  alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/rolls.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/mercedes2.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
<!--------------------------end carrousel------------------------------------->

<div class="row my-3">
              <div class="col-8">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach($cars as $car){?> 
                    <div class="col">
                      <div class="card">
                        <img src="./assets/images/<?=$car->getImage();?>" height="300" class="card-img-top " alt="...">
                        <div class="card-body">

                          <h5 class="bg-secondary text-center text-white card-title"><?=strtoupper($car->getCategorie()->getNom_cat());?>:<?=$car->getMarque();?></h5>
                          <p class="card-text" id="description" style="height:150px;"><?=substr($car->getDescription(), 0, 350);?></p>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Mod??le:
                              <span class="badge bg-dark "><?=$car->getModele();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Ann??e:
                              <span class="badge bg-dark "><?=$car->getAnnee();?></span>
                            </li>
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Quantit??
                              <span class="badge bg-dark"><?=$car->getQuantite();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Prix:
                              <span class="badge bg-warning" style="font-size: 20px;"><?=$car->getPrix()." ???";?></span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <form action="index.php?action=checkout" method="post">
                                    <input type="hidden" name="marque" value="<?=$car->getMarque();?>">
                                    <input type="hidden" name="modele" value="<?=$car->getModele();?>">
                                    <input type="hidden" name="image" value="<?=$car->getImage();?>">
                                    <input type="hidden" name="prix" value="<?=$car->getPrix();?>">
                                    <?php if($car->getQuantite() > 0){ ?> 
                                    <button name="envoi" type="submit" class="btn btn-success">Acheter</button>
                                    <?php } ?>
                                </form>
                            
                                <strong class="badge">
                                    <?php if($car->getQuantite() == 0){ ?>
                                    <a href="index.php?action=order&id=<?=$car->getId_v();?>" class="btn btn-warning text-white">Commander</a>
                                    <?php } ?>
                                </strong>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
              </div>
            </div>
<!------------------------------end cards--------------------------------------------------------->
              
                <div class="card col-3">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
                        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
                        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
                     </form>
                    <ul class="list-group list-group-flush">
                        <?php foreach($tabCat as $cat){ ?>
                      <li class="list-group-item">
                          <a class="btn text-center" href="index.php?id=<?=$cat -> getId_cat();?>"><?=$cat->getNom_cat();?></a>
                      </li>
                      <?php } ?>
                      <!-- <li class="list-group-item">Neuf</li>
                      <li class="list-group-item">Occasion</li> -->
                    </ul>
                  </div> 
<!------------------------------end sidebar--------------------------------------------------------->          
    </div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>