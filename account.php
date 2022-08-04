<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
} else {
    $title = "Profil de " . $_SESSION["login"];
    ob_start();
?>


    <main>

        <h1><?= $_SESSION["login"]; ?> , vous pouvez modifier votre profil de connexion ici:</h1>

        <!-- LOGIN MODIFY FORM -->
        <!-- <form action="controller/profil.php" method="post" id="login">

            <fieldset>

                <legend>Modification d'identifiant</legend>

                <p> Votre identifiant actuel est : "<?= $_SESSION['login'] ?>"</p>

                <label for="login">Nouvel identifiant</label>

                <input type="text" class="box-input" name="newLogin" id="login" placeholder="Nouvel identifiant" required />

                <label for="password">Mot de passe</label>

                <input type="password" placeholder="Mot de passe" name="password" id="password" required>
                <hr>

                <button type="submit" form="login" name="update-login">Modifier identifiant</button>

            </fieldset>

        </form> -->

        <!-- PASSWORD MODIFY FORM -->
        <!-- <form action="controller/profil.php" method="post" id="pwd">

            <fieldset>

                <legend>Modification du mot de passe</legend>

                <label for="old-pwd">Ancien mot de passe</label>

                <input type="password" name="password" id="old-pwd" placeholder="Ancien mot de passe" required>

                <label for="new-pwd">Nouveau mot de passe</label>

                <input type="password" name="newPwd" id="new-pwd" placeholder="Nouveau mot de passe" required>

                <label for="new-pwd-repeat">Confirmation du nouveau mot de passe</label>

                <input type="password" name="pwdRepeat" id="new-pwd-repeat" placeholder="Confirmation du nouveau mot de passe" required>
                <hr>

                <button type="submit" form="pwd" name="update-pwd">Modifier mot de passe</button>

            </fieldset>

        </form> -->

        <!-- ACCOUNT DELETE FORM -->
        <form action="controller/profil.php" method="post" id="delete">

            <fieldset>

                <legend>Suppression du compte</legend>

                <p> Après avoir entré votre mot de passe, cliquer sur "Supprimer profil" entraîne une suppession irréversible.
                <p>

                    <label for="password">Mot de passe</label>

                    <input type="password" placeholder="Mot de passe" name="password" id="password" required>

                    <button type="submit" form="delete" name="delete">Supprimer profil</button>

            </fieldset>

        </form>

    </main>

<?php

    $content = ob_get_contents();

    ob_end_clean();

    require('template.php');
}

?>