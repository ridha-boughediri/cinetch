'use strict'
document.addEventListener('DOMContentLoaded', (event) => {

    const API_KEY = `a3c9c1ecbe0b1a0ec1b5277420fe8e3b`

    var search = document.querySelector('#search');
    var ul = document.querySelector('.result');
    var films = document.createElement('h4');
    var series = document.createElement('h4');

    search.addEventListener('keyup', (e) => {

        e.preventDefault();

        if (search.value.length == 0) {
            ul.classList.add('hidden');
            
        } else {
            fetch('https://api.themoviedb.org/3/search/movie?api_key=' + API_KEY + "&language=fr-FR&query=" + search.value)
            .then(response => response.json())
            .then(data => {


                ul.appendChild(films);
                films.textContent = 'Films'

                for (var i = 0; i < 6; i++) {

                    if (data.results[i].length != 0) {

                        var li = document.createElement('li');
                        ul.appendChild(li);

                        var a = document.createElement('a');

                        a.innerHTML = data.results[i].title

                        li.appendChild(a);

                        a.setAttribute("href", './movie.php?type=movie&id=' + data.results[i].id)

                        ul.classList.remove('hidden');

                    }
                }
            })

        fetch('https://api.themoviedb.org/3/search/tv?api_key=' + API_KEY + "&language=fr-FR&query=" + search.value)
            .then(response => response.json())
            .then(data => {

                ul.appendChild(series);
                series.textContent = 'Séries'

                for (var j = 0; j < 6; j++) {

                    if (data.results[j].length != 0) {

                        var li = document.createElement('li');
                        var a = document.createElement('a');

                        a.innerHTML = data.results[j].name
                        a.setAttribute("href", './show.php?type=tv&id=' + data.results[j].id);
                        li.appendChild(a);
                        ul.appendChild(li);
                        ul.classList.remove('hidden');
                    }
                }
            })

        }
        
        while (ul.firstChild) {
            films.innerHTML = ""
            series.innerHTML = ""
            ul.removeChild(ul.firstChild);
        }

    })

})