<?php
class Books extends Controller {
    public function __construct() {

        $this->bookModel = $this->model('Book');
    }

    public function catalogo() {
                       
        $data=$this->bookModel->getBooks();
           
        $this->view('books/catalogo',$data);
    } 

    public function insert() {
                       
             if($_SESSION['type']=='usuario'){
                header('location: ' . URLROOT . '/pages/index');
             }

            $data = [
                'title' => '',
                'isbn' => '',
                'genre' => '',
                'editorial' => '',
                'resume' => '',
                'quantity'=>'',
                'author'=>'',
                'entryErrorTitle'=>'',
                'entryErrorIsbn'=>'',
                'entryErrorGenre'=>'',
                'entryErrorEditorial'=>'',
                'entryErrorResume'=>'',
                'entryErrorAuthor'=>'',
                'entryErrorQuantity'=>'',
                'confirmation'=>''

                
            ];
    
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //procesa los datos proveninetes del POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'title' => trim($_POST['title']),
                'isbn' => trim($_POST['isbn']),
                'genre' => trim($_POST['genre']),
                'editorial' => trim($_POST['editorial']),
                'resume' => trim($_POST['resume']),
                'author' => trim($_POST['author']),                
                'quantity' => trim($_POST['quantity']),
                'entryErrorTitle'=>'',
                'entryErrorIsbn'=>'',
                'entryErrorGenre'=>'',
                'entryErrorEditorial'=>'',
                'entryErrorResume'=>'',
                'entryErrorAuthor'=>'',
                'entryErrorQuantity'=>'',
                'confirmation'=>''

            ];
                  
    
                   
                //Valida que haya un titulo
                if (empty($data['title'])) {
                    $data['entryErrorTitle'] = 'Introduzca un título.';
                } 
    
                ///Valida que haya isbn
                if (empty($data['isbn'])) {
                    $data['entryErrorIsbn'] = 'Introduzca el ISBN.';
                } 

                ///Valida que haya genero
                if (empty($data['genre'])) {
                    $data['entryErrorGenre'] = 'Introduzca un género.';
                } 

               ///Valida que haya editorial
                if (empty($data['editorial'])) {
                    $data['entryErrorEditorial'] = 'Introduzca la editorial.';
                   
                } 

              ///Valida que haya sinopsis
                if (empty($data['resume'])) {
                    $data['entryErrorResume'] = 'Introduzca una sinopsis.';
                } 

                ///Valida que haya autor
                if (empty($data['author'])) {
                    $data['entryErrorAuthor'] = 'Introduzca un autor.';
                } 

                
                /////Valida que haya una cantidad
                if (empty($data['quantity'])) {
                    $data['entryErrorQuantity'] = 'Introduzca una cantidad de libros.';
                } 



    
                // Si está todo relleno..
                        if (empty($data['entryErrorTitle']) && empty($data['entryErrorIsbn'])  && empty($data['entryErrorGenre'])  
                        && empty($data['entryErrorEditorial'])
                        && empty($data['entryErrorResume'])  && empty($data['entryErrorAuthor']) && empty($data['entryErrorQuantity'])) {
            
                                
                            //Se registra el libro
                            if ($this->bookModel->insertBooks($data)) {
                                //y se envia mensaje de confirmación
                                $data['confirmation']="Libro registrado correctamente.";
                                
                            } else {
                                die('Something went wrong.');
                            }
                        }
            }       
        
            $this->view('books/insert', $data);
            
        }
//muestra los detalles de un libro al seleccionarlo en el catalogo
        public function book(){

            
            
            $idbook=$_GET['idbook'];
               //evaluamos si hay reviews o no para un tipo de SELECT u otro

            $data=$this->bookModel->showBookDetails($idbook);

            if(count($data) == 0){

                $data=$this->bookModel->showBookDetailswithoutReviews($idbook);

                        $this->view('books/book',$data);
                }else{

                    
                    $this->view('books/book',$data);
                }

                


            

        }
        //registra la review de un libro
                public function review(){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                       
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                              $data = [
                                'idbook' => trim($_POST['idbook']),
                                'rating' => trim($_POST['rating']),
                                'review' => trim($_POST['review']),
                                'user_id' => trim($_POST['user_id'])
                              ];
                              

                             if( $this->bookModel->review($data)){

                                header('location: ' . URLROOT . '/books/catalogo');
                             }
                             



                }


    }

    //permite editar los datos de un libro SOLO por el admin
    public function bookedit(){

        if($_SESSION['type']=='usuario'){
            header('location: ' . URLROOT . '/pages/index');
         }

                if(isset($_GET['idbook'])){
                $idbook=$_GET['idbook'];
                $data=$this->bookModel->edit($idbook);
                
                $this->view('books/bookedit',$data);
            
            
    }

    if(count($_POST)>0){

        $data = [
            'idbook' => trim($_POST['idbook']),
            'title' => trim($_POST['title']),
            'isbn' => trim($_POST['isbn']),
            'genre' => trim($_POST['genre']),
            'editorial' => trim($_POST['editorial']),
            'resume' => trim($_POST['resume']),
            'author' => trim($_POST['author']),                
            'quantity' => trim($_POST['quantity']),
            
        ];

        if ($this->bookModel->updateBook($data)) {
            //Redirect to the login page
            header('location: ' . URLROOT . '/books/catalogo');
        } else {
            die('Something went wrong.');
        }

    }

}

//amplia el periodo de vencimiento de un prestamo
public function ampliar(){

    if(count($_POST)>0){

        $data = [
            'date_fin' => trim($_POST['date_fin']),
            'date_ini' => date("Y-m-d"),
            'idbook'=>trim($_POST['idbook'])
        ];
        if ($this->bookModel->updateDate($data)) {
            //Redirect to the login space
            header('location: ' . URLROOT . '/spaces/admin_space');
        } else {
            die('Something went wrong.');
        }
}

}
    }
           

    

?>