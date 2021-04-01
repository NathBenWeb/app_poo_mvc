<?php

class AdminUtilisateurController{
    private $adUser;

    public function __construct(){
        $this-> adUser = new AdminUtilisateurModel();
        $this-> adgr = new AdminGradeModel();
    }

    // Méthode qui permet d'activer ou désactiver le statut de l'utilisateur
    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && isset($_GET["statut"]) && !empty($_GET["id"])){ // S'il y a existence du statut alors rentrer dans cette condition
            $id = $_GET["id"];
            $statut = $_GET["statut"];
            $user = new Utilisateur();
            if($statut ==1){
                $statut = 0;
            }else{
                $statut = 1;
            }
            $user -> setId($id);
            $user -> setStatut($statut);

            $this -> adUser -> updateStatut($user);
        }
        $allUsers = $this->adUser->getUsers();
        require_once("./views/admin/utilisateurs/adminUtilisateursItems.php");
    }

    public function login(){
        if(isset($_POST["soumis"])){
            if (isset($_POST["soumis"]) && strlen($_POST["pass"]) >= 4 && !empty($_POST["loginEmail"])){
                $loginEmail = trim(htmlentities(addslashes($_POST["loginEmail"])));
                $pass = md5(trim(htmlentities(addslashes($_POST["pass"]))));
                $data_u = $this -> adUser -> signIn($loginEmail, $pass);
                if(!empty($data_u)){
                    if($data_u -> statut > 0){
                        session_start();
                        $_SESSION["Auth"] = $data_u;
                        header("location:index.php?action=list_v");
                    }else{
                        $error = "Votre compte n'existe plus";
                    }
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once("./views/admin/utilisateurs/login.php");
    }


    public function addUser(){
        AuthController::isLogged();
        if(isset($_POST["soumis"])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["pass"]) >= 4){
                $nom = trim(htmlentities(addslashes($_POST["nom"])));
                $prenom= trim(htmlentities(addslashes($_POST["prenom"])));
                $email = trim(htmlentities(addslashes($_POST["email"])));
                $pass = trim(htmlentities(addslashes($_POST["pass"])));
                $login = trim(htmlentities(addslashes($_POST["login"])));
                $id_g = trim(htmlentities(addslashes($_POST["grade"])));

                $newU = new Utilisateur();
                $newU->setNom($nom);
                $newU->setPrenom($prenom);
                $newU->setEmail($email);
                $newU->setPass($pass);
                $newU->setLogin($login);
                $newU->getGrade()->setId_g($id_g);
                $newU->setStatut(1);

                $ok = $this->adUser->insertUser($newU);
                if($ok){
                    header("location:index.php?action=list_u");
                } 
            }
        }
        $tabGrade = $this -> adgr -> getGrades();

        require_once("./views/admin/utilisateurs/adminAddUtilisateurs.php");
        // require_once("./views/admin/utilisateurs/register.php");
    }





    // public function removeUser(){
    //     if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
    //         $id = trim($_GET['id']);
    //         $nbLine = $this->adUser->deleteUser($id);

    //         if($nbLine > 0){
    //             header("location: index.php?action=list_user");
    //         }
    //     }
    // }
    // public function editUser(){
    //     if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'],FILTER_VALIDATE_INT)){
           
    //         $id = trim($_GET['id']); 
    //         $user = $this->adUser->userItem($id);

    //         if(isset($_POST['submit'])){

    //             $nom = trim(addslashes(htmlentities($_POST['nom'])));
    //             $user->setNom($nom);
    //             $prenom = trim(addslashes(htmlentities($_POST['prenom'])));
    //             $user->setPrenom($prenom);
    //             $email = trim(addslashes(htmlentities($_POST['email'])));
    //             $user->setEmail($email);
    //             $login = trim(addslashes(htmlentities($_POST['login'])));
    //             $user->setLogin($login);
    //             $pass = trim(addslashes(htmlentities($_POST['pass'])));
    //             $user->setPass($pass);
    //             $grade = trim(addslashes(htmlentities($_POST['grade'])));
    //             $user->setGrade($grade);

    //             $nb = $this->adUser->updateUser($user);

    //             if($nb>0){
    //                 header('location:index.php?action=list_user');
    //             }
    //         }

    //         require_once('./views/admin/adminEditUser.php');

    //     }
    // }
}
