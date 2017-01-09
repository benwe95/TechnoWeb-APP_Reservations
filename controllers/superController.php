<?php

class Controller{

    protected $vars = array();
    protected $template = 'default';

    //Includes the required view $viewname
    public function render($viewname){
      //The variable must exist in the same scope as the 'require' to be used in the html code
      extract($this->vars);

      ob_start();
      require (WEBROOT.'views/'.get_class($this).'/'.$viewname.'View.php');
      $content = ob_get_clean();
      require(WEBROOT.'views/templates/'.$this->template.'.php');
    }

    //To push datas into the view
    public function set($newvars){
      //Add de datas $newvars in the existing datas $vars
      $this->vars = array_merge($this->vars, $newvars);
    }


    public function loadView($datas, $viewname){
      $this->set($datas);
      $this->render($viewname);
    }

}
 ?>
