$(document).ready(function () {
  $(".button-collapse").sideNav();
  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();

  $('select').material_select();

  $('.dropdown-button').dropdown({
    constrainWidth: false // Does not change width of dropdown to that of the activator
  });
  
  $('#textarea1').trigger('autoresize');

});