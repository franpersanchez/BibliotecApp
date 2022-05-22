<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    //muestra usuarios registrados
    
    public function manage(){
        if($_SESSION['type']=='usuario'){
            header('location: ' . URLROOT . '/pages/index');
         }

        $data=$this->userModel->findUsers();

        $this->view('users/manage',$data);


    }

    //procesa datos y registra un nuevo usuario
    public function register() {
        $data = [
            'username' => '',
            'email' => '',
            'password1' => '',
            'confirmPassword' => '',
            'name' => '',
            'surname' => '',
            'residence' => '',
            'telephone' => '',
            'date' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'nameError'=> '',
            'surnameError'=> '',
            'residenceError'=> '',
            'telephoneError'=> '',
            'dateError'=> '',
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password1' => trim($_POST['password1']),
                'confirmPassword' => trim($_POST['password2']),
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'residence' => trim($_POST['residence']),
                'telephone' => trim($_POST['telephone']),
                'date' => trim($_POST['date']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'nameError'=> '',
                'surnameError'=> '',
                'residenceError'=> '',
                'telephoneError'=> '',
                'dateError'=> '',
            ];

            $nameValidation ="/^[a-zA-Z0-9]*$/";
            $passwordValidation="/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$^/";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Introduzca un nombre de usuario.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'El nombre de usuario solo puede contener números y letras.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Introduzca un email.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Utilice un formato válido de email.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Este email ya está registrado.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password1'])){
              $data['passwordError'] = 'Introduzca una contraseña.';
            } elseif(strlen($data['password1']) < 8){
              $data['passwordError'] = 'La contraseña debe tener al menos 8 caracteres';
            } elseif (preg_match($passwordValidation, $data['password1'])) {
              $data['passwordError'] = 'La contraseña debe tener al menos un número';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Introduzca la contraseña de nuevo.';
            } else {
                if ($data['password1'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Las contraseñas no coinciden.';
                }
            }

            if (empty($data['name'])) {
                $data['nameError'] = 'Introduzca un nombre.';
            }

            if (empty($data['surname'])) {
                $data['surnameError'] = 'Introduzca unos apellidos.';
            }

            if (empty($data['residence'])) {
                $data['residenceError'] = 'Introduzca una residencia.';
            }

            if (empty($data['telephone'])) {
                $data['telephoneError'] = 'Introduzca un teléfono.';
            }

            if (empty($data['date'])) {
                $data['dateError'] = 'Introduzca una fecha.';
            }
            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) 
            && empty($data['confirmPasswordError']) && empty($data['nameError'])&& empty($data['surnameError'])
            && empty($data['residenceError'])&& empty($data['telephoneError']) && empty($data['dateError'])) {

                // Hash password
                $data['password1'] = password_hash($data['password1'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }


    //procesa datos y verifica el login. Crea la sesión de usuarios que no se cierra hasta que se presiona LOG OUT
    public function login() {
        $data = [
            'username' => '',
            'password1' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password1' => trim($_POST['password1']),
                    'usernameError' => '',
                    'passwordError' => '',
                ];
                //Validate username
                if (empty($data['username'])) {
                    $data['usernameError'] = 'Introduce tu nombre de usuario.';
                }

                //Validate password
                if (empty($data['password1'])) {
                    $data['passwordError'] = 'Introduce la contraseña.';
                }

                //Check if all errors are empty
                if (empty($data['usernameError']) && empty($data['passwordError'])) {
                    
                    $loggedInUser = $this->userModel->login($data['username'], $data['password1']);

                            if ($loggedInUser==true) {
                                $this->createUserSession($loggedInUser);
                                
                            } 
                                else {

                                    $data['passwordError'] = 'Los datos son incorrectos. Por favor inténtalo de nuevo o regístrate.';
                                  
                                    
                                }
                    }

                    } else {
                        $data = [
                            'username' => '',
                            'password1' => '',
                            'usernameError' => '',
                            'passwordError' => ''
                        ];
                         }                    

                        $this->view('users/login', $data);
                        

                    }

                    public function createUserSession($user) {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['type'] = $user['type'];
                         header('location:' . URLROOT . '/pages/index');
                    }

                    public function logout() {
                        $logout_tym = date('Y-m-d H:i:s'); 
                        $this->userModel->registerFinishSession($logout_tym, $_SESSION['username']);
                        unset($_SESSION['user_id']);
                        unset($_SESSION['username']);
                        unset($_SESSION['email']);
                        
                        header('location:' . URLROOT . '/pages/index');
                    }
                   
                   //elimina un usuario de la BD
                    public function delete(){
                        
                        if(isset($_GET['delete'])){
                            $id=$_GET['delete'];
                            $this->userModel->delete($id);
                            header('location:' . URLROOT . '/users/manage');
                            
                            $this->view('users/manage');
                        }
                        

                        
                    }

                    //funcion que permite actualizazr los datos de un usuario

                public function update(){
                    if($_SESSION['type']=='usuario'){
                        header('location: ' . URLROOT . '/pages/index');
                     }

                            if(isset($_GET['user_id'])){
                            $id=$_GET['user_id'];
                            $data=$this->userModel->edit($id);
                            
                            $this->view('users/update',$data);
                        
                        
                }

                if(count($_POST)>0){

                    $array = [
                        'user_id'=> trim($_POST['user_id']),
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'name' => trim($_POST['name']),
                        'surname' => trim($_POST['surname']),
                        'residence' => trim($_POST['residence']),
                        'telephone' => trim($_POST['telephone']),
                        'date' => trim($_POST['date']),
                        
                    ];

                    if ($this->userModel->update($array)) {
                        //Redirect to the login page
                        header('location: ' . URLROOT . '/users/manage');
                    } else {
                        die('Something went wrong.');
                    }

                }

            }

            //funcion que permite actualizar los datos del usuario que accede a "mis datos"
            public function updateme(){

                if(isset($_SESSION['user_id'])){
                    $id=$_SESSION['user_id'];
                    $data=$this->userModel->edit($id);
                    
                    $this->view('users/updateme',$data);
                
                
        }

        if(count($_POST)>0){

            $array = [
                'user_id'=> trim($_POST['user_id']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'residence' => trim($_POST['residence']),
                'telephone' => trim($_POST['telephone']),
                'date' => trim($_POST['date']),
                
            ];

            if ($this->userModel->update($array)) {
                //Redirect to the login page
                header('location: ' . URLROOT . '/users/manage');
            } else {
                die('Something went wrong.');
            }

        }

            }
        
        }