
  <!DOCTYPE html>


  <html lang="en" class="__full-height-perc">

    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>IziTicket - Página principal</title>

      <!-- Bootstrap core CSS -->
       
      <link href="<?=FRONT_ROOT?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom fonts for this template -->
      <link href="<?=FRONT_ROOT?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
      <link href="<?=FRONT_ROOT?>/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="<?=FRONT_ROOT?>/css/admin.css" >
      <!-- Custom styles for this template -->
      <link href="<?=FRONT_ROOT?>/css/landing-page.min.css" rel="stylesheet">

    </head>

    <body class="__full-height-perc">


      <!-- Navigation -->
      <nav id="my_navbar" class="navbar navbar-light bg-light static-top">
        <div class="container">
          <a class="navbar-brand" href="<?= FRONT_ROOT ?>/home/index">IziTicket</a>

          <div class="right">
            <a class="btn btn-primary" href="vistas/login2.php">Log out</a>
          </div>
        </div>
      </nav>

  <!-- Columna izquierda -->
  

  <div id="container" class="__full-height-perc">

      <div id="cssmenu" class="__full-height-perc">
   <ul>
    <li><a href="<?=FRONT_ROOT?>/artist/getAll">Artistas</a></li>
    <li><a href="<?=FRONT_ROOT?>/category/getAll" title="...">Categorias</a></li>
    <li><a href="..." title="...">Eventos</a></li>
    <li><a href="..." title="...">Calendario</a></li>
    <li><a href="<?=FRONT_ROOT?>/user/getAll" title="...">Usuarios</a></li>
   <li><a href="..." title="...">Plazas</a></li>
   <li><a href="..." title="...">Tipo Plazas</a></li>
   </ul>
    </div>


    <div id="divform"  class="__full-height-perc">

    <div id=edit>
      <!-- Este div aparecerá si un artista debe ser modificado -->
      <?php if(isset($artist)) { ?>

        <form name='formulario' action="<?=FRONT_ROOT?>/artist/updateArtist"  method="POST">
             <div class="form-row">
                  <div class="col-12 col-md-1 mb-2 mb-md-0">
                    <input type="text" name="id" class="form-control form-control-lg" value="<?= $artist->getId(); ?>" readonly>
                  </div>
                  <div class="col-12 col-md-7 mb-2 mb-md-0">
                    <input type="text" name="artist" class="form-control form-control-lg" value="<?= $artist->getName(); ?>">
                  </div>
                  <div class="col-12 col-md-1 " >
                    <button type="submit" class="btn btn-lg btn-primary">Aceptar</button>
                  </div>
                </div>
    </form>

    <?php   } else {   ?>

        <!-- De no ser así, se habilitará el formulario para agregar artistas  -->
        <form name='formulario' action="<?=FRONT_ROOT?>/artist/addArtist"  method="POST">
             <div class="form-row">
                  <div class="col-12 col-md-9 mb-2 mb-md-0">
                    <input type="text" name="artist" class="form-control form-control-lg" placeholder="Ingrese nombre del artista...">
                  </div>
                  <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Agregar</button>
                  </div>
                </div>
    </form>

  <?php } ?>

    </div>

<!-- Lista de artistas -->
  <div id="table">
    <table class="table bg-light-alpha">

          <?php if(!empty($artistArray)) { ?>
              <thead>     
                 <th>Id</th>  
                 <th>Nombre</th>            
             </thead>
             <tbody>
              <?php foreach ($artistArray as $value) { ?>
                  <tr>
                     <td><?= $value->getId(); ?></td>
                      <td><?= $value->getName(); ?></td>
                      <td>
                        <form action="<?=FRONT_ROOT?>/artist/deleteArtist" method="POST">
                        <button name="iddelete" value="<?= $value->getId();  ?>" id="boton1" type="submit"class="btn btn-block btn-lg btn-primary btn-sm">Eliminar</button>
                        </form>
                      <td>
                        <form action="<?=FRONT_ROOT?>/artist/getArtist" method="POST">
                        <button name="update" value="<?= $value->getId(); ?>" id="boton1" type="submit" class="btn btn-block btn-lg btn-primary btn-sm">Editar</button></td>
                        </form>
                  </tr>
              <?php } ?>

          </tbody>
      <?php  } ?>
  </table>

  </div>

</div>

    </div>

  </div>



   


      

     
    

      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!--<script type="text/javascript">
        const body = document.querySelector('body'),
          navbar = document.querySelector('#my_navbar'),
          container = document.querySelector('#container'),
          body_height = body.clientHeight,
          navbar_height = navbar.clientHeight + navbar.style.marginTop + navbar.style.marginBottom,
          container_height = container.clientHeight + container.style.marginTop + container.style.marginBottom,
          final_height = parseInt(navbar_height) + parseInt(container_height);

        if(body_height <= final_height) {
          body.style.height = 'auto';
        }
      </script> -->
    </body>

  </html>
