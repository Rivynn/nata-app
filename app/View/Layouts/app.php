<!doctype html>
<html lang="id">

<?php include __DIR__ . '/Partials/head.php'; ?>

<body id="page-top">

<div id="wrapper">

	<?php include __DIR__ . '/Partials/sidebar.php'; ?>

	<div id="content-wrapper" class="d-flex flex-column">

		<div id="content">

			<?php include __DIR__ . '/Partials/navbar.php'; ?>

			<?= $content ?>

		</div>

		<?php include __DIR__ . '/Partials/footer.php'; ?>

	</div>

</div>

<?php include __DIR__ . '/Partials/scripts.php'; ?>

</body>
</html>