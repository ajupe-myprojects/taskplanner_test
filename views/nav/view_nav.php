<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#">Navbar</a> 
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="/home" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">User</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Statistics</a>
        </li>
        <?php if(!App\helpers\Auth::is_user()) : ?>
            <li class="nav-item">
                <a href="/login_start" class="nav-link">Login</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a href="/logout" class="nav-link">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>