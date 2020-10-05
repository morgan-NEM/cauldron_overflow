/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery'

console.log('Hello Webpack Encore! Edit me in assets/app.js');
let container = $(".js-vote-arrow-class")
container.find('a').on('click', function (e){
    e.preventDefault();

    let link = $(e.currentTarget);
    console.log('coucou')
    $.ajax({
        url: '/comments/10/vote/' + link.data('direction'),
        method: 'POST'
    }).then(function (data){
        container.find('.js-vote-total').text(data.votes)
    })
})