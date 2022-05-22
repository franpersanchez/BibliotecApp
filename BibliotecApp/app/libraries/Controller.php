<?php
    //Carga el modelo 
    class Controller {
        public function model($model) {
            //Require model file
            require_once '../app/models/' . $model . '.php';
            //instancia modelo
            return new $model();
        }

        //carga la vista
        public function view($view, $data = []) {
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die("View does not exists.");
            }
        }

         }