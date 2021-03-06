
<!DOCTYPE html>
<html lang="en">

 <?php include_once(HEADER); ?>

  
<style type="text/css">
  main{
    background-image: url("<?= IMG_FRONT_ROOT?>/fondologin.jpg");
    height: auto;
    width: auto;
  }
  h2{
    color: white;
  }
</style>


<?php include_once(NAVBAR); ?>



    <!-- Masthead -->
    <header class="masthead text-white text-center">
      

      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">La forma mas facil de comprar tus tickets a un solo click!</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">

            <form action="<?=  FRONT_ROOT ."/home/search"?>"  method="POST">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" name="artist" class="form-control form-control-lg" placeholder="Por evento, lugar o artista...">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg btn-primary">Buscar</button>
                </div>
              </div>
            </form>

          </div>
        
      </div>

</header>
<body>

<div >

  <table class="table bg-light-alpha text-center mt-5">

    <?php if(!empty($calendarArray)) { ?>
     <tbody>
      <?php foreach ($calendarArray as $value) { ?>
   
        <tr>       
         <td><img src="<?= $value->getEvent()->getImage()->getPath() ?>" height="200" width="350"/></td>
        <td>
          <form id="getCalendar" action="<?=  FRONT_ROOT ."/home/getCalendar"?>"  method="POST">

            <div class="mt-5" >
              <a href="javascript:document.forms.getCalendar.submit()"> <!-- para que mande el form desde el hipervinc -->
              <input type="hidden" name="id_calendar" value="<?=$value->getId();  ?>">
              <big><big><?= $value->getEvent()->getName(); ?></big></big><br>
              <big><?=$value->getDate(); ?></big>
             </a>
            </div>
          </form>
          
        </td>
        <td>
          <form action="<?=FRONT_ROOT?>/home/search" method="POST">
            <button name="search" value="<?= $value->getName(); ?>" id="boton1" type="submit" class="btn btn-block btn-lg btn-primary btn-sm mt-5">Ver mas</button></td>
          </form>
        </td>
       
      </tr>
      
   
    <?php } ?>

  </tbody>
<?php  } ?>


</div>
</table>

 </body>


<?php include_once(FOOTER); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="/tptickets/vendor/jquery/jquery.min.js"></script>
    <script src="/tptickets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>
