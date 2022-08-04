<?php
session_start();
$title = "Cinetech - Passion Films/Séries";
$js = 'index';

ob_start();
?>
<main class="container">

    <article class="movies-container trending-films">

        <h1>Films actuels</h1>

        <div class="movies-grid">
        </div>

        <div class="popup-container">
            <span class="x-icon">&#10006;</span>
        </div>

    </article>

    

    <article class="movies-container trending-shows">
        <h1>Séries actuelles</h1>
        <div class="movies-grid">
            <div class="card" data-id="123456">
                <div class="img">
                    <img src="https://unsplash.it/500/1000" alt="affiche du film">
                </div>
                <div class="info">
                    <h2>Titre</h2>
                    <div class="single-info">
                        <span>Note: </span>
                        <span>10 / 10</span>
                    </div>
                    <div class="single-info">
                        <span>Date de sortie: </span>
                        <span>10-04-2022</span>
                    </div>
                </div>
            </div>
        </div>

    </article>

</main>
<?php
$content = ob_get_clean();
require('template.php');
?>