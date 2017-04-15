<?php
if (!isset($_SESSION['user'])){
redirect(base_url());
}
$userdata= $this->session->userdata('user');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Cambalaches</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href=" <?php base_url(); ?>util/css/user/style.css">
		<link rel="stylesheet" type="text/css" href=" <?php base_url(); ?>util/css/user/perfil.css">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="usuario">Cambalaches</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="contacto">Contáctenos</a>
						</li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<div class="dropdown">
							<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" id="menu">
							<span class="caret"></span><span class="glyphicon glyphicon-opción-verticales" aria-hidden="true"></span></button>
							<ul class="dropdown-menu">
								<li>
									<a href="perfil"> <?php echo $userdata['nombre']." ". $userdata['apellido']; ?></a>
								</li>
								<li role="separator" class="divider"></li>
								<li>
									<a href="close">Cerrar Sesión</a>
								</li>
							</ul>
						</div>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<div class="well well-sm">
						<div class="row">
							<div class="col-sm-6 col-md-4">
								<img src="<?php base_url(); ?>util/img/perfil.jpg" alt="" class="img-rounded img-responsive" />
							</div>
							<div class="col-sm-6 col-md-8">
								<h3>Bienvenido!</h3>
								<h4><?php echo $userdata['nombre']." ". $userdata['apellido']; ?> </h4>
								<p>
									<i class="glyphicon glyphicon-envelope"></i><?php echo $userdata['email']; ?>
									<br />
								</p>
								<button class="btn-link"><a href="usuario">Ir a la página principal</a></button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8">
					<h4 align="center">Administrar publicaciones</h4>
					<button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block">Publicar un artículo</button>
				</div>
			</div>
		</div>
		<hr>
		<div class='container'>
			<div class='row'>
		<?php
		if (sizeof($lista)>0):
			foreach ($lista as $item):
		?>
				<div class='col-md-4'>
					<div class='row'>
						<div class='col-sm-8 col-lg-8 col-md-8'>
							<div class='thumbnail'>
								<img src='<?php base_url(); ?>util/img/<?php echo $item['foto'] ?>' class="img-responsive">

								<div class=''>
									<h4 class='pull-right'>Precio ₡ <?php echo $item['precio']; ?></h4>
									<h4><a><?php echo $item['nombre']; ?></a>
									</h4>
									<p><?php echo $item['descripcion']; ?></p>
								</div>
								<div>
									<button class='btn-link'>Comentarios</button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php endforeach;?>
<?php endif; ?>
			</div>
		</div> 
		<!-- line modal -->
		<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="lineModalLabel">Publica tu artículo</h3>
					</div>
					<div class="modal-body">
						
						<!-- content goes here -->
						<form action="user/publicar" method="post">
							<div class="form-group">
								<label>Articulo</label>
								<input type="text" required class="form-control" placeholder="Ingrese el nombre del articulo" name="nombre">
							</div>
							<div class="form-group">
								<label>Descripción</label><br>
								<textarea rows="3" placeholder="Breve descripcion del artículo" required name="descripcion"></textarea>
							</div>
							<div class="form-group">
								<label>Agrega una foto</label>
								<input required type="file" name="foto">
							</div>
							<div class="form-group">
								<label>Precio en ₡</label>
								<input name="precio" type="number" min="100" required step="100" placeholder="Precio negociable">
							</div>
							<div class="modal-footer">
								<div class="btn-group btn-group-justified" role="group" aria-label="group button">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancelar</button>
									</div>
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-default btn-hover-green" role="button">Guardar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.container -->
					<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
					<!-- Latest compiled and minified JavaScript -->
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
				</body>
			</html>