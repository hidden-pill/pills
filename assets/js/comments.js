$(function () {
    // click to add an input
    $('.addComment').click(function () {
        var comment = $(this).attr('comment');
        $(this).remove();
        $('#comment' + comment + ' .commentFooter').append(' <textarea class="materialize-textarea"></textarea><div class="btn black addComment" comment="' + comment + '">Envoyer le commentaire</div>');
        $('#comment' + comment).removeClass('userComment').addClass('userCommentAnswer');
    });
    // send comment in ajax
    $('#sendComment').click(function(e){
        e.preventDefault();
        $.post(
            '../ajax/comment.php', 
        {
        comment: $('#newComment').val(),
        id_column: $(this).attr('id_column'),
        column: $(this).attr('column')
        },
        function (data) {
            if ('error' in data) {
                alert('Il a eu une erreur, veuillez réessayer')
            }else{
                location.reload();
            }
        }, 'json');
    });
});