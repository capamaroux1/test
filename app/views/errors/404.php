<div class="col-sm-12 mb-3">
  <div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <h1 class="text-uppercase">404</h1>
      <h3 class="text-uppercase">Page Not Found!</h3>
      <?php if (Auth::check()) { ?>
      <a href="<?= route('/') ?>">Return to home</a>
      <?php } ?>
    </div>
  </div>
</div>             
