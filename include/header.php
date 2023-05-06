<header class="header-section">
	<div class="header-top">
		<div class="row m-0">
			<div class="col-md-6 d-none d-md-block p-0">
				<div class="header-info">
					<i class="material-icons">map</i>
					<p>184 Park Avenue</p>
				</div>
				<div class="header-info">
					<i class="material-icons">phone</i>
					<p>555-5555-555</p>
				</div>
			</div>
			<div class="col-md-6 text-left text-md-right p-0">
				<?php if (strlen($_SESSION['uid']) == 0) : ?>
					<div class="header-info d-none d-md-inline-flex">
						<a href="login.php">
							<p>Login</p>
						</a>
					</div>
				<?php else : ?>
					<div class="header-info d-none d-md-inline-flex">
						<i class="material-icons">account_circle</i>
						<a href="profile.php">
							<p><?php echo $_SESSION['name']; ?> | Profile</p>
						</a>
					</div>
					<div class="header-info d-none d-md-inline-flex">
						<i class="material-icons">brightness_7</i>
						<a href="testimonial_add.php">
							<p>Testimonial</p>
						</a>
					</div>
					<div class="header-info d-none d-md-inline-flex">
						<i class="material-icons">logout</i>
						<a href="logout.php">
							<p>Logout</p>
						</a>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="header-bottom">
		<a href="index.php" class="site-logo" style="color:#fff; font-weight:bold; font-size:26px;">
			Fitness Center<br />
		</a>

		<div class="container">
			<ul class="main-menu">
				<li><a href="index.php" class="<?php echo ($page == 'home') ? 'active' : ''; ?>">Home</a></li>
				<li><a href="service.php" class="<?php echo ($page == 'service') ? 'active' : ''; ?>">Services</a></li>
				<li><a href="testimonial.php" class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>">Testimonial</a></li>
				<li><a href="contact_us.php" class="<?php echo ($page == 'contact') ? 'active' : ''; ?>">Contact</a></li>

				<?php if (strlen($_SESSION['uid']) == 0) : ?>
					<li><a href="admin/">Admin</a></li>
				<?php else : ?>
					<li><a href="booking.php" class="<?php echo ($page == 'booking') ? 'active' : ''; ?>">Bookings</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</header>