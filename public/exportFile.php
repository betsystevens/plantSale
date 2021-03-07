<?php
  try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    switch($_GET['report']){
      case 'flower':
        $result = flowersOrdered($pdo);
        $filename = "fowersOrdered" . date('Ymd') . ".csv";
        $fields = array('qty', 'flower', 'variety', 'container', 'retail', 'total', 'cost', 'total');
        break;
      case 'all':
        $result = everyThing($pdo);
        $filename = "allRecords" . date('Ymd') . ".csv";
        $fields = array('oid', 'custLast', 'custFirst', 'scoutLast', 'scoutFirst', 'paytype', 'amount', 'qty','fname', 'fvariety', 'fcontainer');
        break;
    }
    $delimiter = ",";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    fputcsv($f, $fields, $delimiter);
    foreach ($result as $row) {
      fputcsv($f, $row, $delimiter);
    }
    //move back to beginning of file
    fseek($f, 0);
  
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
    // exit;
  }
  catch (PDOException $e) {
    $title = 'An error occurred';
    $output = 'Error occurred: ' . $e->getMessage() . ' in ' .
          $e->getFile() . ':' . $e->getLine();
}
?>
 
 