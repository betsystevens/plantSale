<?php
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

  function getSubTotal($result) {
    foreach($result as $key => $row) {
      $result[$key]['amount'] = number_format((float)$row['amount'], 2, '.', '');
      $total = $result[$key]['retail'] * $result[$key]['qty']; 
      $result[$key]['total'] = number_format((float)$total, 2, '.', '');
    }
    return $result;
  }

  $f = fopen('php://memory', 'w');
  $delimiter = ",";

  switch($_GET['report']){
    case 'flower':
      $result = flowersOrdered($pdo);
      $filename = "fowersOrdered" . date('Ymd') . ".csv";
      $fields = array('qty', 'flower', 'variety', 'container', 'retail', 'total', 'cost', 'total');
      fputcsv($f, $fields, $delimiter);
      foreach ($result as $row) {
        fputcsv($f, $row, $delimiter);
      }
      break;
    case 'all':
      $result = everyThing($pdo);
      $result = getSubTotal($result);
      $filename = "allRecords2" . date('Ymd') . ".csv";
      $fields = array('oid', 'custLast', 'custFirst', 'scoutLast', 'scoutFirst', 'paytype', 'amount', 'qty','fname', 'fvariety', 'fcontainer', 'price', 'total');
      fputcsv($f, $fields, $delimiter);
      foreach ($result as $row) {
        fputcsv($f, $row, $delimiter);
      }
      break;
    case 'scoutOrders':
      $db = new DatabaseTable($pdo, 'scout', 'scoutid');
      $scoutId = $_GET['scoutId'];
      $result = $db->oneScoutsOrders($pdo, $scoutId);
      $fields = array('customer', 'order', 'qty', 'flower','variety', 'container');
      fputcsv($f, $fields, $delimiter);
      foreach($result as $key => $order) {
        fputcsv($f, [$key], $delimiter);
        foreach($order as $flower){
          array_unshift($flower, "");
          fputcsv($f, $flower, $delimiter);
        }
      }
      $filename = "scoutsOrders" . $scoutId . ".csv";
      break;
  }
  
  //move back to beginning of file
  fseek($f, 0);
  //set headers to download file rather than displayed
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');
  //output all remaining data on a file pointer
  fpassthru($f);
 