$(function() {

  $('.tombolTambahData').on('click', function(){
    $('#formModalLabel').html('Input Student');
    $('.modal-footer button[type=submit]').html('Insert Data');
  });

  $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Input Student');
        $('.modal-footer button[type=submit]').html('Input Data');
        $('#id').val('');
        $('#nim').val('');
        $('#name').val('');
        $('#gender').val('');
        $('#semester').val('');
        $('#id_major').val('');
        $('#phone').val('');
        $('#address').val('');
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
        $('#id_students').val(data.id_students);
        $('#nim').val(data.nim);
        $('#name').val(data.name);
        $('#gender').val(data.gender);
        $('#semester').val(data.semester);
        $('#id_major').val(data.id_major);
        $('#phone').val(data.phone);
        $('#address').val(data.address);
      }
    })
  });
});