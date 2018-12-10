$(function(){
// data send to php file vote.php

    $('.vote').click(function(e) {
        var column = $(this).attr('column');
        var id_column = $(this).attr('id_column');
        var upvote = $(this).attr('upvote');
        e.preventDefault();
        $.post(
            '../ajax/vote.php', 
            {
                //data send to php file
                id_column: id_column,
                upvote: upvote,
                column: column
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
                    // set rgb color white
                    var red = 255;
                    var green = 255;
                    var blue = 255;
                    // transform str received to int
                    var sum = parseInt(data['sum']);
                    /* if pill not white 'cause total isn't equal to zero, green set to zero
                    and others colors according to the total received */
                    if(data['sum'] != 0){
                        green = 0;
                        if(sum > 0){
                            red = sum + 100;
                            blue = sum - 100;
                        } else {
                            red = sum - 100;
                            blue = sum + 100;
                        }
                    }
                    // rgb string
                    var color = red + ',' + green + ', ' + blue;
                    // change bgc with color set
                    $('#pill' + column + id_column).css('background-color', 'rgb(' + color + ')');
                    // change total displayed
                    $('#pill' + column + id_column + ' .sumupvote').text(data['sum']);
                    // change +/- css class button according with action done
                    switch(data['action']){
                        case 'del':
                            if(upvote == 1){
                                $('#pill' + column + id_column + ' .upvote').removeClass('up');
                            } else {
                                $('#pill' + column + id_column + ' .downvote').removeClass('down');
                            }
                            break;
                        case 'ins':
                            if(upvote == 1){
                                $('#pill' + column + id_column + ' .upvote').addClass('up');
                            } else {
                                $('#pill' + column + id_column + ' .downvote').addClass('down');
                            }
                            break;
                        case 'upd':
                            if(upvote == 1){
                                $('#pill' + column + id_column + ' .upvote').addClass('up');
                                $('#pill' + column + id_column + ' .downvote').removeClass('down');
                            } else {
                                $('#pill' + column + id_column + ' .downvote').addClass('down');
                                $('#pill' + column + id_column + ' .upvote').removeClass('up');
                            }
                            break;
                    }
                }
        },'json');
    });
});


