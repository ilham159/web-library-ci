$(function() {

  $('.tombolTambahData').on('click', function(){
    $('#formModalLabel').html('Input Student');
    $('.modal-footer button[type=submit]').html('Insert Data');
  });

  $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Input Student');
        $('.modal-footer button[type=submit]').html('Input Data');
        $('#id_borrowings').val('');
        $('#dates').val('');
        $('#limit').val('');
        $('#quantity_b').val('');
        $('#title').val('');
        $('#name').val('');
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
        $('#id_borrowings').val(data.id_borrowings);
        $('#dates').val(data.dates);
        $('#limit').val(data.limit);
        $('#quantity_b').val(data.quantity_b);
        $('#id_book').val(data.id_book);
        $('#id_student').val(data.id_student);
      }
    })
  });
});