<?php 
namespace controllers;

use model\User as M_User;

use controllers\UserController as UserController;

use controllers\ArtistController as ArtistController;

/**
 *
 */
class HomeController
{
     private $user;

     function __construct() {
          $this->userController = new UserController();
     }

     /**
      * Inicio por defecto del sitio.
      *
      * @method index
      * @param $_user, $_pass
      *
      */

    public function index(){
      include_once VIEWS_ROOT. '/home.php';
    }


     public function login($email= null, $password= null) {

        $showHome = false; // Esto se vuelve true solo si hay un usuario logueado.

          // Verifico si existe un usuario logueado. Le paso la responsabilidad a UserController de verificarlo
          if($user = $this->userController->checkSession()) {
               $showHome = true;
          } else {

               // Si no hay usuario logueado pero viene un usuario como parametro, es un intento de logueo.
               if(isset($email)) {

                    // Intento loguear. Le paso la responsabilidad a UserController. Si es true, muetro home. Caso contrario sigo...
                    if($user = $this->userController->login($email, $password)) {
                         $showHome = true;

                    } else {
                         $alert = "Datos incorrectos, vuelva a intentar.";
                    }
               }
          }
          

          if($showHome){
                if($user->getAdmin() == "true"){
                  include_once VIEWS_ROOT. '/home.php';
                }else{
                  include_once ADMIN_VIEWS. '/admin.php';
                }
          }else{
            //vista login
            print_r($alert);
               include_once VIEWS_ROOT. '/login.php';
          }



          

     }

     public function addUser($email, $password, $firstname, $lastname, $admin='false') {

          // Codifiacacion de contraseña
          //$pass = md5($pass);


          //checkeo que no exista un usuario con ese email
    if($this->userController->checkEmail($email)) {
      //checkeo que password sea mayor a 6 caracteres
      if($this->userController->checkPassword($password)) {
           $m_user = new M_User(null, $email, $password, $firstname, $lastname, $admin);

           if(isset($admin)){
            $m_user->setAdmin($admin);
            }
      
          try {
               if($this->userController->addUser($m_user)){
                    $success = "Gracias por registrarte. Ya podes iniciar sesión.";
               }else{
                    $alert = "Ocurrió un error al crear la cuenta. Vuelva a intentar.";
                  }
          } catch(\PDOException $ex) {
               $alert =  $ex->errorInfo['2'];
          }

       } else echo "LA PASSWORD ES MUY CORTA, tiene que tener al menos 6 caracteres";
  
    }else echo "YA EXISTE UN USUARIO CON ESE EMAIL";

  }
}
