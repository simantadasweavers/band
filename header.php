<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>
<?php wp_title(); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>
<!--/head-->
<body <?php body_class(); ?>>


<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo get_site_url(); ?>" class="nav-link px-2 text-white">Home</a></li>
          <!-- <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li> -->
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <a href="<?php echo get_site_url(); ?>/login">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          </a>
          <a href="<?php echo get_site_url(); ?>/register">
          <button type="button" class="btn btn-warning">Register</button>
          </a>
        </div>
      </div>
    </div>
  </header>