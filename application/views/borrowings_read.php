<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<title><?php echo $judul?></title>
        <style>
            .tengah{
                text-align:center;
            }
            .kiri{
                text-align:left;
            }
            .kanan{
                text-align:right;
            }
        </style>

<?php if ($this->session->flashdata('flash')):?>
<div class="row mt-3">
    <div class="col-lg-12">     
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?php foreach($data as $data_user):?>
           Data borrowing <strong>successfully <?php echo $this->session->flashdata('flash');?> by <?php echo $data_user['username'];?>.</strong>
           <?php endforeach?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    </div>
</div>
<?php endif; ?>


<h1><?php echo $judul?></h1>

          <h6 align="right">
          <button class="btn btn-success"  width="10%" href="#modal_add_new" rowspan="2"  class="tooltip-info" data-toggle="modal" data-rel="tooltip" title="Tambah" class="tombolTambahData">
              <span class="white">
                <i class="fa fa-spinner fa-spin"></i>
                  borrowings
              </span>
            </button>
            </h6>
<br /><br />

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables borrowings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table id="table" class="table table-striped table-bordered" color="green" width="100%" cellspacing="0" >
	<thead color="blue" class="thead-dark">
		<tr>
            <th>No</th>
            <th>Id</th>
            <th>Dates</th>
            <th>Limits</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Book Name</th>
            <th>Book Image</th>
            <th>Students Name</th>
            <th>Action</th>
		</tr>
	</thead>
</table>
              </div>
            </div>
          </div>

<!-- ============ MODAL ADD Books =============== -->



        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            	<div class="modal-header no-padding">
            <div class="table-header" id="formModalLabel">
                Input borrowings
            </div>
        </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('borrowings/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_borrowings" id="id_borrowings">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Dates</label>
                        <div class="col-xs-8">
                            <input type="date" class="form-control" name="dates" id="dates" value="<?=date('Y-m-d')?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Limits</label>
                        <div class="col-xs-8">
                            <input type="date" class="form-control" name="limit" id="limit" value="<?=date('Y-m-d')?>" required>
                        </div>
                    </div>

                            <input type="hidden" class="form-control" name="quantity_b" id="quantity_b" value="1" class="form-control">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status</label>
                        <div class="col-xs-8">
                            <select class="chosen-select form-control" name="id_status" id="id_status" class="form-control">
                                <option value="">- - select - -</option>
                                <option value="1">Borrowed</option>
                                <option value="2">Returned</option>
                             </select>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Book Name</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_book" id="id_book" class="form-control">
                             	<option value="">- - select - -</option>
                                <?php foreach($data_borrowings1 as $data):?> 
								<option value="<?php echo $data['id_books'];?>"><?php echo $data['title'];?></option>
								<?php endforeach;?>
                             </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Students Name</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_student" id="id_student" class="form-control">
                                <option value="">- - select - -</option>
                                <?php foreach($data_borrowings2 as $data):?> 
                                <option value="<?php echo $data['id_students'];?>"><?php echo $data['name'];?></option>
                                <?php endforeach;?>
                             </select>
                        </div>
                    </div>                    
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn btn-white btn-info btn-bold" type="submit" name="submit" id="submit">
                      <i class="fa fa-circle-o-notch fa-spin blue"></i> Input Data</button>
                    <button class="btn btn-white btn-danger btn-round" type="reset">
                      <i class="fa fa-spinner fa-spin"></i> Reset</button>
                    <button class="btn btn-white btn-primary disabled btn-round" data-dismiss="modal" aria-hidden="true">
                      <i class="fa fa-minus-circle"></i> Close</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modal_add_edit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-padding">
            <div class="table-header" id="formModalLabel">
                Edit borrowings
            </div>
        </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('borrowings/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Id_borrowing</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="id_borrowings" id="id_borrowings" required>
                        </div>
                    </div>

                            <input type="hidden" class="form-control" name="dates" id="dates" value="<?=date('Y-m-d')?>" required>

                            <input type="hidden" class="form-control" name="limit" id="limit" value="<?=date('Y-m-d')?>" required>

                            <input type="hidden" class="form-control" name="quantity_b" id="quantity_b" value="0" class="form-control">

                            <input type="hidden" class="form-control" name="id_status" id="id_status" value="2" class="form-control">
 
                            <input type="hidden" class="form-control" name="id_book" id="id_book" class="form-control">

                            <input type="hidden" class="form-control" name="id_student" id="id_student" class="form-control">                    
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn btn-white btn-info btn-bold" type="submit" name="submit" id="submit">
                      <i class="fa fa-circle-o-notch fa-spin blue"></i> Return Book</button>
                    <button class="btn btn-white btn-danger btn-round" type="reset">
                      <i class="fa fa-spinner fa-spin"></i> Reset</button>
                    <button class="btn btn-white btn-primary disabled btn-round" data-dismiss="modal" aria-hidden="true">
                      <i class="fa fa-minus-circle"></i> Close</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD BARANG-->

        <!-- /.container-fluid -->

        <!-- /.container-fluid -->

<div class="modal-footer">
<form action="<?php echo site_url('borrowings/export/');?>">
<button class="btn btn-white btn-info btn-bold" type="submit" name="" id="submit">
  <i class="fa fa-circle-o-notch fa-spin"></i> Export as EXCEL</button>
</form>
<form action="<?php echo site_url('borrowings/export_pdf/');?>">
<button class="btn btn-white btn-info btn-bold" type="submit" name="" id="submit">
  <i class="ace-icon fa fa-print faa-vertical animated"></i> Export as PDF</button>
</form>
</div>

<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">

<script type="text/javascript">
    var save_method; //for save method string
    var table;
    jQuery(document).ready(function() {
        table = $('#table').DataTable({ 
 
            oLanguage: {
              sProcessing: "tunggu sebentar",
              sInfo: "total data adalah _TOTAL_ data yang ditampilkan (_START_ sampai _END_)",
              oPaginate: {
                sNext: "halaman selanjutnya",
                sPrevious: "halaman sebelumnya"
               }
            },
            "processing": true, 
            "serverSide": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": true,
            "pageLength": 5,
            "order": [], 
            "ajax": {
                "url": "<?php echo site_url('borrowings/datatables')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false,
            },
            ],
        });
    });
 
function edit_borrowing(id)
{
     
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('borrowings/getEdit/')?>/" +id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id_borrowings"]').val(data.id_borrowings);
            $('[name="dates"]').val(data.dates);
            $('[name="lmit"]').val(data.limit);
            $('[name="id_book"]').val(data.id_book);
            $('[name="id_student"]').val(data.id_student);
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function delete_borrowing(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('borrowings/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
</script>
<script src="<?php echo base_url('assets/js/myalert.js');?>"></script>
<!-- Load file ajax.js yang ada di folder js -->
<script src="<?php echo base_url('assets/js/myalert.js');?>"></script>
<script src="<?php echo base_url('assets/js/myajaxborrowings.js');?>"></script>
<!-- Load file ajax.js yang ada di folder js -->
</html>