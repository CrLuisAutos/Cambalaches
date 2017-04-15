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
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="http://placehold.it/320x150" alt="">
                                <div class="caption">
                                    <h4 class="pull-right">$24.99</h4>
                                    <h4><a>Nombre del producto</a>
                                    </h4>
                                    <p>Descripcion</p>
                                </div>
                                <div class="ratings">
                                    <p class="pull-right">Cantidad de comentarios</p>
                                    <button class="btn-link">Comentarios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>