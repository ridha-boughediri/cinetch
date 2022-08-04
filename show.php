<?php
session_start();
$title = "Cinetech - Détails";
$js = 'show';
$css = 'movie';
ob_start();
?>

<main>

<?php if(isset($_SESSION['id'])) :?>
        <button type="button" class="addFav2" name="addfav2">Ajouter aux favoris</button>
        <?php endif; ?>

    <div class="container">

    </div>

    <hr>

    <section class="com">
        <h3>Commentaires</h3>
        <ul class="comm"></ul>
        <input type="text" name="comment" placeholder="Votre commentaire">
        <input type="button" name="submit" value="Envoyer" id="submit">
    </section>


    <hr>

    <h1>Dans le même genre</h1>
    <div class="similar">

    </div>
</main>

<?php
$content = ob_get_clean();
require('template.php');
?>