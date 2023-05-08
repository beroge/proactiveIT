$(function() {
  $('#recordListing tbody tr:even').addClass('tint');
});
$('#recordModal').on('shown.bs.modal', function () {
  $('#amount').val('');
});
