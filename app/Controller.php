<?php
abstract class Controller{
    public function loadModel (string $model){
        $this->$model = new $model();//instancier le modèle $model
    }

    public function render($vue, array $data=[]){
        if(!empty($data)){
            extract($data);
        }
        //On démarre le buffer de sortie
        ob_start();
        //On génère la vue
        require_once ('C:\\xampp\htdocs\\tusmo\vues\\' . strtolower(get_class($this)) . '\\' . $vue . '.php');
        //On stock le contenu dans $content
        $content = ob_get_clean();

        //On fabrique le template
        require_once ('C:\\xampp\htdocs\\tusmo\vues\\layout/default.php');
    }
}
?>