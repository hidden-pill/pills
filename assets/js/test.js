
$("[data-menu-underline-from-center] a").addClass("underline-from-center");

$(document).ready(function () {
    $('#test li').click(function() {
        $('.active').removeClass('active');
         $(this).addClass('active');
    });
});