<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $judul?></title>
</head>
<body>

<h1><?php echo $judul?></h1>


<form method="post" action="<?php echo site_url('books/insert_submit/');?>" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Category</td>
			<!--$data_kota_single['nama'] : menampilkan data kota yang dipilih dari database -->
			<td>
				<select name="category">
				<?php foreach($data_books1 as $data):?> 
				<option value="<?php echo $data['id_category'];?>"><?php echo $data['category_name'];?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Publisher</td>
			<!--$data_kota_single['nama'] : menampilkan data kota yang dipilih dari database -->
			<td>
				<select name="publisher">
				<?php foreach($data_books2 as $data):?>
				<option value="<?php echo $data['id_publisher'];?>"><?php echo $data['publisher_name'];?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Book</td>
			<td><input type="text" name="book_name" value="" required=""></td>
		</tr>
		<tr>
            <td>Stock</td>
            <!--$data_provinsi_single['nama'] : menampilkan data provinsi yang dipilih dari database -->
            <td><input type="text" name="stock" value="" required=""></td>
        </tr>
        <tr>
			<td>File</td>
			<td>
				<!--input untuk memilih file yang akan diupload-->
				<input type="file" name="userfile" size="20" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Save"></td>
		</tr>
	</table>
</form>

</body>
</html>