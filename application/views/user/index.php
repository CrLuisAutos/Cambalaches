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
                    <a class="navbar-brand" href="<?php base_url();?>usuario">Cambalaches</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-left" role="search" action="buscar" method="get">
                        <div class="form-group">
                            <input type="text" autofocus required class="form-control" name="search" placeholder="Busqueda">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" id="menu">
                            <span class="caret"></span><span class="glyphicon glyphicon-opción-verticales" aria-hidden="true"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="perfil" class="userData" id="<?php echo $userdata['id'];?>" > <?php echo $userdata['nombre']." ". $userdata['apellido']; ?></a>
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
                    if ($item['estado']!=1):
                ?>
                <div class='col-md-3'>
                    <div class='row'>
                        <div class='col-sm-9 col-lg-9 col-md-9'>
                            <div class='thumbnail'>
                                <h3 class="bg-info" align="center"><?php echo $item['nombre_usuario']; echo " ".$item['apellido']; ?></h3>
                                <?php if($item['estado']==0): ?>
                                <h4 class="text-center label-success">Oferta: En venta</h4>
                                <?php endif; ?>
                                <?php if ($item['estado']==2): ?>
                                <h4 class="text-center label-warning">Oferta: Cambalache</h4>
                                <?php endif; ?>
                                <img src='<?php base_url(); ?>util/img/<?php echo $item['foto'] ?>' class="img-responsive">
                                <div class='caption'>
                                    <h4 class='pull-right'> ₡ <?php echo $item['precio']; ?></h4>
                                    <h4 class="pull-left"><a><?php echo $item['nombre_publicacion'];?></a>
                                    </h4><br><br>
                                    <p class="pull-left"><?php echo $item['descripcion']; ?></p><br><br>
                                    <button class='btn-link left btnComentario' type="button" data-toggle="modal" data-target="#myModal" id="<?php echo $item['id_publicacion']; ?>">Comentarios</button>
                                    <?php 
                                    if (!($userdata['id']== $item['id_usuario'])): ?>
                                    <button id="<?php echo $item['id_publicacion']; ?>" class="btnDeseo btn btn-xs btn-danger right data-toggle="tooltip" title="Guardar"><span class="glyphicon glyphicon-heart"></span></button>
                                    <br>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach;?>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Comentarios</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <!-- Contenedor Principal -->
                            <div class="comments-container">
                                <ul id="comments-list" class="comments-list">
                                    <!-- Comentarios -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form class="form-inline">
                            <input class="btn btn-primary" type="button" id="comentar" value="Comentar">
                            <textarea id="text" class="form-control" autofocus placeholder="Ingrese su comentario" aria-describedby="basic-addon1" required rows="2" cols="100" name="comentario" required></textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.container -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php base_url(); ?>util/js/user/notify.min.js" ></script>
        <script type="text/javascript" src="<?php base_url(); ?>util/js/user/file.js" ></script>
    </body>
</html>