<?php
class Template {

  // properties
  protected $template, $data;
  private $_path = __DIR__ . '/../templates/';
  private $outerLayout = __DIR__ . '/../templates/layout.html.php';

  // constructor
  public function __construct($filename, $data = array()) {
    $this->template = $this->_path.$filename;
    $this->data = $data;
  }

  // inner content
  public function renderInner() {
    if(file_exists($this->template)){
        //Extracts vars to current view scope
        extract($this->data);
        ob_start();
        //Includes contents
        include $this->template;
        $output = ob_get_clean();
        return $output;
    } else {
       throw new Exception('template file does not exist');
    }
  }
  public function render() {
    $output = $this->renderInner();
    $title = $this->data['title'];
    ob_start();
    include $this->outerLayout;
    $buffer = ob_get_clean();
    return $buffer;
  }
}       

