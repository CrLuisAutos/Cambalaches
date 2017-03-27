<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Cambalaches</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>util/css/style.css">
	</head>
	<body>
		<div class="row">
			<div class="nav-main col-md-6">
				<form class="navbar-form navbar-left" role="search">
					<h4><em>CAMBALACHES</em></h4>
				</form>
			</div>
			<div class="nav-main col-md-5" >
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group" id="search">
						<input type="text" class="form-control" id="form-control" placeholder="Que estás buscando?" autofocus>
						<button type="submit" class="btn btn-default">Buscar</button>
					</div>
				</form>
				
			</div>
			<div class="nav-main col-md-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#postModal" data-toggle="modal" >Publica tu artículo</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="">Salir</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="<?= base_url();?>util/img/facebook-login-blue.b724c9e8f066.png" >
						<div class="caption">
							<h3>Nombre del articulo</h3>
							<p>Descripcion del articulo</p>
							<label>Precio</label>
							<p><a href="#" class="btn btn-primary" role="button">Comentar</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="./img/google-login-button.png" alt="...">
						<div class="caption">
							<h3>Nombre del articulo</h3>
							<p>Descripcion del articulo</p>
							<label>Precio</label>
							<p><a href="#" class="btn btn-primary" role="button">Comentar</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="./img/google-login-button.png" alt="...">
						<div class="caption">
							<h3>Nombre del articulo</h3>
							<p>Descripcion del articulo</p>
							<label>Precio</label>
							<p><a href="#" class="btn btn-primary" role="button">Comentar</a></p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="./img/google-login-button.png" alt="...">
							<div class="caption">
								<h3>Nombre del articulo</h3>
								<p>Descripcion del articulo</p>
								<label>Precio</label>
								<p><a href="#" class="btn btn-primary" role="button">Comentar</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!--post modal-->
			<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							Publicar tu artículo
						</div>
						<div class="modal-body">
							<form class="form center-block">
								<div class="form-group">
									<textarea class="form-control input-lg"  rows="4" cols="30" placeholder="Que quieres vender?" autofocus required></textarea>
								</div>
								<label>Precio ₡</label>
								<input type="number" name="precio" min="0" step="100" placeholder="000" required>
							</form>
						</div>
						<div class="modal-footer">
							<div>
								<button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Publicar</button>
								<form method="post" action="subir_archivo.php" enctype="multipart/form-data">
									<input type="file" name="archivo" /><br />
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>