<?php 
  if (isset($_SESSION['user'])){ 
   redirect('usuario');
   
} 
 ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Cambalaches</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php base_url();?>util/css/login/style.css">
    
  </head>
  <body>
    <div class="form">
      <h1>Cambalaches CR.</h1>
      <p class="forgot"><a><?php echo $this->session->flashdata('msj');?></a></p>
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Registro</a></li>
        <li class="tab active"><a href="#login">Inicio de Sesión</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">
          
          <form action="user/crearUsuario" method="post">
            
            <div class="top-row">
              <div class="field-wrap">
                <label>
                  Nombre<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name="nombre" />
              </div>
              
              <div class="field-wrap">
                <label>
                  Apellido<span class="req">*</span>
                </label>
                <input type="text"required autocomplete="off" name="apellido" />
              </div>
            </div>
            <div class="field-wrap">
              <label>
                Correo Electrónico<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name="email" />
            </div>
            
            <div class="field-wrap">
              <label>
                Contraseña<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name="pass" />
            </div>
            <button type="submit" class="button button-block"/>Iniciar</button>
            
          </form>
        </div>
        
        <div id="login">
          <h1>Bienvenido!</h1>
          
          <form action="user/autenticar" method="post">
            
            <div class="field-wrap">
              <label>
                Correo Electrónico<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name="email" />
            </div>
            <div class="field-wrap">
              <label>
                Contraseña<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name="pass" />
            </div>
            <button class="button button-block"/>Iniciar Sesión</button>
            
          </form>
        </div>
        
        </div><!-- tab-content -->
        
        </div> <!-- /form -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="<?php base_url();?> util/js/login/index.js"></script>
      </body>
    </html>