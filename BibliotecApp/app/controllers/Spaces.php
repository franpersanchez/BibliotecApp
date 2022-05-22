<?php
class Spaces extends Controller {
    public function __construct (){
        
        $this->spaceModel =$this->model('Space');
        
    }

    //controlador pagina Gestion

    public function admin_space(){
        if($_SESSION['type']=='usuario'){
            header('location: ' . URLROOT . '/pages/index');
         }
        
        $this->view('spaces/admin_space');

        
    }



    //controlador pagina Mi Espacio
    public function user_space(){
       
        
        
        $this->view('spaces/user_space');
    }



    //Muestra lista de usuarios
    public function lends(){
        
        if($_SESSION['type']=='usuario'){
            header('location: ' . URLROOT . '/pages/index');
         }
        
        $data=$this->spaceModel->findUsers();
        
        $this->view('spaces/lends', $data);
        }

        
        

    //Relaciona un usuario con el libro seleccionado antes de confirmar el prestamo

public function lendsbook() { 
    if($_SESSION['type']=='usuario'){
        header('location: ' . URLROOT . '/pages/index');
     }
             
        
        

        if(isset($_GET['idbook']) && isset($_GET['user_id'])){
            
            $idbook=$_GET['idbook'];
            $user_id=$_GET['user_id'];
            

            $this->spaceModel->createLend($idbook,$user_id);
            header('location: ' . URLROOT . '/spaces/lendsfinal');
            }

            $data=$this->spaceModel->getBooks();
            $this->view('spaces/lendsbook', $data);
        }
    
                
    
    
    //registra el prestamo
            public function lendsfinal (){
                if($_SESSION['type']=='usuario'){
                    header('location: ' . URLROOT . '/pages/index');
                 }

                if(isset($_GET['idbook']) && isset($_GET['user_id'])){
            
                    $idbook=$_GET['idbook'];
                    $user_id=$_GET['user_id'];

                    $data=$this->spaceModel->createLendFinal($idbook,$user_id);

                    $this->view('spaces/lendsfinal',$data);

            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                      $data = [
                        'user_id' => trim($_POST['user_id']),
                        'idbook' => trim($_POST['idbook']),
                        'quantity' => trim($_POST['quantity']),
                        'date_ini' => trim($_POST['date_ini']),
                        'date_fin' => trim($_POST['date_fin']),
                        'mensajeConfirmacion' => '',
                        'mensajeError' => '',
                    
                    ];

                    if ($this->spaceModel->executeLendFinal($data)) {
                       
                        header('location: ' . URLROOT . '/spaces/admin_space');
                       

                    } else {

                        die('Something went wrong.');
                    }
            
        }

    }


    //Registra devolución de un libro

                    public function return(){
                        if($_SESSION['type']=='usuario'){
                            header('location: ' . URLROOT . '/pages/index');
                         }


                        $data=$this->spaceModel->findPrestamos();
                        


                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                            $data = [
                                'idbook' => trim($_POST['idbook']),
                                'idprestamo' => trim($_POST['idprestamo']),
                            ];

                           if( $this->spaceModel->return($data)){
                            header('location: ' . URLROOT . '/spaces/return');
                            
                           }
                            
                          
                       

                        } 

                        $this->view('spaces/return', $data);
                        
                                   
            
                               
                    }

//muestra los libros en prestamo para la vista de un usuario

                            public function lendsme(){
                                       
                                if(isset($_SESSION['user_id'])){
                                    $id=$_SESSION['user_id'];

                                $data=$this->spaceModel->findPrestamosMe($id);
                                
        
        
        
                                $this->view('spaces/lendsme', $data);
                                
                                           
                    
                                       
                            }
}

//muestra todos los mensajes en el foro y sus likes
                        public function foro(){

                            $data=$this->spaceModel->foroGeneral();
                            $this->view('spaces/foro',$data);

                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                                $data = [
                                    'date_written' => trim($_POST['date_written']),
                                    'titular' => trim($_POST['titular']),
                                    'mensaje_foro' => trim($_POST['mensaje_foro']),
                                    'theme' => trim($_POST['theme']),
                                    'user_id' => $_SESSION['user_id'],
                                ];
    
                               if( $this->spaceModel->publicaPost($data)){
                                header('location: ' . URLROOT . '/spaces/foro');
                                
                               }


                        }
                    }







//muestra información de cada mensaje en el foro en concreto asi como las respuestas

                        public function post(){


                            if(isset($_POST['like'])){
                                $likes = [
                                    'like' => trim($_POST['like']),
                                   
                                ];

                                $this->spaceModel->sumaLike($likes);
                                header('location: ' . URLROOT . '/spaces/foro');
                            }


                            
                            if(isset($_GET['forum_id'])){
                                    $forum_id=$_GET['forum_id'];
    
                                    if( $data=$this->spaceModel->post($forum_id)){
                                        
                                        $this->view('spaces/post',$data);
                                    }
    
                                    else {
    
                                        $data=$this->spaceModel->postSinRespuestas($forum_id);
                                            $this->view('spaces/post',$data);
                                    }
                            }


                            if(isset($_POST['responder'])){
                                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                                $data = [
                                    'user_id' => trim($_POST['user_id']),
                                    'forum_id' => trim($_POST['forum_id']),
                                    'mensaje' => trim($_POST['mensaje']),
                                    
                                ];
    
                               if( $this->spaceModel->publicaRespuesta($data)){
                                header('location: ' . URLROOT . '/spaces/foro');
                                
                               }
                            } 
                            


                        }
}
    
