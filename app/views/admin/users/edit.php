<div class="row">
  <div class="col-md-12 mb-3">
    <a class="pr-4" href="<?= route('/') ?>">Return</a> <h5 class="mb-0">Edit user</h5>
  </div>     
  <div class="col-md-12">
    <form data-parsley-validate action="<?= route('users/'.$user->getId().'/update') ?>" method="POST">
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="first_name">First Name *</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo escape(Input::old('first_name', $user->getFirstName())); ?>" required maxlength="30">
        </div>
        <div class="col-md-4 mb-3">
          <label for="last_name">Last Name *</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo escape(Input::old('last_name', $user->getLastName())); ?>"  required maxlength="30">
        </div>
        <div class="col-md-4 mb-3">
          <label for="email">Email *</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo escape(Input::old('email', $user->getEmail())); ?>" required maxlength="155">
        </div>   
        <div class="col-md-4 mb-3">
          <label for="type">Type *</label>
          <select name="type" required="" class="form-control">
            <option value="">-</option>
            <?php
              $oldInput = Input::old('type', $user->getType());

              foreach($types as $type) {
                echo "<option ". (($oldInput === $type) ? ' selected ' : '') ." value='{$type}'>{$type}</option>";
              }
            ?>
          </select>
        </div> 
        <div class="col-md-4 mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" maxlength="30" autocomplete="off">
        </div>  
        <div class="col-md-4 mb-3">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" data-parsley-equalto="#password" id="confirm_password" name="confirm_password" maxlength="30" autocomplete="off">
        </div>                            
      </div>
      <div class="text-right">
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>    
  </div>  
</div>

