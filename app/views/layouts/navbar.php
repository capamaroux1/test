<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand flex-grow-1" href="<?= route('/') ?>">Home</a>

  <span class="name-header">
    <?= Auth::user()->fullName() ?>
    <br><small><?= Auth::user()->email() ?></small>
  </span>
  <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    Logout
  </a>

  <form id="logout-form" class="d-none" method="POST" action="<?= route('logout') ?>">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  </form>  
</nav>