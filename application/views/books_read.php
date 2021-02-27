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
          <button class="btn btn-success"  width="10%" href="#modal_add_new" rowspan="2"  class="tooltip-info" data-toggle="modal" data-rel="tooltip" title="Tambah" class="tombolTambahData">
              <span class="white">
                <i class="fa fa-pen"></i>
                  Books
              </span>
            </button>
            </h6>
<br /><br />

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Books</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered" color="green" width="100%" cellspacing="0" >
	<thead color="blue" class="thead-dark">
		<tr>
			<th>Books_Name</th>
			<th>Author Name</th>
			<th>Quantity</th>
			<th>Year</th>
            <th>shelf_name</th>
			<th>Images</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_books as $books):?>
		<tr>
			<td><?php echo $books['title'];?></td>
			<td><?php echo $books['author'];?></td>
			<td><?php echo $books['quantity'];?></td>
			<td><?php echo $books['year'];?></td>
            <td><?php echo $books['shelf_name'];?></td>
			<td><img src="../upload_images/<?php echo $books['file_name'];?>" width="70px"></td>
			<td> 
			 	<a href="books/read/<?php echo $books['id_books'];?>" data-id="<?php echo $books['id_books'];?>" data-toggle="modal" data-target="#modal_add_new" class="fa fa-edit tampilModalUbah"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="<?php echo site_url('books/delete/'.$books['id_books']);?>" class="fa fa-trash button-delete"></a>
				<a href="<?php echo site_url('books/export1/'.$books['id_books']);?>" class="fa fa-print"></a>
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
                Input Books
            </div>
        </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('books/insert_submit/');?>" enctype="multipart/form-data">
                <div class="modal-body">
                     <input type="text" name="id_books" id="id_books">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Book Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Book Name..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Author Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="author" id="author" placeholder="Author Name..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Quantity</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Type Quantity here..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Year</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="year" id="year" placeholder="Type year here..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Shelf Name</label>
                        <div class="col-xs-8">
                             <select class="chosen-select form-control" name="id_shelf" id="id_shelf" class="form-control" >
                                <option value="">- - select - -</option>
                                <?php foreach($data_books1 as $data):?> 
                                <option value="<?php echo $data['id_shelfs'];?>"><?php echo $data['shelf_name'];?></option>
                                <?php endforeach;?>
                             </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Image</label>
                        <div class="col-xs-8">
                            <input type="file" name="userfile" id="userfile" required>
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

<a href="<?php echo site_url('books/export');?>">Export</a>

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
<!-- Load file ajax.js yang ada di folder js -->
<script src="<?php echo base_url('assets/js/myajaxbooks.js');?>"></script>
</html>