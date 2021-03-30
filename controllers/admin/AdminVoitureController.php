<?php

class AdminVoitureController{
    private $advm;

    public function __construct(){
        $this -> advm = new AdminVoitureModel();
        $this -> adCat = new AdminCategorieModel();
    }

    public function listVoitures(){
        
        // Ici in dit si on trouve la recherche faire la recherche sinon rester en mode affichage de la liste
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){

            $search = trim(htmlentities(addslashes($_POST["search"])));
            echo  $search;
            $cars = $this->advm->getVoitures($search);
            require_once("./views/admin/voitures/adminVoituresItems.php");
        }else{
            $cars = $this->advm->getVoitures();
            require_once("./views/admin/voitures/adminVoituresItems.php");
        }
       
    }

    public function addVoitures(){
        
        if(isset($_POST["soumis"]) && !empty($_POST["marque"]) && !empty($_POST["prix"])){
    
            $marque = addslashes(htmlspecialchars(trim($_POST["marque"])));
            $modele = addslashes(htmlspecialchars(trim($_POST["modele"])));
            $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
            $quantite = addslashes(htmlspecialchars(trim($_POST["quantite"])));
            $annee = addslashes(htmlspecialchars(trim($_POST["annee"])));
            $id_cat = addslashes(htmlspecialchars(trim($_POST["cat"])));
            $description = addslashes(htmlspecialchars(trim($_POST["desc"])));
            $image = $_FILES ["image"]["name"];

            $newV = new Voiture();
            $newV->setMarque($marque);
            $newV->setModele($modele);
            $newV->setPrix($prix);
            $newV->setQuantite($quantite);
            $newV->setAnnee($annee);
            $newV->getCategorie()->setId_cat($id_cat);
            $newV->setDescription($description);
            $newV->setImage($image);
            
            // Pour pouvoir récupérer une image n'importe où et qu'elle s'importe dans le dossier image une fois téléchargée
            $destination = "./assets/images/";
            move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

            $ok = $this->advm->insertVoiture($newV);
            if($ok){
                header("location:index.php?action=list_v");
            }
        }
        $tabCat = $this -> adCat  -> getCategories();

        require_once("./views/admin/voitures/adminAddV.php");
    }

    // Première méthode de suppression via l'id dans le Controller
    // public function removeVoit(){
    //     if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
    //         $id = trim($_GET["id"]);
            
    //         $nbLine = $this -> advm -> deleteVoit($id);

    //         if($nbLine > 0){
    //             header("location:index.php?action=list_v");
    //         }
    //     }
    // }

    // Autre méthode de suppression via un objet dans le Controller
    // FILTER_VALIDATE_INT = Pour récupérer un entier
    // trim = supprime les epsaces
    public function removeVoit(){
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $delV = new Voiture;
            $delV->setId_v($id);
            $nbLine = $this -> advm -> deleteVoit($delV);
    
            if($nbLine > 0){
                header("location:index.php?action=list_v");
            }
        }
    }

}