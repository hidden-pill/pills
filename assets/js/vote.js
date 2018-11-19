$(function(){
    $('#plus').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/vote.php', 
            {
                id_review: $('#plus').attr('review'),
                plus: 1
            },
            function(data){
                if (data == 'Success') {
                    alert('Votre mot de passe a bien été changé');
                } else {
                    alert('erreur');
                }
            }, 'text'
        );
    });
});