<?php include_once('includes/header.php'); ?>

<main class="px-3">
    <?php if(Session::exists('home')) { ?>
    <p class="lead"><?php echo Session::flash('home'); ?></p>
    <?php } ?>
    <h1>Fleet Management System</h1>
    <p class="lead">A simple system for fleet management.</p>
    <p class="lead">
        <?php
            if($user->isLoggedIn() && Session::get('group') == 'Admin') { 
            ?>
    <p>You're an Admin</p>
    <?php } ?>
    <a href="fleet.php" class="btn btn-lg btn-secondary fw-bold border-white bg-dark">See Fleets</a>
    </p>
</main>

<?php include_once('includes/footer.php'); ?>