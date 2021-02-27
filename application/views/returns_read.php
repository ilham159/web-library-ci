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

<h1><?php echo $judul?></h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables returns</h6>
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

<div class="modal-footer">
<form action="<?php echo site_url('returns/export/');?>">
<button class="btn btn-white btn-info btn-bold" type="submit" name="" id="submit">
  <i class="fa fa-circle-o-notch fa-spin"></i> Export as EXCEL</button>
</form>
<form action="<?php echo site_url('returns/export_pdf/');?>">
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
                "url": "<?php echo site_url('returns/datatables')?>",
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
</script>
<!-- Load file ajax.js yang ada di folder js -->
</html>