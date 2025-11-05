<!DOCTYPE html>
<html lang="en">
<?php include '../partials/header.php'; ?>

<body>
  
  <?php include '../partials/alert.php'; ?>
  
  <?php include '../partials/navbar.php'; ?>

  <!-- PRODUCTS -->
  <main>
    <section id="products" class="page-fade">
      <div class="container py-5">
        <h2 class="text-center mb-4">All Games</h2>
        <!-- Categories/Genres -->
        <div id="product-categories" class="mb-4 text-center"></div>
        <!-- Sort -->
        <div class="d-flex justify-content-end mb-3">
          <select id="product-sort" class="form-select form-select-sm" style="width:auto;">
            <option value="az">A–Z</option>
            <option value="za">Z–A</option>
            <option value="price-asc">Price: Low → High</option>
            <option value="price-desc">Price: High → Low</option>
          </select>
        </div>
        <div id="products-list" class="row g-4"></div>
      </div>
    </section>
  </main>

  <?php include '../partials/footer.php'; ?>

  <?php include '../partials/overviewModal.php'; ?>

  <?php include '../partials/loginModal.php'; ?>

  <?php include '../partials/signupModal.php'; ?>

  <?php include '../partials/script.php'; ?>

  <script>
  // Pass PHP session state to JavaScript
  const isLoggedIn = <?php echo isset($_SESSION['user_name']) ? 'true' : 'false'; ?>;

  // Wait for the main script to load first
  document.addEventListener("DOMContentLoaded", () => {
    const productsList = document.getElementById("products-list");
    if (!productsList) return;

    // Redefine how product cards are displayed
    // We’ll modify this when products are already loaded by script.js
    const observer = new MutationObserver(() => {
      const cards = productsList.querySelectorAll(".card-body");
      cards.forEach(card => {
        const addToCartBtn = card.querySelector(".add-to-cart");
        if (!addToCartBtn) return;

        if (!isLoggedIn) {
          // Replace "Add to Cart" with "Log In" and open modal instead
          const loginBtn = document.createElement("button");
          loginBtn.className = "btn btn-secondary w-100";
          loginBtn.setAttribute("data-bs-toggle", "modal");
          loginBtn.setAttribute("data-bs-target", "#loginModal");
          loginBtn.textContent = "Log in";

          addToCartBtn.replaceWith(loginBtn);
        }
      });
    });

    // Watch for when script.js injects the product cards
    observer.observe(productsList, { childList: true, subtree: true });
  });

      // Also handle the Overview Modal's "Add to Cart" button
      const overviewModal = document.getElementById("overviewModal");

  // Handle the Overview Modal's "Add to Cart" button state
  if (overviewModal) {
    overviewModal.addEventListener("show.bs.modal", () => {
      const modalAddToCartBtn = overviewModal.querySelector(".add-to-cart");
      if (!modalAddToCartBtn) return;

      // If user is logged in
      if (isLoggedIn) {
        // Make sure button looks and works normally
        modalAddToCartBtn.className = "btn btn-primary w-100 add-to-cart";
        modalAddToCartBtn.textContent = "Add to Cart";

        // Remove any old modal triggers if they exist
        modalAddToCartBtn.removeAttribute("data-bs-toggle");
        modalAddToCartBtn.removeAttribute("data-bs-target");

      } else {
        // User not logged in → change to "Log in" button
        modalAddToCartBtn.className = "btn btn-secondary w-100";
        modalAddToCartBtn.textContent = "Log in";
        modalAddToCartBtn.setAttribute("data-bs-toggle", "modal");
        modalAddToCartBtn.setAttribute("data-bs-target", "#loginModal");
      }
    });
  }


</script>

</body>
</html>
