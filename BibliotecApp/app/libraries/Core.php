
<?php
  
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];
    
    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
    public function __construct(){
      

      $url = $this->getUrl();

      // busca la url por el primer valor
      
      if (isset($url[0])) { 
          if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
        // si existe, lo establece como controlador
        $this->currentController = ucwords($url[0]);
        // resetea el indice
        unset($url[0]);
      }}

      // hace un require del controlador
      require_once '../app/controllers/'. $this->currentController . '.php';

      // Instancia la clase del controlador requerido
      $this->currentController = new $this->currentController;

      // Checkea la segunda parte de la url en busca del método
      if(isset($url[1])){
        // busca que exista un metodo para el controlador
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
         
          unset($url[1]);
        }
      }else if (isset($url[0])) {
        if (method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            unset($url[0]);
        }
    }

      // Obtiene parametros
      $this->params = $url ? array_values($url) : [];

    
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    
  }