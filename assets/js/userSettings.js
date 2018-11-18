$(function () {
    $('#changePassword').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/userUpdate.php', 
            {
                answer: $('#answer').val(), 
                newpassword: $('#newpassword').val()
            },
            function(data){
                if (data == 'Success') {
                    alert('oui');
                } else {
                    alert('non');
                }
            }, 'text'
        );
    });
});