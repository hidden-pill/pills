$(function(){

    $('#changePassword').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/userUpdate.php', 
            {
                answer: $('#answer').val(), 
                newpassword: $('#newpassword').val()
            },
            function(data){
                if (data == 'SuccessPassword') {
                    alert('Votre mot de passe a bien été changé');
                } else {
                    alert('erreur');
                }
            }, 'text'
        );
    });

    $('#changeEmail').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/userUpdate.php', 
            {
                answer: $('#answer').val(), 
                newemail: $('#newemail').val()
            },
            function(data){
                if (data == 'SuccessEmail') {
                    alert('Votre email a bien été changé');
                } else {
                    alert('erreur');
                }
            }, 'text'
        );
    });

    $('#newNewsletter').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/userUpdate.php', 
            {
                answer: $('#answer').val(), 
                newnewsletter: $('#newNewsletter').val()
            },
            function(data){
                if (data == 'SuccessNewsletter') {
                    alert('Votre abonnement à la newsletter a été mis à jour');
                } else {
                    alert('erreur');
                }
            }, 'text'
        );
    });
    
});