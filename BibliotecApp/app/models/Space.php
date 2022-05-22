<?php

class Space {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

public function myBooks($username){

        //listado de los libros en préstamo
        $this->db->query('SELECT * FROM prestamos WHERE username=:username');

        $this->db->bind(':username', $username);

            //hay libros relacionados?
            if($this->db->rowCount() > 0) {
                $this->db->execute();
            $listalibros= $this->db->resultSet();
                //si hay libros se devuelve array con info de estos libros
                    return $listalibros;
            } else {

                //si no, se devuelve falso
                return false;
            }



}

public function findUsers(){
    $this->db->query('SELECT user_id,username, name, surname,email FROM usuarios ORDER BY surname DESC');

    $this->db->execute();
    $result= $this->db->resultSet();
    return $result;
   
}
//no usado se resuelve con js
public function searcher($data){
    $sql="SELECT username, name, surname, user_id FROM usuarios WHERE username LIKE '%$data%' OR name LIKE '%$data%' 
    OR surname LIKE '%$data%'";

    $this->db->query($sql);
    $this->db->execute();
    $result= $this->db->resultSet();
    return $result;


}
//no usado se resuelve con js
public function searcherbook($data){
    $sql="SELECT * FROM libros WHERE title LIKE '%$data%' OR author LIKE '%$data%' 
    OR genre LIKE '%$data%' OR editorial LIKE '%$data%' or isbn LIKE '%$data%'";

    $this->db->query($sql);
    $this->db->execute();
    $result= $this->db->resultSet();
       return $result;
}


public function pair($user_id, $idbook){

    $sql="UPDATE prestamos SET user_id=$user_id, idbook=$idbook";

    $this->db->query($sql);
    if($this->db->execute()){
        return true;
    }else die();


}


public function getBooks(){
           
               
    $this->db->query('SELECT * FROM libros');
    $this->db->execute();
    $listalibros= $this->db->resultSet();
    
         return $listalibros;


     

         
 }



 public function createLend($idbook,$user_id){
        //esto ya no funciona ya que al clickar en el titulo, le pasa los parametros mediante GET a lendsfinal
        //query para 1. restar un libro y 2.insertar el prestamo en la bd
    
    $this->db->query('UPDATE libros SET quantity=quantity-1  WHERE idbook=:idbook ');
    $this->db->bind(':idbook', $idbook);
    
    $this->db->execute();
            
    $this->db->query('INSERT INTO prestamos (idbook, user_id) VALUES (:idbook, :user_id)');
    $this->db->bind(':idbook', $idbook);
    $this->db->bind(':user_id', $user_id);
    $this->db->execute();

        
        }



        public function createLendFinal($idbook,$user_id){
            /* muestra los libros que estan prestados con cierto idbook y iduser */
        
            $this->db->query('SELECT title, isbn, author, username, name, surname, quantity FROM libros, usuarios WHERE
            libros.idbook=:idbook AND usuarios.user_id=:user_id' );
            $this->db->bind(':idbook', $idbook);
            $this->db->bind(':user_id', $user_id);

            $this->db->execute();
            $listalibros= $this->db->resultSet();
            return $listalibros;
            

        }

        public function executeLendFinal($data){
            $cantidad=$data['quantity'];

            $sql="UPDATE libros SET quantity=quantity-$cantidad  WHERE idbook=:idbook";
            $this->db->query($sql);
            $this->db->bind(':idbook', $data['idbook']);
            
            $this->db->execute();
                    
            $this->db->query('INSERT INTO prestamos (idbook, user_id,date_ini,date_fin) VALUES (:idbook, :user_id,:date_ini,:date_fin)');
            $this->db->bind(':idbook', $data['idbook']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':date_ini', $data['date_ini']);
            $this->db->bind(':date_fin', $data['date_fin']);
            $this->db->execute();
            return true;

        }

        


        

        public function findPrestamos(){
            $this->db->query('SELECT * FROM libros JOIN prestamos ON libros.idbook=prestamos.idbook JOIN usuarios ON 
            prestamos.user_id=usuarios.user_id' );
           

            $this->db->execute();
            $listalibros= $this->db->resultSet();
            return $listalibros;
        }

            
        
        
        public function return($data){

                $this->db->query('UPDATE libros SET quantity=(quantity+1) WHERE idbook=:idbook');
                $this->db->bind(':idbook', $data['idbook']);

                $this->db->execute();

                $this->db->query('DELETE FROM prestamos WHERE idprestamo=:idprestamo ');
                $this->db->bind(':idprestamo', $data['idprestamo']);

                $this->db->execute();
                return true;

                
               



            }

            public function findPrestamosMe($id){
                $this->db->query('SELECT * FROM libros JOIN prestamos ON libros.idbook=prestamos.idbook JOIN usuarios ON 
                prestamos.user_id=usuarios.user_id WHERE prestamos.user_id=:user_id' );
               $this->db->bind(':user_id', $id);
    
                $this->db->execute();
                $listalibros= $this->db->resultSet();
                return $listalibros;
            }
      

            public function foroGeneral(){

                $this->db->query('SELECT * FROM foros JOIN usuarios ON foros.user_id=usuarios.user_id ORDER BY date_written DESC');
               
    
                $this->db->execute();
                $listalibros= $this->db->resultSet();
                return $listalibros;
                
            }

            public function post($forum_id){

                $this->db->query('SELECT * FROM posts JOIN foros ON foros.forum_id=posts.forum_id JOIN usuarios 
                ON posts.user_id=usuarios.user_id WHERE posts.forum_id=:forum_id ');
                $this->db->bind(':forum_id', $forum_id);
               
    
                $this->db->execute();
                $listalibros= $this->db->resultSet();
                return $listalibros;
                
  
            }



            public function publicaPost($data){

                $this->db->query('INSERT INTO foros (titular, mensaje_foro,user_id, theme) VALUES 
                (:titular, :mensaje_foro,:user_id, :theme)');
                $this->db->bind(':titular', $data['titular']);
                $this->db->bind(':mensaje_foro', $data['mensaje_foro']);
                $this->db->bind(':user_id', $data['user_id']);
                
                $this->db->bind(':theme', $data['theme']);

               
    
                $this->db->execute();

            }

            public function postSinRespuestas($forum_id){

                $this->db->query('SELECT * FROM foros JOIN usuarios ON foros.user_id=usuarios.user_id WHERE forum_id=:forum_id');
                $this->db->bind(':forum_id', $forum_id);
    
                $this->db->execute();
                $listalibros= $this->db->resultSet();
                return $listalibros;



            }


            public function publicaRespuesta($data){
                $this->db->query('INSERT INTO posts (user_id, forum_id,mensaje) VALUES 
                (:user_id, :forum_id,:mensaje)');
                $this->db->bind(':user_id', $data['user_id']);
                $this->db->bind(':forum_id', $data['forum_id']);
                $this->db->bind(':mensaje', $data['mensaje']);
    
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }

            }


            public function sumaLike($likes){
                $this->db->query( 'UPDATE foros SET likes=likes+1 WHERE forum_id=:forum_id');
                $this->db->bind(':forum_id', $likes['like']);
                $this->db->execute();

            }

 }










