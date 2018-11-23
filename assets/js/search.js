$(function(){
    var href = $('#submitSearch').attr('href');
    $('#search').keyup(function(){
        $('#submitSearch').attr('href', href + $('#search').val());
    });

});
$('#search').click(function(){
    href = '';  
});