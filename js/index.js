"use strict";

document.addEventListener("DOMContentLoaded", event => {

    const API_KEY = `a3c9c1ecbe0b1a0ec1b5277420fe8e3b`
    const image_path = `https://image.tmdb.org/t/p/w1280`

    const trending_films = document.querySelector('.trending-films .movies-grid')
    const trending_shows = document.querySelector('.trending-shows .movies-grid')

    const popup_container = document.querySelector('.popup-container')

    // POPUP
    async function get_movie_by_id(id, type) {

        const resp = await fetch(`https://api.themoviedb.org/3/${type}/${id}?api_key=${API_KEY}&language=fr`)
        const respData = await resp.json()
        return respData
    }

    async function show_popup(card) {

        popup_container.classList.add('show-popup')

        const movie_id = card.getAttribute('data-id')

        const type = card.getAttribute('data-type')

        const movie = await get_movie_by_id(movie_id, type)


        if (type === 'tv') {

            var title = movie.name
            var date = movie.first_air_date
        }
        else {

            title = movie.title
            date = movie.release_date

        }

        popup_container.style.background = `linear-gradient(rgba(0, 0, 0, .8), rgba(0, 0, 0, 1)), url(${image_path + movie.poster_path})`

        popup_container.innerHTML = `
            <span class="x-icon">&#10006;</span>
            <div class="content">
                <div class="left">
                    <div class="poster-img">
                        <img src="${image_path + movie.poster_path}" alt="">
                    </div>
                </div>
                <div class="right">
                    <h1>${title}</h1>
                    <div class="single-info-container">
                        <div class="single-info">
                            <span>Language:</span>
                            <span>${movie.spoken_languages[0].name}</span>
                        </div>
                        <div class="single-info">
                            <span>Rate:</span>
                            <span>${movie.vote_average} / 10</span>
                        </div>
                        <div class="single-info">
                            <span>Release Date:</span>
                            <span>${date}</span>
                        </div>
                    </div>
                    <div class="genres">
                        <h2>Genres</h2>
                        <ul>
                            ${movie.genres.map(e => `<li>${e.name}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="overview">
                        <h2>Overview</h2>
                        <p>${movie.overview}</p>
                    </div>
                </div>
            </div>
    `
        const x_icon = document.querySelector('.x-icon')
        x_icon.addEventListener('click', () => popup_container.classList.remove('show-popup'))

    }

    // Trending Movies
    get_trending_movies()
    async function get_trending_movies() {
        const resp = await fetch(`https://api.themoviedb.org/3/trending/movie/day?api_key=${API_KEY}&language=fr`)
        const respData = await resp.json()
        return respData.results
    }

    // Trending TV Shows
    get_trending_shows()
    async function get_trending_shows() {
        const resp = await fetch(`https://api.themoviedb.org/3/trending/tv/day?api_key=${API_KEY}&language=fr`)
        const respData = await resp.json()
        return respData.results
    }

    (async function add_to_dom_trending() {

        const movies = await get_trending_movies()
        const shows = await get_trending_shows()

        trending_films.innerHTML = movies.slice(0, 6).map(e => {
            return `
            <div class="card" data-id="${e.id}" data-type="movie">
                <div class="img">
                    <img src="${image_path + e.poster_path}">
                </div>
                <div class="info">
                    <h2>${e.title}</h2>
                    <div class="single-info">
                        <span>Note: </span>
                        <span>${e.vote_average} / 10</span>
                    </div>
                    <div class="single-info">
                        <span>Sortie : </span>
                        <span>${e.release_date}</span>
                    </div>
                </div>
            </div>
        `
        }).join('')

        trending_shows.innerHTML = shows.slice(0, 6).map(e => {
            return `
            <div class="card" data-id="${e.id}" data-type="tv">
                <div class="img">
                    <img src="${image_path + e.poster_path}">
                </div>
                <div class="info">
                    <h2>${e.name}</h2>
                    <div class="single-info">
                        <span>Note: </span>
                        <span>${e.vote_average} / 10</span>
                    </div>
                    <div class="single-info">
                        <span>Sortie : </span>
                        <span>${e.first_air_date}</span>
                    </div>
                </div>
            </div>
        `
        }).join('')

        const cards = document.querySelectorAll('.card')

        cards.forEach(card => {
            card.addEventListener('click', () => show_popup(card))
        })
    })();

});