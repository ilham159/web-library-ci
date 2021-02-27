<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<title><?php echo $judul?></title>

<?php if ($this->session->flashdata('flash')):?>
<div class="row mt-3">
    <div class="col-lg-12">     
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           Data Operator <strong>successfully <?php echo $this->session->flashdata('flash');?>.</strong>
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
                <i class="fa fa-pen"></i>
                  Operators
              </span>
            </button>
            </h6>
<br /><br />

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Operators</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered" color="green" width="100%" cellspacing="0" >
	<thead color="blue" class="thead-dark">
		<tr>
            <th>Nim</th>
			<th>operators Name</th>
			<th>Gender</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_operators as $operators):?>
		<tr>
			<td><?php echo $operators['nim'];?></td>
			<td><?php echo $operators['name'];?></td>
            <td><?php if ($operators['gender'] == 'L') {
                    echo('Male');
                }else{
                    echo ('Female');
                } ?>
            </td>
            <td><?php echo $operators['phone'];?></td>
            <td><?php echo $operators['address'];?></td>
			<td> 
			 	<a href="operators/read/<?php echo $operators['id_operators'];?>" data-id="<?php echo $operators['id_operators'];?>" data-toggle="modal" data-target="#modal_add_new" class="fa fa-edit tampilModalUbah"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="<?php echo site_url('operators/delete/'.$operators['id_operators']);?>" class="fa fa-trash button-delete"></a>
				<a href="<?php echo site_url('operators/export1/'.$operators['id_operators']);?>" class="fa fa-print"></a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
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
                Input operators
            </div>
        </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('operators/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_operators" id="id_operators">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nim</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="nim" id="nim" placeholder="Your Nim..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Gender</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="gender" id="gender" class="form-control">
                                <option value="">- - select - -</option>
                                <option value="L">Male</option>
                                <option value="P">Female</option>
                             </select>
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
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn btn-white btn-info btn-bold" type="submit" name="submit" id="submit">
			          <i class="ace-icon fa fa-pen blue"></i> Input Data</button>
			        <button class="btn btn-white btn-danger btn-round" type="reset">
			          <i class="fa fa-spinner "></i> Reset</button>
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

<a href="<?php echo site_url('operators/export');?>">Export</a>

<script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').DataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": true,
    "pageLength": 5 });
} );

$(function(){

// none, bounce, rotateplane, stretch, orbit, 
// roundBounce, win8, win8_linear or ios
var current_effect = 'bounce'; // 

$('#tanbah').click(function(){
run_wait(current_effect);
});

function run_wait(effect){
$('#SELECTOR').wait({

//none, rotateplane, stretch, orbit, roundBounce, win8, 
//win8_linear, ios, facebook, rotation, timer, pulse, 
//progressBar, bouncePulse or img
effect: 'stretch',

//place text under the effect (string).
text: '',

//background for container (string).
bg: 'rgba(255,255,255,0.7)',

//color for background animation and text (string).
color: '#000',

//max size
maxSize: '',

//wait time im ms to close
waitTime: -1,

//url to image
source: '',

//or 'horizontal'
textPos: 'vertical',

//font size
fontSize: '',

// callback
onClose: function() {}

});
}
  
});
</script>
<script src="<?php echo base_url('assets/js/myalert.js');?>"></script>
<script src="<?php echo base_url('assets/js/myajaxoperators.js');?>"></script>
<!-- Load file ajax.js yang ada di folder js -->
</html>