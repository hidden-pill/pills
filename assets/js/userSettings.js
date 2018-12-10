$(function(){
// data send to php file userUpdate.php


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
                newnewsletter: $('#newNewsletter').val()
            },
            function(data){
                if (data == 'SuccessNewsletter') {
                    location.reload(); 
                } else {
                    alert('erreur');
                }
            }, 'text'
        );
    });

    $('#deleteAccount').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/userUpdate.php', 
            {
                checkdelete: $('#checkDelete').val()
            },
            function(data){
                if (data == 'DELETESUCCESS') {
                    // reload page to redirect user 
                    location.reload();
                } else {
                    alert('il a eu un problème');
                }
            }, 'text'
        );
    });

});