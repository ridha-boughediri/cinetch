'use strict'
document.addEventListener('DOMContentLoaded', (event) => {

    const api = 'a3c9c1ecbe0b1a0ec1b5277420fe8e3b'

    var com = document.querySelector('.comm');
    var addComment = document.querySelector('#submit');

    var str = window.location.href
    var url = new URL(str)
    var id = url.searchParams.get("id");
    var type = url.searchParams.get("type");

    var formsearch = new FormData()

    formsearch.append('idfilm', id)
    formsearch.append('type', type)


    fetch("https://api.themoviedb.org/3/" + type + "/" + id + "/reviews" + "?api_key=" + api)
        .then(response => response.json())
        .then(data => {

            for (var i = 0; i < data.results.length; i++) {

                var li = document.createElement('li')
                com.appendChild(li)

                var titre = document.createElement('h6')
                li.appendChild(titre)
                titre.textContent = "Ecrit par " + data.results[i].author

                var date = new Date(data.results[i].updated_at).toLocaleDateString()
                var insertDate = document.createElement('h7')
                insertDate.textContent = "Ecrit le : " + date
                li.appendChild(insertDate)

                var content = document.createElement('p')
                li.appendChild(content)
                content.textContent = data.results[i].content
            }
        })

    fetch('./controller/comment.php?action=searchcomment', {
        method: 'POST',
        body: formsearch
    })
        .then(response => response.json())
        .then(data => {

            if (data['message'].length != 0) {

                for (var i = 0; i < data['message'].length; i++) {

                    var li = document.createElement('li')
                    com.prepend(li)

                    var titre = document.createElement('h6')
                    li.appendChild(titre)
                    titre.textContent = "Ecrit par " + data['message'][i].login

                    var date = new Date(data['message'][i].date).toLocaleDateString()
                    var insertDate = document.createElement('h7')
                    insertDate.textContent = "Ecrit le : " + date
                    li.appendChild(insertDate)

                    var content = document.createElement('p')
                    li.appendChild(content)
                    content.textContent = data['message'][i].comment

                }
            }
        })

    addComment.addEventListener('click', e => {

        e.preventDefault()

        var commentaire = document.querySelector('#addComment')
        var form = new FormData()

        form.append('type', type)
        form.append('id', id)

        if (commentaire.value != "") {

            fetch('./controller/comment.php?action=addfilm', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(data => {

                    if (data['code'] == 10) {

                        var form2 = new FormData()

                        form2.append('text', commentaire.value)
                        form2.append('id_film', id)
                        form2.append('type', type)

                        fetch('./controller/comment.php?action=addcomment', {
                            method: 'POST',
                            body: form2
                        })
                            .then(response => response.json())
                            .then(data => {
                                
                                var li = document.createElement('li')
                                com.prepend(li)

                                var titre = document.createElement('h6')
                                li.appendChild(titre)
                                titre.textContent = "Ecrit par " + data['login']

                                var date = new Date().toLocaleDateString()
                                var insertDate = document.createElement('h7')

                                insertDate.textContent = "Ecrit le : " + date
                                li.appendChild(insertDate)

                                var content = document.createElement('p')
                                li.appendChild(content)
                                content.textContent = commentaire.value
                                commentaire.value = "";
                            })
                    }
                })
        }

    })

    var favo = document.querySelector('.addFav2');
    var favo2 = document.querySelector('.addFav2');

    favo.addEventListener('click', e => {

        e.preventDefault()

        var form = new FormData()
        
        form.append('type', type)
        form.append('id', id)

        fetch('./controller/favoris.php?action=addfilm', {
            method: 'POST',
            body: form
        })
            .then(response => response.json())
            .then(data => {

                if (data['code'] == 10){
                    fetch('./controller/favoris.php?action=coeur',{
                        method: 'POST',
                        body:form
                    })
                        .then(response=>response.json())
                        .then(data=> {

                            if (data['code']==10){
                                window.alert('Vous avez bien rajouté cet élément à vos favoris.')
                            }else if(data['code']==66){
                                window.alert(data['message'])
                            }
                        })
                }

            })
    })

/*     favo2.addEventListener('click', e => {
        e.preventDefault()
        var form = new FormData()
        form.append('type', type)
        form.append('id', id)
        fetch('./controller/favoris.php?action=addfilm', {
            method: 'POST',
            body: form
        })
            .then(response => response.json())
            .then(data => {
                if (data['code']==10){
                    fetch('./controller/favoris.php?action=coeur',{
                        method: 'POST',
                        body:form
                    })
                        .then(response=>response.json())
                        .then(data=> {

                            if (data['code']==10){
                                window.alert('Vous avez bien rajouté cet élément à vos favoris.')
                            }else if(data['code']==66){
                                window.alert(data['message'])
                            }
                        })
                }

            })
    })
 */
})