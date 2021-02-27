$(function() {

  $('.tombolTambahData').on('click', function(){
    $('#formModalLabel').html('Input Student');
    $('.modal-footer button[type=submit]').html('Insert Data');
  });

  $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Input Student');
        $('.modal-footer button[type=submit]').html('Input Data');
        $('#id').val('');
        $('#nama').val('');
        $('#nrp').val('');
        $('#email').val('');
        $('#jurusan').val('');
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
        $('#id_operators').val(data.id_operators);
        $('#nim').val(data.nim);
        $('#name').val(data.name);
        $('#gender').val(data.gender);
        $('#phone').val(data.phone);
        $('#address').val(data.address);
      }
    })
  });
});