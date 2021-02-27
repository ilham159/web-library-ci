<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<title><?php echo $judul?></title>

<?php if ($this->session->flashdata('flash')):?>
<div class="row mt-3">
    <div class="col-lg-12">     
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?php foreach($data as $data_user):?>
           Data Student <strong>successfully <?php echo $this->session->flashdata('flash');?> by <?php echo $data_user['username'];?>.</strong>
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
            <button class="btn btn-primary" onclick="reload_table()"><span class="white"><i class="fa fa-refresh fa-spin"></i></span> Reload</button>
          <button class="btn btn-success"  width="10%" href="#modal_add_new" rowspan="2"  class="tooltip-info" data-toggle="modal" data-rel="tooltip" title="Tambah" class="tombolTambahData">
              <span class="white">
                <i class="fa fa-spinner fa-spin"></i>
                  Students
              </span>
            </button>
            </h6>
<br /><br />


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table id="table" class="table table-striped table-bordered" color="green" width="100%" cellspacing="0" >
	<thead color="blue" class="thead-dark">
		<tr>
            <th>No</th>
            <th>Nim</th>
			<th>Students Name</th>
			<th>Gender</th>
			<th>Semester</th>
            <th>Major</th>
			<th>Phone</th>
			<th>Address</th>
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
                Input Students
            </div>
        </div>
            <form class="form-horizontal" method="post" id="form" action="<?php echo site_url('students/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_students" id="id_students">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nim</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="nim" id="nim" placeholder="Your Nim..." required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name..." required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Gender</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="gender" id="gender" class="form-control">
                                <option value="">- - select - -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                             </select>
                             <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Semester</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="semester" id="semester" placeholder="Your Semester..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Major</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_major" id="id_major" class="form-control">
                             	<option value="">- - select - -</option>
                                <?php foreach($data_students1 as $data):?> 
								<option value="<?php echo $data['id_major'];?>"><?php echo $data['major_name'];?></option>
								<?php endforeach;?>
                             </select>
                             <span class="help-block"></span>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Phone</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Address</label>
                        <div class="col-xs-8">
                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Type your address here..." cols="40" rows="5" required></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn btn-white btn-info btn-bold" type="submit" name="submit" id="submit">
			          <i class="fa fa-circle-o-notch fa-spin"></i> Input Data</button>
			        <button class="btn btn-white btn-danger btn-round" type="reset">
			          <i class="fa fa-spinner fa-spin "></i> Reset</button>
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

<!-- ============ MODAL ADD Books =============== -->



        <div class="modal fade" id="modal_add_edit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-padding">
            <div class="table-header" id="formModalLabel">
                Edit Students
            </div>
        </div>
            <form class="form-horizontal" method="post" id="form" action="<?php echo site_url('students/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_students" id="id_students">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nim</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="nim" id="nim" placeholder="Your Nim..." required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name..." required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Gender</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="gender" id="gender" class="form-control">
                                <option value="">- - select - -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                             </select>
                             <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Semester</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="semester" id="semester" placeholder="Your Semester..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Major</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_major" id="id_major" class="form-control">
                                <option value="">- - select - -</option>
                                <?php foreach($data_students1 as $data):?> 
                                <option value="<?php echo $data['id_major'];?>"><?php echo $data['major_name'];?></option>
                                <?php endforeach;?>
                             </select>
                             <span class="help-block"></span>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Phone</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Address</label>
                        <div class="col-xs-8">
                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Type your address here..." cols="40" rows="5" required></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn btn-white btn-info btn-bold" type="submit" name="submit" id="submit">
                      <i class="fa fa-circle-o-notch fa-spin blue"></i> Edit Data</button>
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

<a href="<?php echo site_url('students/export');?>">Export</a>

<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                "url": "<?php echo site_url('students/datatables')?>",
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
 
function edit_student(id)
{
     
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('students/getEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id_students"]').val(data.id_students);
            $('[name="nim"]').val(data.nim);
            $('[name="name"]').val(data.name);
            $('[name="gender"]').val(data.gender);
            $('[name="semester"]').val(data.semester);
            $('[name="id_major"]').val(data.id_major);
            $('[name="phone"]').val(data.phone);
            $('[name="address"]').val(data.address);
 
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
            url : "<?php echo site_url('students/delete')?>/"+id,
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
</html>