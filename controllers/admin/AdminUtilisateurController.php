<?php

class AdminUtilisateurController{
    private $adUser;

    public function __construct(){
        $this-> adUser = new AdminUtilisateurModel();
    }

    // S'il y a existence du statut alors rentrer dans cette condition
    public function listUsers(){
        if(isset($_GET["id"]) && isset($_GET["statut"]) && !empty($_GET["id"])){
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
        require_once('./views/admin/utilisateurs/adminUtilisateursItems.php');
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
