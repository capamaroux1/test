<div class="row">
  <div class="col-md-12 mb-3">
    <a class="pr-4" href="<?= route('/') ?>">Return</a> <h5 class="mb-0">New application</h5>
  </div>     
  <div class="col-md-12">
    <form data-parsley-validate action="<?= route('applications/store') ?>" method="POST">
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="vacation_range">Vacation Start *</label>
          <input type="text" class="form-control bg-white" id="vacation_start" name="vacation_start" value="<?php echo escape(Input::old('vacation_start')); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="vacation_end">Vacation End *</label>
          <input type="text" class="form-control bg-white" id="vacation_end" name="vacation_end" value="<?php echo escape(Input::old('vacation_end')); ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label for="reason">Reason *</label>
        <textarea name="reason" class="form-control" id="reason" required rows="2" maxlength="755"><?php echo escape(Input::old('reason')); ?></textarea>
      </div>
      <div class="text-right">
        <button class="btn btn-primary" type="submit">Create</button>
      </div>
    </form>    
  </div>  
</div>

<?php

$extra_js = "
$( function() {
  const vacation_start = flatpickr('#vacation_start', {
    altInput: true,
    altFormat: 'F j, Y',
    minDate: 'today',
    onChange: function(selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        vacation_end.set('minDate', dateStr);
      }
    }    
  });

  const vacation_end = flatpickr('#vacation_end', {
    altInput: true,
    altFormat: 'F j, Y',
    minDate: 'today',
  });  
});";
?>
