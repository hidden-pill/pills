$(function(){
    $('#search').keyup(function(){
        $('#submitSearch').attr('href', 'search=' + $('#search').val());
    });
});
