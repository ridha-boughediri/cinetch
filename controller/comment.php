<?php
session_start();

function searchComment()
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $id = $_POST['idfilm'];
    $type = $_POST['type'];

    $sth = $bdd->prepare("SELECT commentaires.*, utilisateurs.login FROM commentaires INNER JOIN film ON commentaires.id_film=film.id
INNER JOIN utilisateurs ON commentaires.id_user=utilisateurs.id WHERE film.type= '$type' AND film.id_data='$id' ORDER BY commentaires.date DESC");

    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'code' => 10,
        'message' => $result
    ]);
}

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

function addComment()
{
    $bdd = new PDO("mysql:host = localhost ; dbname=cinetech; charset=utf8", 'root', '');

    $idUser = $_SESSION['id'];
    $id = $_POST['id_film'];
    $type = $_POST['type'];
    $text = $_POST['text'];

    $result = searchFilm($type, $id);

    $idFilm = $result['id'];

    $sth = $bdd->prepare("INSERT INTO `commentaires`(`id_user`, `id_film`, `comment`, `date`) VALUES (?,?,?,NOW())");
    $sth->execute([$idUser, $idFilm, $text]);

    echo json_encode([
        "code" => 10,
        "login" => $_SESSION['login']
    ]);
}

if ($_GET['action'] == 'addfilm') {
    addFilm();
}
if ($_GET['action'] == 'addcomment') {
    addComment();
}
if ($_GET['action'] == 'searchcomment') {
    searchComment();
}



?>