<?php

class AdminUtilisateurModel extends Driver{

public function getUsers(){
    $sql ="SELECT * FROM utilisateurs u
            INNER JOIN grade g
            ON u.id = g.id_g
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

public function updateStatut(Utilisateur $user){
    $sql = "UPDATE utilisateurs SET statut = :statut WHERE id = :id";
    $result = $this -> getRequest($sql, ['statut' => $user -> getStatut(), 'id' => $user -> getId()]);
    return $result -> rowCount();
}


// public function deleteUser($id){
//     $sql = "DELETE FROM utilisateurs WHERE id = :id";
//     $result = $this->getRequest($sql,["id"=>$id]);
//     $nb= $result ->rowCount();
//     return $nb;
// }
// public function userItem($id){
//     $sql = "SELECT * FROM utilisateurs WHERE id = :id";
//     $result = $this->getRequest($sql,['id'=>$id]);
//     if($result->rowCount()>0){
//         $row = $result->fetch(PDO::FETCH_OBJ);
//           $user = new Utilisateurs();

//           $user->setId($row->id);
//           $user->setNom($row->nom);
//           $user->setPrenom($row->prenom);
//           $user->setEmail($row->email);
//           $user->setLogin($row->login);
//           $user->setPass($row->pass);
//         //   $user->setGrade($row->grade);
//           return $user;
//     }
// }
// public function updateUser(Utilisateurs $user){
//     $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, login = :login, pass = :pass, id_g = :grade WHERE id = :id";
//     $result = $this->getRequest($sql,['nom'=>$user->getNom(), "prenom"=>$user->getPrenom(), "email"=>$user->getEmail(),"login"=>$user->getLogin(), "pass"=>$user->getPass(),"grade"=>$user->getGrade(),"id"=>$user->getId()]);
//     if($result->rowCount()>0){
//         $nb = $result->rowCount();
//         return $nb;
//     }
// }

}
// $adminUser = new AdminUserModel();
// echo "<pre>";
// var_dump($adminUser->getUsers());
// echo "</pre>";
