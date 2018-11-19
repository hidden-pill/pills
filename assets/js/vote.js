/*function upvote(){
    $.post(
      '../ajax/vote.php', 
      {
        getsumupvote: null,
        id_column: $(this).attr('id_column'),
        column: $(this).attr('column')
      },
      function(data){
          if (data == 'success') {
              $('.sumupvote').text('2');
          }else {
              alert('erreur');
          }
      }, 'text'
    );
  }
*/
$(function(){
    $('.upvote').click(function(e) {
        e.preventDefault();
        $.post(
            '../ajax/vote.php', 
            {
                id_column: $(this).attr('id_column'),
                upvote: $(this).attr('upvote'),
                column: $(this).attr('column')
            },
            function(data){
                if (data == 'success') {
                    $('.sumupvote').text('2');
                } else if(data == 'nosession') {
                    alert('connection');
                }else if(data == 'del') {
                    alert('del');
                }else {
                    alert('erreur');
                }
            }, 'text'
        );
    });
});