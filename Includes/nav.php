<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Naam</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto nav nav-underline">
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">home</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'AboutUs.php') ? 'active' : ''; ?>">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'AboutUs.php') ? 'active' : ''; ?>" href="AboutUs.php">over ons</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'AuctionTest.php') ? 'active' : ''; ?>">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'AuctionTest.php') ? 'active' : ''; ?>" href="AuctionTest.php">veiling</a>
                </li>
            </ul>
        </div>
        <div class="btn-group ms-auto">
            <button type="button" class="btn btn-secondary">
                <a href="Login/login-user.php" style="text-decoration: none; color: inherit;">Login</a>
            </button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="Login/register.php">Register</a></li>
                <li><a class="dropdown-item" href="#">iets 2</a></li>
                <li><a class="dropdown-item" href="#">hier is een menu keuze optie</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php
// Start the session
session_start();

// Check if the 'user_id' session variable is set
if (isset($_SESSION['user_id'])) {
    // User is logged in
    echo "User is logged in. User ID: " . $_SESSION['user_id'];
} else {
    // User is not logged in
    echo "User is not logged in";
}
?>


