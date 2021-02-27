<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $judul?></title>
	 <style type="text/css">
        h1 {
            background-color: orange;
        }

        a {
            background-color: gray;
        }

        th {
        	background-color: lime;
        }
 
        td {
            background-color: purple;
        }
 
        option {
            background-color: green;
        }
    </style>
</head>
<body>

<h1><?php echo $judul?></h1>

<a href="<?php echo site_url('books/insert');?>">Tambah</a>
<br /><br />

<table border="1">
	<thead>
		<tr>
			<th>Books Name</th>
			<th>Category Name</th>
			<th>Publisher Name</th>
			<th>Stock</th>
			<th>Images</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_books as $books):?>
		<tr>
			<td><?php echo $books['book_name'];?></td>
			<td><?php echo $books['category_name'];?></td>
			<td><?php echo $books['publisher_name'];?></td>
			<td><?php echo $books['book_stock'];?></td>
			<td><img src="../upload_images/<?php echo $books['file_name'];?>" width="70px"></td>
			<td>
				<a href="<?php echo site_url('books/update/'.$books['id_book']);?>">
				Update
				</a>
				|
				<a href="<?php echo site_url('books/delete/'.$books['id_book']);?>" onclick="return confirm('Delete Data?');">
				Delete
				</a>
				|
				<a href="<?php echo site_url('books/export1/'.$books['id_book']);?>">
				Export
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>
<a href="<?php echo site_url('books/image');?>">Input Image</a>
|
<a href="<?php echo site_url('books/export');?>">Export</a>


</body>
</html>