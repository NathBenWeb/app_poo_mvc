<?php

class AdminUtilisateurModel extends Driver{

    public function getUsers(){
        $sql ="SELECT * FROM utilisateurs u
                INNER JOIN grade g
                ON u.id_g = g.id_g
                ORDER BY u.id";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new Utilisateur();
            $user->setId($row->id);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setLogin($row->login);
            $user->setPass($row->pass);
            $user->getGrade()->setId_g($row->id_g);
            $user->getGrade()->setNom_g($row->nom_g);
            $user->setEmail($row->email);
            $user->setStatut($row->statut);
            array_push($tabUser,$user);
        }
            return $tabUser;
    }

    // Méthode requête pour déterminer le statut de l'utilisateur (0 = activer / 1 = désactiver)
    public function updateStatut(Utilisateur $user){
        $sql = "UPDATE utilisateurs SET statut = :statut WHERE id = :id";
        $result = $this -> getRequest($sql, ['statut' => $user -> getStatut(), 'id' => $user -> getId()]);
        return $result -> rowCount();
    }

    // Méthode requête pour l'authentification des utilisateurs
    public function signIn($loginEmail, $pass){
        $sql = "SELECT * FROM utilisateurs
                WHERE (login = :logEmail OR email = :logEmail) AND pass = :pass";
        $result = $this -> getRequest($sql, ["logEmail" => $loginEmail, "pass" => $pass]);
        
        $row = $result -> fetch(PDO::FETCH_OBJ);

        return $row;
    }

    // Méthode requête création d'utilisateur qui s'assure par la condition que l'utilisateur créé n'existe pas déjà dans la bdd avant de valider sa création
    public function register(Utilisateur $user){
        $sql = "SELECT * FROM utilisateurs
        
                WHERE  email = :email";
        $result = $this -> getRequest($sql, ["email" => $user -> getEmail()]);
        if($result -> rowCount() == 0){
            $req = "INSERT INTO utilisateurs(nom, prenom, login, email, pass, statut, id_g
                    VALUES (:nom, :prenom , :login, :email, :pass, :statut, :id_g)";
            $tabUser = ["nom"=>$user->getNom(), "prenom"=>$user->getPrenom(), "login"=>$user->getLogin(), "email"=>$user->getEmail(), "pass"=>$user->getPass(), "statut"=>$user->getStatut(), "id_g"=>$user->getGrade()->getId_g()];
            $res = $this -> getRequest($req, $tabUser);
            return $res;
        }else{
            return "Cette utilisateur existe déjà";}
    }

    public function insertUser(Utilisateur $utilisateur){
        $sql = "INSERT INTO utilisateurs(nom, prenom, login, email, pass, statut, id_g)
                VALUES (:nom, :prenom, :login, :email, :pass, :statut, :id_g)";
        
        $tabParams = ["nom"=>$utilisateur->getNom(),
                    "prenom"=>$utilisateur->getPrenom(),
                    "login"=>$utilisateur->getLogin(),
                    "email"=>$utilisateur->getEmail(),
                    "pass"=>$utilisateur->getPass(),
                    "statut"=>$utilisateur->getStatut(),
                    "id_g"=>$utilisateur->getGrade()->getId_g()];
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }

}