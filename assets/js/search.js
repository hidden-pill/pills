$(function(){
    var href = $('#submitSearch').attr('href');
    $('#search').keyup(function(){
        // change href attribut when user write in search bar
        $('#submitSearch').attr('href', href + $('#search').val());
    });

});
$('#search').click(function(){
    href = '';  
});