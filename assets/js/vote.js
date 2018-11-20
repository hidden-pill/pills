$(function(){
    $('.vote').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/vote.php', 
            {
                id_column: $(this).attr('id_column'),
                upvote: $(this).attr('upvote'),
                column: $(this).attr('column')
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
                    console.log(color);
                    $('#pill'+data['item']).css('background-color', 'rgb(' + color +')');
                    switch(data['action']){
                        case 'del':
                            if(data['button'] == 1){
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .upvote').removeClass('up');
                            } else {
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .downvote').removeClass('down');
                            }
                            break;
                        case 'ins':
                            if(data['button'] == 1){
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .upvote').addClass('up');
                            } else {
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .downvote').addClass('down');
                            }
                            break;
                        case 'upd':
                            if(data['button'] == 1){
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .upvote').addClass('up');
                                $('#pill'+data['item'] + ' .downvote').removeClass('down');
                            } else {
                                $('#pill'+data['item'] + ' .sumupvote').text(data['sum']);
                                $('#pill'+data['item'] + ' .downvote').addClass('down');
                                $('#pill'+data['item'] + ' .upvote').removeClass('up');
                            }
                            break;
                    }
                }
        },'json');
    });
});
