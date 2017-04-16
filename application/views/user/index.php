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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>util/css/user/style.css">
    </head>
    <body>
        <!-- Navigation -->
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
                    <a class="navbar-brand" href="<?php base_url(); ?>">Cambalaches</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" name="busqueda" placeholder="Busqueda">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
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
        
        <!-- Page Content -->
        <div class='container'>
            <div class='row'>
                <?php
                if (sizeof($lista)>0):
                foreach ($lista as $item):
                ?>
                <div class='col-md-3'>
                    <div class='row'>
                        <div class='col-sm-9 col-lg-9 col-md-9'>
                            <div class='thumbnail'>
                                <h3 class="bg-info" align="center"><?php echo $item['nombre_usuario']; echo " ".$item['apellido']; ?></h3>
                                <?php if(!$item['estado']): ?>
                                <h4 class="text-center label-success">En venta</h4>
                                <?php endif; ?>
                                <?php if ($item['estado']): ?>
                                <h4 class="text-center label-danger">Vendido</h4>
                                <?php endif; ?>
                                <img src='<?php base_url(); ?>util/img/<?php echo $item['foto'] ?>' class="img-responsive">
                                <div class='caption'>
                                    <h4 class='pull-right'> ₡ <?php echo $item['precio']; ?></h4>
                                    <h4 class="pull-left"><a><?php echo $item['nombre_publicacion'];?></a>
                                    </h4><br><br>
                                    <p class="pull-left"><?php echo $item['descripcion']; ?></p><br><br>
                                    <button class='btn-link left' type="button" data-toggle="modal" data-target="#myModal">Comentarios</button>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="container">
                    
                    <div class="row">
                        <!-- Contenedor Principal -->
                        <div class="comments-container">
                            <ul id="comments-list" class="comments-list">
                                <li>
                                    <div class="comment-main-level">
                                        
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name"><a>Usuario</a></h6>
                                                <span>Fecha</span>
                                                <i class="fa fa-reply"></i>
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="comment-content">
                                                Contenido del comentario
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Respuestas de los comentarios -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form class="form-inline"> 
                    <button class="btn btn-primary" id="" type="submit">
                    Comentar
                    </button>
                    <textarea class="form-control" placeholder="Ingrese su comentario" aria-describedby="basic-addon1" autofocus required rows="2" cols="40" name="comentario"></textarea>
                    <button class="btn btn-danger" data-dismiss="modal" type="button">
                    Cancelar
                    </button>
                </form>
            </div>
        </div>
        <!-- /.container -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>