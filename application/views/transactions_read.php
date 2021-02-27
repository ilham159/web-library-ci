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
           Data Transaction <strong>successfully <?php echo $this->session->flashdata('flash');?> by <?php echo $data_user['username'];?>.</strong>
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
                <i class="fa fa-pen"></i>
                  transactions
              </span>
            </button>
            </h6>
<br /><br />

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables transactions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered" color="green" width="100%" cellspacing="0" >
	<thead color="blue" class="thead-dark">
		<tr>
      <th>Id</th>
			<th>transactions Date</th>
			<th>transactions Total</th>
			<th>Operator_name</th>
      <th>Id Borrowing</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_transactions as $transactions):?>
		<tr>
      <td><?php echo $transactions['id_transactions'];?></td>
			<td><?php echo $transactions['transaction_date'];?></td>
			<td><?php echo $transactions['transaction_total'];?></td>
			<td><?php echo $transactions['name'];?></td>
      <td><?php echo $transactions['id_borrowing'];?></td>
			<td> 
				<a href="<?php echo site_url('transactions/delete/'.$transactions['id_transactions']);?>" class="fa fa-trash button-delete"></a>
				<a href="<?php echo site_url('transactions/export1/'.$transactions['id_transactions']);?>" class="fa fa-print"></a>
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
                Input transactions
            </div>
        </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('transactions/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_transactions" id="id_transactions">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Transactions Date</label>
                        <div class="col-xs-8">
                            <input type="date" class="form-control" name="transaction_date" id="transaction_date" value="<?=date('Y-m-d')?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Transactions Total</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="transaction_total" id="transaction_total" placeholder="Type Total Here..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Operator Name</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_operator" id="id_operator" class="form-control">
                             	<option value="">- - select - -</option>
                                <?php foreach($data_transactions1 as $data):?> 
                								<option value="<?php echo $data['id_operators'];?>"><?php echo $data['name'];?></option>
                								<?php endforeach;?>
                             </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Id Borrowing</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_borrowing" id="id_borrowing" class="form-control">
                              <option value="">- - select - -</option>
                                <?php foreach($data_transactions2 as $data):?> 
                                <option><?php echo $data['id_borrowings'];?></option>
                                <?php endforeach;?>
                             </select>
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

<a href="<?php echo site_url('transactions/export');?>">Export</a>

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
</script>
<script src="<?php echo base_url('assets/js/myalert.js');?>"></script>
<script src="<?php echo base_url('assets/js/myajaxtransactions.js');?>"></script>
<!-- Load file ajax.js yang ada di folder js -->
</html>