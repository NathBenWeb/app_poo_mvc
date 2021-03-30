<?php

require_once("./models/Driver.php");
require_once("./models/Categorie.php");
require_once("./models/Voiture.php");
require_once("./models/admin/AdminCategorieModel.php");
require_once("./controllers/admin/AdminCategorieController.php");
require_once("./models/admin/AdminVoitureModel.php");
require_once("./controllers/admin/AdminVoitureController.php");


// function chargerClasse($classe){
//     require $classe . ".php" ;
//     }
//     spl_autoload_register('chargerClasse');
    

// Toutes les requêtes vont passer par la table de routage donc les require once initialement dans le controller sont déplacer ici
class Router{
    private $ctrca;
    private $ctrv;

    public function __construct(){
        $this->ctrca = new AdminCategorieController();
        $this->ctrv = new AdminVoitureController();
    }

    // getPath = Pour aller chercher le bon controller
    public function getPath(){
        if(isset($_GET["action"])){
            switch($_GET["action"]){
                case "list_cat" :
                    $this->ctrca->listCategories();
                    break;
                case "delete_cat" :
                    // if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
                    //     $id = trim($_GET["id"]);
                    //     $this -> ctrca -> removeCat($id);
                    // }
                    $this -> ctrca -> removeCat();
                    break;
                case "edit_cat" :
                    $this->ctrca->editCat();
                    break;
                case "add_cat" :
                    $this->ctrca->addCat();
                    break;
                case "list_v" :
                    $this->ctrv->listVoitures();
                    break;
                case "add_v" :
                    $this->ctrv->addVoitures();
                    break;
                case "delete_v" :
                    $this->ctrv->removeVoit();
                    break;
            }
        }
    }
}