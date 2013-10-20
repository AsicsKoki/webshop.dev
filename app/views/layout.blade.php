<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/jquery.dataTables.css">
		<link rel="stylesheet" href="css/jquery.dataTables_themeroller.css">
	</head>
	<body id="background">
			<div id="mainElement">
				<header>123</header>
				@yield('main');
				<footer id="footer">(2013) All rights reserved</footer>
			</div>
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			$('.delete').click(function(e){
				e.preventDefault();
				var id = $(this).data('id');
				var self = this;
				$.ajax({
					url: "cartDelete.php",
					type: "POST",
					data: {
						id: id
					},
					success: function(data){
						$(self).parents("tr").remove();
					}
				});
			});
		</script>
	</body>
</html>