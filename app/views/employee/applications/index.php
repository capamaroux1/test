<div class="row">
  <div class="col-md-12">
    <div class="d-flex mb-3">
      <div class="flex-grow-1 h4 mb-0">Past applications</div>
      <div><a class="btn btn-sm btn-primary" href="<?= route('applications/create') ?>">Submit request</a></div>
    </div>    
  </div>     
	<div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Date submitted</th>
            <th scope="col">Dates requested (vacation start - vacation end)</th>
            <th scope="col">Days requested</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($applications) > 0){ 
            foreach ($applications as $key => $row) {
          ?>
            <tr>
              <td><?= $row->getCreatedAt() ?></td>
              <td><?= $row->getVacationStart() ?> - <?= $row->getVacationEnd() ?></td>
              <td><?= Date::diff($row->getVacationStart(), $row->getVacationEnd()) ?></td>
              <td class="text-capitalize"><?= $row->getStatus() ?></td>
            </tr>
          <?php    
              }
            } else { ?>
          <tr>
            <td colspan="4">No records</td>       
          </tr>
          <?php } ?>
        </tbody>
      </table>        
	  </div>	
  </div>  
</div>
