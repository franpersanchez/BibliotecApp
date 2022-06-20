<?php
class Pages extends Controller {

    //controlador para la pagina de inicio, controlador por defecto
    public function __construct (){
        
        $this->userModel =$this->model('User');
        
    }

    public function index(){
       
       

        
        $this->view('pages/index');
    }
  

    
}