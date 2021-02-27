<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                  </div>  

                  <?php echo $this->session->flashdata('message') ?>

                  <form class="user" method="post" action="<?php echo base_url('auth');?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?php echo set_value('email');?>"><?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password"><?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <a href="#" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                    <a href="#" class="btn btn-info btn-user btn-block" data-toggle="modal" data-target="#myModalLogin">
                      <i class="fa fa-print fa-fw"></i> User Accounts
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('Auth/register');?>">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Modal -->
  <div id="myModalLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <div class="table-header" id="formModalLabel">
                temporary accounts
          </div>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Username : ilham</li>
            <li class="list-group-item">Gmail : dykiganteng1st@gmail.com</li>
            <li class="list-group-item">Password: dykiganteng123</li>
          </ul>
          <hr>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Username : rahmat</li>
            <li class="list-group-item">Gmail : ilhamdyki12345@gmail.com</li>
            <li class="list-group-item">Password: dykiganteng123</li>
          </ul>
          <hr>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Username : M.Beryl Boran Akbar</li>
            <li class="list-group-item">Gmail : blacktrigger27@gmail.com</li>
            <li class="list-group-item">Password: beryl12345</li>
          </ul>
          <hr>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Username : Daniel Sihombing</li>
            <li class="list-group-item">Gmail : danielsihombing2602@gmail.com</li>
            <li class="list-group-item">Password: daniel12345</li>
          </ul>
        <!-- footer modal -->
        <div class="modal-footer">
          <button class="btn btn-white btn-primary disabled btn-round" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-minus-circle"></i> Close</button>
        </div>
      </div>
    </div>
  </div>
   </div>
</body>

</html>
