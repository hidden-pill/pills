$(function(){
    $('.rating i').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/score.php', 
            {
                id_column: $(this).attr('id_column'),
                score: $(this).attr('score'),
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
                    $('.avg').text(data['sum']);
                    if(data['action'] == 'ins' || data['action'] == 'upd'){
                        for(var star = 1; star <= 10; star++){ 
                            if(star <= data['button']){
                            $('#rating' + data['column'] + data['item'] + ' .star' + star).text('star');
                            } else {
                            $('#rating' + data['column'] + data['item'] + ' .star' + star).text('star_border');
                            }
                        }
                    } else {
                        $('#rating' + data['column'] + data['item'] + ' i').text('star_border');
                    }
                }
            },'json');
    });
});
