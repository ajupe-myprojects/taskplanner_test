<div>
    <?php if(isset($no_user)) : ?>
        <p>
            You are not logged in, please log in!
        </p>
        <a href="/login_start">Login</a><br>
        <a href="/signup">signup</a>
    <?php else : ?>
    Test
    <?php var_dump($_SESSION['login']['u_mail']); ?>
    <?php endif; ?>
</div>