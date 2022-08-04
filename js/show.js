'use strict'
document.addEventListener('DOMContentLoaded', (event) => {

    const api = '3e1f13aaa5db3499e23b1fd92e3bed82';

    let str = window.location.href

    let tvId = location.search.replace(/[^0-9\.]/g, '');
    console.log(tvId);

    fetch('https://api.themoviedb.org/3/tv/' + tvId + '?api_key=' + api + '&language=fr-FR')
        .then(response => response.json())
        .then(data => {

            var container = document.querySelector('.container');

            let img2 = document.createElement('img');
            img2.src = 'https://image.tmdb.org/t/p/w500/' + data.backdrop_path

            let spanT = document.createElement('span');
            spanT.innerHTML = 'Titre:';
            let nom = document.createElement('p');
            nom.classList.add('nom');
            nom.innerHTML = data.name

            let spanO = document.createElement('span');
            spanO.innerHTML = 'Description:'
            let overview = document.createElement('p');
            overview.classList.add('over');
            overview.innerHTML = data.overview;

            let spanR = document.createElement('span');
            spanR.innerHTML = 'Date de sortie'
            let release = document.createElement('p');
            release.classList.add('rel');
            release.innerHTML = data.first_air_date;

            let spanK = document.createElement('span');
            spanK.innerHTML = 'Note:'
            let rank = document.createElement('p');
            rank.classList.add('rank');
            rank.innerHTML = data.vote_average + '/10';

            fetch('https://api.themoviedb.org/3/tv/' + tvId + '/credits?api_key=' + api + '&language=en-US')
                .then(response => response.json())
                .then(data => {
                    var container = document.querySelector('.container');
                    for (let j = 0; j < data.cast.length; j++) {
                        let actors = document.createElement('p');
                        actors.innerHTML = data.cast[j].name + '  ' + 'as' + '  ' + data.cast[j].character

                        container.appendChild(actors)
                    }

                })

            container.appendChild(img2)
            container.appendChild(spanT)
            container.appendChild(nom)
            container.appendChild(spanO)
            container.appendChild(overview)
            container.appendChild(spanR)
            container.appendChild(release)
            container.appendChild(spanK)
            container.appendChild(rank);
            console.log(data)
        })

    function similar(tvId) {

        fetch('https://api.themoviedb.org/3/tv/' + tvId + '/similar?api_key=' + api + '&language=fr-FR')
            .then(response => response.json())
            .then(data => {
                var item = data.results
                var same = document.querySelector('.similar')
                for (let i = 0; i < item.length; i++) {
                    let a = document.createElement('a');
                    a.href = './show.php?tv=' + item[i].id;

                    let img = document.createElement('img');
                    img.src = 'https://image.tmdb.org/t/p/w500/' + item[i].poster_path;
                    img.alt = item[i].title;

                    same.appendChild(a)
                    a.appendChild(img)
                }
            })
    }
    similar(tvId)


})