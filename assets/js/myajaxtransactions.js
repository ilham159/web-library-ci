$(function() {

  $('.tombolTambahData').on('click', function(){
    $('#formModalLabel').html('Input Student');
    $('.modal-footer button[type=submit]').html('Insert Data');
  });

  $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Input Student');
        $('.modal-footer button[type=submit]').html('Input Data');
        $('#id_transactions').val('');
        $('#transaction_date').val('');
        $('#transaction_total').val('');
        $('#id_operator').val('');
        $('#id_borrowing').val('');
        $('#status').val('');
    });

  $('.tampilModalUbah').on('click', function(){
    $('#formModalLabelEdit').html('Edit Student');
    $('.modal-footer button[type=submit]').html('Update Data');

    const id = $(this).data('id');

    $.ajax({
      url: 'getEdit',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#id_transactions').val(data.id_transactions);
        $('#transaction_date').val(data.transaction_date);
        $('#transaction_total').val(data.transaction_total);
        $('#id_operator').val(data.id_operator);
        $('#id_borrowing').val(data.id_borrowing);
         $('#status').val(data.status);
      }
    })
  });
});