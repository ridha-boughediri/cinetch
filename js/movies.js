'use strict'
document.addEventListener('DOMContentLoaded', (event) => {

    const API_KEY = 'a3c9c1ecbe0b1a0ec1b5277420fe8e3b'
    const ul = document.querySelector('#list')
    let grid = document.querySelector('.movies-grid');


    function moviesGenres() {

        fetch('https://api.themoviedb.org/3/genre/movie/list?api_key=' + API_KEY + '&language=fr')
            .then(response => response.json())
            .then(data => {


                for (var i = 0; i < data.genres.length; i++) {

                    let li = document.createElement('li');
                    let a = document.createElement('a');
                    
                    a.classList.add('list');
                    a.classList.add(data.genres[i].id);
                    a.href = '#';
                    a.innerHTML = data.genres[i].name;

                    li.appendChild(a);
                    ul.appendChild(li);
                }

                var a = document.querySelectorAll('.list');
                
                for (let j = 0; j < a.length; j++) {

                    a[j].addEventListener('click', (event) => {

                        event.preventDefault();
                        grid.innerHTML = "";

                        var idGenre = event.path[0].classList[1];

                        fetch('https://api.themoviedb.org/3/discover/movie?api_key=' + API_KEY + '&language=fr-FR&with_genres=' + idGenre)
                            .then(response => response.json())
                            .then(data => {
                                for (let k = 0; k < data.results.length; k++) {

                                    let cards = document.createElement('div');
                                    let a = document.createElement('a');
                                    
                                    cards.classList.add('card');
                                    
                                    a.innerHTML = data.results[k].title
                                    a.href = './movie.php?type=movie&id=' + data.results[k].id;

                                    let img = document.createElement('img');
                                    img.src = 'https://image.tmdb.org/t/p/w500/' + data.results[k].poster_path
                                    img.alt = 'Poster du film ' + data.results[k].title;

                                    a.innerHTML = data.results[k].title

                                    cards.appendChild(a);
                                    a.appendChild(img);
                                    grid.appendChild(cards);
                                }
                            })


                    })
                }

            })
    }
    moviesGenres();

})