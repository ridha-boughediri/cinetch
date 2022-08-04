
document.addEventListener('DOMContentLoaded', function loaded() {
    const api = 'a3c9c1ecbe0b1a0ec1b5277420fe8e3b'

    var film = document.querySelector('.film');
    var show = document.querySelector('.tv');

    fetch('./controller/favoris.php?action=sortmov')
        .then(response => response.json())
        .then(data => {

            if (data["code"] == 10) {

                if (data.movie.length != 0) {

                    const title = document.createElement('h1')
                    title.textContent = 'Vos films favoris'
                    film.appendChild(title);
                    
                    for (var i = 0; i < data.movie.length; i++) {

                        fetch("http://api.themoviedb.org/3/movie/" + data.movie[i] + "?api_key=" + api + "&language=fr-FR")
                            .then(response => response.json())
                            .then(data => {

                                let link = document.createElement('a');
                                link.href = './movie.php?type=movie&id=' + data.id;

                                let img = document.createElement('img');
                                img.src = 'https://image.tmdb.org/t/p/w500/' + data.poster_path;
                                img.alt = data.title;

                                film.appendChild(link);
                                link.appendChild(img);

                            })
                    }

                } else {
                    var h2 = document.createElement('h2')
                    h2.textContent = "Vous n'avez pas encore ajouté de film à vos favoris."
                    film.appendChild(h2)
                }

                if (data.tv.length != 0) {

                    let title2 = document.createElement('h1')
                    title2.textContent = 'Vos series favorites'
                    show.appendChild(title2)

                    for (var i = 0; i < data.tv.length; i++) {

                        fetch("https://api.themoviedb.org/3/tv/" + data.tv[i] + "?api_key=" + api + "&language=fr-FR")
                            .then(response => response.json())
                            .then(data => {

                                let link = document.createElement('a');
                                link.href = './show.php?type=tv&id=' + data.id;

                                let img = document.createElement('img');
                                img.src = 'https://image.tmdb.org/t/p/w500/' + data.poster_path;
                                img.alt = data.name;

                                show.appendChild(link);
                                link.appendChild(img);

                            })
                    }

                } else {

                    var h2 = document.createElement('h2')
                    h2.textContent = "Vous n'avez pas encore ajouté de séries à vos favoris."
                    show.appendChild(h2)
                }

            } else {

                var h1 = document.createElement('h1');
                h1.textContent = data['message'];
                film.appendChild(h1);
            }
        })
})
