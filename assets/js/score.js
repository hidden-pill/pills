$(function(){
// data send to php file score.php

    $('.rating i').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/score.php', 
            {
                //data send to php file
                id_column: $(this).attr('id_column'),
                score: $(this).attr('score'),
                column: $(this).attr('column')
            },
            // data send by php file
            function(data){
                // check if error is send
                if('error' in data){
                    // if user is not connect, login modal pop, else its an error, send an alert with a message
                    switch(data['error']){
                        case 'nossession':
                            $('#logIn').modal('open');
                            break;
                        case 'error':
                            alert('Il a eu une erreur, veuillez réessayer')
                            break;
                    }
                // if no error 
                } else {
                    // change average score
                    $('.avg').text(data['sum']);
                    // if user add a score or change score already send, change materialize text according to the score
                    if(data['action'] == 'ins' || data['action'] == 'upd'){
                        for(var star = 1; star <= 10; star++){ 
                            if(star <= data['button']){
                            $('#rating' + data['column'] + data['item'] + ' .star' + star).text('star');
                            } else {
                            $('#rating' + data['column'] + data['item'] + ' .star' + star).text('star_border');
                            }
                        }
                    } else {
                        // if delete score, reset stars to same materialize text
                        $('#rating' + data['column'] + data['item'] + ' i').text('star_border');
                    }
                }
            },'json');
    });
});
