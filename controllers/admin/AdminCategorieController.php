<?php
// require_once("../../models/Driver.php");
// require_once("../../models/Categorie.php");
// require_once("../../models/admin/AdminCategorieModel.php");

// Le controller appelle le bon modèle et la bonne vue pour l'affichage

class AdminCategorieController{

    private $adCat;
    public function __construct(){

        $this -> adCat = new AdminCategorieModel();  
    }

    public function listCategories(){
        $allCat = $this -> adCat -> getCategories();
        require_once("./views/admin/adminCategoriesItems.php");
        // return $allCat;
    }

    // Retourne le nombre de ligne qui a été supprimé et redirige après la suppression vers la liste des catégories
    // public function removeCat($idCat){
    //     $nbLine = $this -> adCat -> deleteCat($idCat);

    //     if($nbLine > 0){
    //         header("location:index.php?action=list_cat");
    //     }
    // }
    public function removeCat(){
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            
            $nbLine = $this -> adCat -> deleteCat($id);

            if($nbLine > 0){
                        header("location:index.php?action=list_cat");
            }
        }
    }

    public function editCat(){
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){

            $id = trim($_GET["id"]);
            $cat = $this -> adCat -> categorieItem($id);
            
            if(isset($_POST["soumis"]) && !empty($_POST["categorie"])){
                $categorie = trim(addslashes((htmlentities($_POST["categorie"]))));
                $cat -> setNom_cat($categorie);
                $this -> adCat -> updateCategorie($cat);
                header("location:index.php?action=list_cat");

            }
            require_once("./views/admin/adminEditCat.php");
        }
    }

    public function addCat(){
        if(isset($_POST["soumis"]) && !empty($_POST["categorie"])){
                $nom_cat = trim(addslashes((htmlentities($_POST["categorie"]))));
                $newCat = new Categorie();
                $newCat ->setNom_cat($nom_cat);
                $ok = $this -> adCat -> insertCategorie($newCat);

                if($ok){
                    header("location:index.php?action=list_cat");
                }
        }
        require_once("./views/admin/adminAddCat.php");
    }

}
// $adminCat = new AdminCategorieController();
// var_dump($adminCat->listCategories());