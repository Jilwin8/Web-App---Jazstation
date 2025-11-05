<!-- NAVBAR -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand linktest" href="home.php">JazStation</a>
        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link linktest" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link linktest" href="products.php">Games</a></li>
                <li class="nav-item"><a class="nav-link linktest" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link linktest" href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- If user is logged in -->
                    <li class="nav-item">
                        <a class="nav-link linktest" href="cart.php">🛒 Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linktest" href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user_name']); ?>)</a>
                    </li>
                <?php else: ?>
                    <!-- If user is NOT logged in -->
                    <li class="nav-item">
                        <a class="nav-link linktest" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>