$(function() {

  $('.tombolTambahData').on('click', function(){
    $('#formModalLabel').html('Input Student');
    $('.modal-footer button[type=submit]').html('Insert Data');
  });

  $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Input Books');
        $('.modal-footer button[type=submit]').html('Input Data');
        $('#id').val('');
        $('#title').val('');
        $('#author').val('');
        $('#quantity').val('');
        $('#year').val('');
        $('#id_shelf').val('');
        $('#userfile').val('');
    });

  $('.tampilModalUbah').on('click', function(){
    $('#formModalLabelEdit').html('Edit Books');
    $('.modal-footer button[type=submit]').html('Update Data');

    const id = $(this).data('id');

    $.ajax({
      url: 'getEdit',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#id_books').val(data.id_books);
        $('#title').val(data.title);
        $('#author').val(data.author);
        $('#quantity').val(data.quantity);
        $('#year').val(data.year);
        $('#id_shelf').val(data.id_shelf);
        $('#userfile').val(data.userfile);
      }
    })
  });
});