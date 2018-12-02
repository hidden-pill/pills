$(function(){
    $('.vote').click(function(e) {
        var column = $(this).attr('column');
        var id_column = $(this).attr('id_column');
        var upvote = $(this).attr('upvote');
        e.preventDefault();
        $.post(
            '../ajax/vote.php', 
            {
                id_column: id_column,
                upvote: upvote,
                column: column
            },
            function(data){
                if('error' in data){
                    switch(data['error']){
                        case 'nossession':
                            $('#logIn').modal('open');
                            break;
                        case 'error':
                            alert('Il a eu une erreur, veuillez réessayer')
                            break;
                    }
                } else {
                    var red = 255;
                    var green = 255;
                    var blue = 255;
                    var sum = parseInt(data['sum']);
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
                    var color = red + ',' + green + ', ' + blue;
                    $('#pill' + column + id_column).css('background-color', 'rgb(' + color + ')');
                    $('#pill' + column + id_column + ' .sumupvote').text(data['sum']);
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


