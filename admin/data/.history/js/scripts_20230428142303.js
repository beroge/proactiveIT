$(function() {
  $('#recordListing tbody tr:even').addClass('tint');
});
$(document).ready(function() {
  $('#recordModal').on('show.bs.modal', function () {
    $('#amount').val('');
  });
});

