<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/jquery.toast.min.css') ?>" />
    <link rel="stylesheet" href="<?= asset('vendor/flatpickr/dist/flatpickr.min.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/custom.css') ?>?v=1.2" />
  </head>
  <body>
    <?php 
      if (Auth::check()) {
        include('navbar.php'); 
      }
    ?>

    <main role="main" class="mt-5">
      <div class="container">
        <?php
          if ($path) {
            require_once($path);
          }
        ?>
      </div>
    </main>

    <script src="<?= asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset('js/jquery.toast.min.js') ?>"></script> 
    <script src="<?= asset('js/parsley.min.js') ?>"></script>
    <script src="<?= asset('vendor/flatpickr/dist/flatpickr.min.js') ?>"></script>
    <script src="<?= asset('js/custom.js') ?>"></script>

    <script>
    <?php if (isset($extra_js)) {
        echo $extra_js;
      }
    ?>

    $( function() {
      <?php if (Session::exists('success')) { ?>
        showToast('<?php echo Session::flash('success'); ?>', 'success')
      <?php } elseif (Session::exists('error')) { ?>
        showToast('<?php echo Session::flash('error'); ?>', 'error')
      <?php } ?>
    });
   </script>
  </body>
</html>
