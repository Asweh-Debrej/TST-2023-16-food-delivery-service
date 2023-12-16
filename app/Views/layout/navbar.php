<style>
  .custom-navbar {
    background-color: #247DFF;
    /* Warna biru contoh */
  }

  .not-bold {
    font-weight: normal;
  }

  .custom-navbar .navbar-brand {
    color: #ffffff;
    /* Warna teks putih contoh */
    font-weight: bold;
    /* Make the text bold */
  }

  .custom-navbar .navbar-nav .nav-link,
  .custom-navbar .navbar-nav .login-link {
    color: #ffffff;
    /* Warna teks putih contoh */
  }

  .custom-navbar .navbar-nav .nav-link:hover,
  .custom-navbar .navbar-nav .login-link:hover {
    color: #DDDD;
    /* Warna teks putih pada hover contoh */
  }
</style>


<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container">
    <a class="navbar-brand" href="/">
      <i class="fas fa-truck delivery-icon"></i> Delivery Service
    </a>
    <a class="navbar-brand" href="/">
      <span class="not-bold">Detail Order</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <!-- <a class="nav-link login-link" href="/login">
          <i class="fas fa-sign-in-alt"></i> Login
        </a> -->
        <a class="nav-link login-link" href="/logout">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </div>
</nav>