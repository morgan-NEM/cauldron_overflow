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