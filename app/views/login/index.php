<?php require 'app/views/templates/headerPublic.php'; ?>

<style>
		body {
				background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
				min-height: 100vh;
				color: #fff;
		}
</style>

<main class="d-flex align-items-center justify-content-center vh-100">
		<div class="w-100" style="max-width: 400px;">
				<h1 class="text-center mb-4 fw-bold">Login to CineCloud</h1>

				<?php if (!empty($_SESSION['error'])): ?>
						<div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
						<?php unset($_SESSION['error']); ?>
				<?php endif; ?>

				<form action="/login/verify" method="post">
						<div class="mb-3">
							<h5 class="mb-3"  >Username</h5>
								<input type="text" name="username" class="form-control" id="floatingUsername"  required>
							
						</div>

						<div class="mb-4">
							<h5 class="mb-3" >Password</h5>
								<input type="password" name="password" class="form-control" id="floatingPassword"  required>
								
						</div>

						<button type="submit" class="btn btn-primary w-100 btn-lg">Login</button>
				</form>

				
		</div>
</main>

<?php require 'app/views/templates/footer.php'; ?>
