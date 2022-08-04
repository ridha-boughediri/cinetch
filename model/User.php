<?php

class User extends Dbh
{
    //returns false if login checked is in DB 
    private function _checkUser($login)
    {
        $stmt = $this->connect()->prepare('SELECT login FROM utilisateurs WHERE login = :login ;');

        if (!$stmt->execute(array(":login" => $login))) {
            throw new Exception("Erreur requête 'checkUser'", 1);
        }

        $checkUser = false;
        if ($stmt->rowCount() > 0) {
            $checkUser = false;
        } else {
            $checkUser = true;
        }
        return $checkUser;
    }

    private function _checkPwd($login, $password)
    {
        $getPwd = $this->connect()->prepare('SELECT password FROM utilisateurs WHERE login = :login ;');

        if (!$getPwd->execute(array(':login' => $login))) {
            throw new Exception("Echec de connexion, contacter un admin", 1);
        }

        if ($getPwd->rowCount() == 0) {
            throw new Exception("Login ou mot de passe incorrect", 1);
        }

        $passwordHashed = $getPwd->fetchAll(\PDO::FETCH_ASSOC);
        $checkpassword = password_verify($password, $passwordHashed[0]["password"]);

        return $checkpassword;
    }

    //adds the user in the db
    public function addUser($login, $password)
    {
        if (!$this->_checkUser($login)) {

            throw new Exception("Pseudo pris", 1);

        } else {
            $addUser = $this->connect()->prepare('INSERT INTO utilisateurs (login, password) VALUES  (:login, :password);');

            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

            $userCreated = $addUser->execute(array(':login' => $login, ':password' => $hashedpassword));

            return $userCreated;
        }
    }


    //starts a session with the user's information
    public function loginUser($login, $password)
    {

        $checkpassword = $this->_checkPwd($login, $password);

        if ($checkpassword == false) {

            throw new Exception("Login ou mot de passe incorrect", 1);

        } elseif ($checkpassword == true) {

            $stmt = $this->connect()->prepare('SELECT id FROM utilisateurs WHERE login = ?;');

            if (!$stmt->execute([$login])) {

                throw new Exception("Erreur BDD", 1);
                
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["login"] = $login;
            $_SESSION["id"] = $user[0]["id"];
        }

        $stmt = null;
    }

    //Modify User login
    public function modifyUser($login, $newLogin, $password)
    {

        $newLogin = $this->test_input($newLogin);
        $password = $this->test_input($password);

        $checkpassword = $this->_checkPwd($login, $password);

        if ($checkpassword === false) {
            throw new Exception(" Mot de passe incorrect", 1);
        } elseif ($checkpassword === true) {

            $checkUser = $this->_checkUser($newLogin);
            if ($checkUser === false) {
                throw new Exception("Pseudo pris", 1);
            } elseif ($checkUser === true) {

                $addUser = $this->connect()->prepare('UPDATE `utilisateurs` SET `login` = :login WHERE `utilisateurs`.`id` = :id;');

                $userModified = $addUser->execute(array(':login' => $newLogin, ':id' => $_SESSION["id"]));

                $_SESSION["login"] = $newLogin;
            }
        }
        return $userModified;
    }

    //Modify User password
    public function modifyPwd($login, $password, $newPwd)
    {
        $checkpassword = $this->_checkPwd($login, $password);

        if ($checkpassword === false) {
            throw new Exception(" Mot de passe incorrect", 1);
        } elseif ($checkpassword === true) {

            $hashedpassword = password_hash($newPwd, PASSWORD_DEFAULT);

            $newPwd = $this->connect()->prepare('UPDATE `utilisateurs` SET `password` = :pwd WHERE `utilisateurs`.`id` = :id;');

            $pwdModified = $newPwd->execute(array(':pwd' => $hashedpassword, ':id' => $_SESSION["id"]));

        }
        return $pwdModified;
    }


    //deletes and disconnects user
    public function deleteUser($login, $password)
    {
        $checkpassword = $this->_checkPwd($login, $password);

        if ($checkpassword === false) {
            throw new Exception(" Mot de passe incorrect", 1);
        } elseif ($checkpassword === true) {

            $stmt = $this->connect()->prepare('DELETE FROM `utilisateurs` WHERE `utilisateurs`.`id` = :id ');

            if (!$stmt->execute(array(':id' => $_SESSION["id"]))) {
                throw new Exception("Impossible de supprimer l'utilisateur, veuillez contacter l'administrateur.", 1);
            }

            session_unset();
            session_destroy();
            header("location:../index.php?disconnected");

            }
    }

    //Disconnect user
    public function disconnect()
    {
        session_start();
        session_unset();
        session_destroy();

        header("location:index.php?disconnected");

        exit();

    }

}
