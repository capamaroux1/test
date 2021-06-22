<div class="col-sm-12 mb-3">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <h3>TEST APP</h3>
      <div class="card">       
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form data-parsley-validate method="POST">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address *</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email" required="" value="<?php echo escape(Input::old('email')); ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password *</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" required="" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary">Log in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>