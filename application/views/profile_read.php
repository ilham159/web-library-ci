<div class="card" style="max-width: 5400px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <?php foreach($data as $data_user):?>
      <img src="upload_images/profile/<?php echo $data_user['image'];?>" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
         <table class="table">
              <tr>
                <th scope="col">Nama</th>
                <td><h5 class="card-text">: <?php echo $data_user['username'];?></h5></td>               
              </tr>
              <tr>
                <th scope="col">Email</th>                
                <td><h5 class="card-title">: <?php echo $data_user['email'];?></h5></td>                
              </tr>
              <tr>
                <th scope="col">Status</th>               
                <td><h5 class="card-title">: <?php echo $data_user['role'];?></h5></td>               
              </tr>
              <tr>
                <th scope="col">image</th>                 
                <td><h5 class="card-title">: <?php echo $data_user['image'];?></h5></td>                
              </tr>
          </table>
          <?php endforeach?>
      </div>
    </div>
  </div>
</div>