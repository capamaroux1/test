<div class="row">
  <div class="col-md-12">
    <div class="d-flex mb-3">
      <div class="flex-grow-1 h4 mb-0">Users</div>
      <div><a class="btn btn-sm btn-primary" href="<?= route('users/create') ?>">Create user</a></div>
    </div>    
  </div>     
	<div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $key => $row) { 
            ?>
            <tr>
              <td><?= $row->getFirstName() ?></td>
              <td><?= $row->getLastName() ?></td>
              <td><?= $row->getEmail() ?></td>
              <td class="text-capitalize"><?= $row->getType() ?></td>
              <td>
                <a href="<?= route('users/'.$row->getId().'/edit') ?>">Edit</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>        
	  </div>	
  </div>  
</div>
