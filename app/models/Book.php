<?php

class Book {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

//obtiene todos los libros para el catalogo
    public function getBooks(){
           
               
           $this->db->query('SELECT * FROM libros');
           $this->db->execute();
           $listalibros= $this->db->resultSet();
            //$listalibros=$this->db->resultSet();
                return $listalibros;
       
    
            
        }

        //inserta nuevo libro
        public function insertBooks($data){

            $this->db->query('INSERT INTO libros(title,isbn, genre, editorial, resume, quantity, author ) VALUES (:title, :isbn,
             :genre, :editorial, :resume, :quantity, :author)');

            $this->db->bind(':title', $data['title']);
            $this->db->bind(':isbn', $data['isbn']);
            $this->db->bind(':genre', $data['genre']);
            $this->db->bind(':editorial', $data['editorial']);
            $this->db->bind(':resume', $data['resume']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':author', $data['author']);
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
          
        }

//muestra detalles libro seleccionado en el catalogo
        public function showBookDetails($idbook){

            $sql="SELECT * FROM libros JOIN reviews ON libros.idbook=reviews.idbook JOIN usuarios ON usuarios.user_id=reviews.user_id WHERE reviews.idbook=$idbook";
            $this->db->query($sql);
           
            

            if($this->db->execute()){
                $detallesLibro= $this->db->resultSet();
                return $detallesLibro;
            } else {
                die("El libro no existe o ha sido borrado/editado");
            }
            

        }
       
//enseña detalles libro que no tienen Reviews
        public function showBookDetailswithoutReviews($idbook){
            $sql="SELECT * FROM libros WHERE libros.idbook=$idbook";
            $this->db->query($sql);
            $this->db->execute();
            $detallesLibros= $this->db->resultSet();
            
                 return $detallesLibros;
        

        }

        //muestra reviews de un libro
        public function review($data){

            $this->db->query('INSERT INTO reviews(rating, review,idbook, user_id) VALUES (:rating,:review, :idbook,:user_id)');

           $this->db->bind(':idbook', $data['idbook']);
           $this->db->bind(':rating', $data['rating']);
           $this->db->bind(':review', $data['review']);
           $this->db->bind(':user_id', $data['user_id']);

           if($this->db->execute()){
            
            return true;
        } else {
            die("El libro no existe");
        }

             

            

        }

        //permite mostrat los datos a actualizar de un libro
        public function edit($idbook){
            $sql="SELECT * FROM libros WHERE libros.idbook=$idbook";
            $this->db->query($sql);
            $this->db->execute();
            $detallesLibros= $this->db->resultSet();
             
                 return $detallesLibros;

        }


    //actualiza los datos de un libro
        public function updateBook($data){
            $this->db->query('UPDATE libros SET title=:title, author=:author,isbn=:isbn, genre=:genre, editorial=:editorial,
             quantity=:quantity, resume=:resume WHERE idbook=:idbook');

            $this->db->bind(':idbook', $data['idbook']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':isbn', $data['isbn']);
            $this->db->bind(':genre', $data['genre']);
            $this->db->bind(':editorial', $data['editorial']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':resume', $data['resume']);
 
            if($this->db->execute()){
             
             return true;
         } else {
             die("El libro no existe");
         }
        }
    

        //actualiza la fecha fin de prestamo de un libro (RENUEVA PRESTAMO)
        public function updateDate($data){ 
            
            $this->db->query('UPDATE prestamos SET date_ini=:date_ini, date_fin=:date_fin WHERE idbook=:idbook');

           $this->db->bind(':idbook', $data['idbook']);
           $this->db->bind(':date_ini', $data['date_ini']);
           $this->db->bind(':date_fin', $data['date_fin']);
          
           if($this->db->execute()){
            
            return true;
        } else {
            die("No se pudo ampliar el plazo");
        }

        }
        }

        
    
    

?>