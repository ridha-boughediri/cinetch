<?php
session_start();

function addFilm()
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $id = $_POST['id'];
    $type = $_POST['type'];

    $sth = $bdd->prepare("SELECT * FROM film WHERE id_data='$id' AND type='$type'");

    $sth->execute();
    $var = $sth->fetch();

    if (!empty($var)) {
        echo json_encode([
            "code" => 10
        ]);
    } else {
        $sth2 = $bdd->prepare("INSERT INTO `film`( `type`, `id_data`) VALUES (?,?)");

        $sth2->execute([$type, $id]);

        echo json_encode([
            "code" => 10
        ]);
    }

}

function searchFilm($type, $id)
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $sth = $bdd->prepare("SELECT id FROM film WHERE type='$type' AND id_data='$id'");

    $sth->execute();
    $result = $sth->fetch();

    return $result;
}

function favoris()
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $id = $_POST['id'];
    $type = $_POST['type'];

    $search = searchFilm($type, $id);

    $idUser = $_SESSION['id'];
    $result = $search['id'];

    $stt = $bdd->prepare("SELECT * FROM user_film WHERE id_user='$idUser'");

    $stt->execute();

    $var = $stt->fetchAll(PDO::FETCH_ASSOC);
    $bool = true;

    for ($i = 0; isset($var[$i]); $i++) {
        if ($var[$i]['id_film'] == $result) {
            $bool = false;
        }
    }

    if ($bool == true) {

        $sth = $bdd->prepare("INSERT INTO `user_film`(`id_user`, `id_film`) VALUES ('$idUser','$result')");
        $sth->execute();

        echo json_encode([
            "code" => 10
        ]);
        
    } else {

        echo json_encode([
            "code" => 66,
            "message" => "Cet élément est déjà dans vos favoris"
        ]);
    }
}

function sortMovie()
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $sth = $bdd->prepare("SELECT * FROM user_film WHERE id_user= :id");
    $sth->execute([':id' => $_SESSION['id']]);

    $movie = [];
    $tv = [];

    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {

        for ($i = 0; isset($result[$i]); $i++) {

            $stt = $bdd->prepare("SELECT * FROM film WHERE id=?");
            $stt->execute([$result[$i]['id_film']]);
            $var = $stt->fetch();

            if ($var['type'] == 'movie') {

                array_push($movie, $var['id_data']);
            } else {

                array_push($tv, $var['id_data']);
            }
        }

        echo json_encode([
            "code" => 10,
            "movie" => $movie,
            "tv" => $tv
        ]);
    } else {

        echo json_encode([
            "code" => 66,
            "message" => "Vous n'avez pas encore de favoris"
        ]);
    }
}

if ($_GET['action'] == 'addfilm') {
    addFilm();
}

if ($_GET['action'] == 'coeur') {
    favoris();
}

if ($_GET['action'] == 'sortmov') {
    sortMovie();
}
