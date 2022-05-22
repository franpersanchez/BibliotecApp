<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $typeUser="usuario";

        $this->db->query('INSERT INTO usuarios (username,type, password1, name, surname, date, residence, email, telephone)
         VALUES(:username, :type, :password, :name, :surname, :date, :residence, :email, :telephone)');

        
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':type', $typeUser);
        $this->db->bind(':password', $data['password1']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':residence', $data['residence']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);

        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM usuarios WHERE username = :username');

        
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if($row) {
            
            $hashedPassword = $row['password1'];
            
            if (password_verify($password, $hashedPassword)) {
           
                    return $row;
                    } else {
                        
                        return false;
                    }



        } else {
            return false;
        }}

        

    //Busca usuario por su email
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM usuarios WHERE email = :email');

        
        $this->db->bind(':email', $email);

        //CEstá registrado el email?
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registerFinishSession($record, $username){
        $this->db->query('UPDATE usuarios SET last_activity=:last_activity WHERE username=:username');
        $this->db->bind(':last_activity', $record);
        $this->db->bind(':username', $username);
        $this->db->execute();

      
    }

    public function findUsers(){
        $this->db->query('SELECT * FROM usuarios');

        $this->db->execute();
        $result= $this->db->resultSet();
        return $result;
       
    }

    public function delete($id){
        

            $this->db->query('DELETE FROM usuarios WHERE user_id=:user_id');
            $this->db->bind(':user_id', $id);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        
        }   

        public function edit($id){
        

            $this->db->query('SELECT * FROM usuarios WHERE user_id=:user_id');
            $this->db->bind(':user_id', $id);
            $row= $this->db->single();
            return $row;
        
        }

        public function update($data){
            $this->db->query('UPDATE usuarios SET username=:username,name=:name,surname=:surname, residence=:residence,
            date=:date, email=:email, telephone=:telephone WHERE user_id=:user_id');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':residence', $data['residence']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':telephone', $data['telephone']);
            


            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }

        }

       
    
}