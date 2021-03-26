<?php
class Template {

  // properties
  protected $template, $data;
  private $_path = __DIR__ . '/../templates/';
  private $baseTemplate = __DIR__ . '/../templates/layout.html.php';

  // constructor
  public function __construct($filename, $data = array()) {
    $this->template = $this->_path.$filename;
    $this->data = $data;
  }

  public function render() {
    if(file_exists($this->template)){
        //Extracts vars to current view scope
        extract($this->data);

        //Starts output buffering
        ob_start();

        //Includes contents
        include $this->template;
        $output = ob_get_clean();
        
        ob_start();
        include $this->baseTemplate;
        $buffer = ob_get_clean();
        //Returns output buffer
        return $buffer;

    } else {
       throw new Exception('template file does not exist');
    }
  }
}       

