$(function() {
  $('#recordListing tbody tr:even').addClass('tint');
});
$(document).ready(function() {
  $('#record').on('show.bs.modal', function () {
    $('#amount').val('');
  });
});

