<?php

class AdminGradeController{
    private $adGrade;
    public function __construct(){

        $this -> adGrade = new AdminGradeModel();  
    }

    public function listGrades(){
        AuthController::isLogged();
        $allGrade = $this -> adGrade -> getGrades();
        require_once("./views/admin/grades/adminGradesItems.php");
        // return $allCat;
    }

    public function editGrade(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){

            $id = trim($_GET["id"]);
            $grade = $this -> adGrade -> gradeItem($id);
            
            if(isset($_POST["soumis"]) && !empty($_POST["grade"])){
                $gr = trim(addslashes((htmlentities($_POST["grade"]))));
                $grade -> setNom_g($gr);
                $this -> adGrade -> updateGrade($grade);
                header("location:index.php?action=list_g");

            }
            require_once("./views/admin/grades/adminEditGrades.php");
        }
    }

    public function addGrade(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["grade"])){
                $nom_grade = trim(addslashes((htmlentities($_POST["grade"]))));
                $newGrade = new Grade();
                $newGrade ->setNom_g($nom_grade);
                $ok = $this -> adGrade-> insertGrade($newGrade);

                if($ok){
                    header("location:index.php?action=list_g");
                }
        }
        require_once("./views/admin/grades/adminAddGrades.php");
    }

    public function removeGrade(){
        AuthController::isLogged();
        AuthController::accessUser();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            
            $nbLine = $this -> adGrade -> deleteGrade($id);

            if($nbLine > 0){
                        header("location:index.php?action=list_g");
            }
        }
    }
}