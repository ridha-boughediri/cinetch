<?php
session_start();

require_once("../model/Dbh.php");
require_once("../model/User.php");

$user = new User;

try {

    foreach ($_POST as $key => $value) {

        if (empty($value)) {
            throw new Exception("Veuillez remplir tous les champs", 1);
        }
    }

    $login = $user->test_input($_POST["signup-username"]);
    $email = $user->test_input($_POST["signup-email"]);
    $password = $user->test_input($_POST["signup-password"]);
    $pwdrepeat = $user->test_input($_POST["signup-password-confirmation"]);

    if (!preg_match("/^[a-zA-Z0-9]*$/", $login)) {

        throw new Exception("Le pseudo ne doit pas avoir de caractères spéciaux.", 1);
    }

    if ($password !== $pwdrepeat) {

        throw new Exception("Les mots de passe ne correspondent pas", 1);
    }


    $userCreated = $user->addUser($login, $password, $pwdrepeat);

    if ($userCreated === false) {

        throw new Exception("Impossible de créer l'utilisateur", 1);

    } else {

        $_SESSION["success"] = 'Utilisateur créé avec succès';
        header("location:../index.php?signup=ok");
        exit();
    }

} catch (Exception $e) {

    $_SESSION["error"] = $e->getMessage();
    header("location:../index.php?signup=error");
    exit();

}
