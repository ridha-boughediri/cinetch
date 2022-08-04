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

    $login = $user->test_input($_POST["signin-username"]);
    $password = $user->test_input($_POST["signin-password"]);

    if (!preg_match("/^[a-zA-Z0-9]*$/", $login)) {
        throw new Exception("Pseudo incorrect", 1);
    }

    $user->loginUser($login, $password);

    $_SESSION["success"] = 'Utilisateur connecté avec succès';

    header("location:../index.php?signin=true&login=" . $login);
    exit();

} catch (Exception $e) {

    $_SESSION["error"] = $e->getMessage();
    header("location:../index.php?signin=error");
    exit();
}
