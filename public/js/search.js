/* PREREQUISITES
  ** SEARCHBAR input type `text` or `search` with `searchbar` class
  e.g <input type="text || search" ... class="searchbar">

  ** SEARCHABLES - every item to be included in searching should have a class "searchable"
  IMPORTANT: make sure the class is given to the first div.
  e.g <div class="col-xs-12 col-md-6 searchable">

  ** SEARCHBAR BUTTON (optional)
  a <button> or <span> with the class `searchbtn`. This should be using either `fa-search` or `mdi-search`.
  e.g <button class="mdi mdi-search fw-search-btn searchbtn"></button>

  ABOUT
  Adding this script will help you search through the page, through all content in the `searchables`.
  Shows all results that match the search criteria and hides those that don't.
  This also searches through hidden divs in the searchable.

  // Author: Kon - T5
*/
$(document).ready(function() {

  var icons = ["mdi-search", "mdi-close"];
  if ($(".searchbtn").hasClass("fa-search"))
    icons = ["fa-search", "fa-times"];

  $("input.searchbar").keyup(function() {
    // in case of multiple searchbars
    $("input.searchbar").val($(this).val());

    if ($(this).val().length > 0)
      $(".searchbtn").removeClass(icons[0]).addClass(icons[1]);
    else
      $(".searchbtn").addClass(icons[0]).removeClass(icons[1]);

    $(".searchable").each(function() {
      // search through children
      var found = false;
      $(this).contents().each(function() {
        var val = $(this).text().toLowerCase();
        if (val.indexOf($("input.searchbar").val().toLowerCase()) >= 0)
          found = true;
      });

      $(this).toggle(found);
    });

  });

  $(".searchbtn").click(function() {
    if ($(".searchbtn").hasClass(icons[1])) {
      $("input.searchbar").val("");
      $(".searchbtn").addClass(icons[0]).removeClass(icons[1]);
      $(".searchable").show();
    }
    $("input.searchbar").focus();
  });

});
