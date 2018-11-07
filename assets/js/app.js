$(document).ready(function () {
  $(".button-collapse").sideNav();
  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();

  $('.chips').material_chip();
  $('.chips-autocomplete').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 0
    }
  });

});