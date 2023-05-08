$(function () {
  $("#recordListing tbody tr:even").addClass("tint");
});
$(document).ready(function () {
  $("#recordListing").on("show.bs.modal", function () {
    $("#amount").val("");
  });


});
