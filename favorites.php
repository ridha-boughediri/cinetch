<?php
session_start();
$title = "Cinetech - Mes Favoris";
ob_start();
?>

<main>
    <section class="film">

    </section>

    <section class="tv">

    </section>

</main>

<?php
$content = ob_get_clean();
require('template.php');
?>