<?php
  $content['header_content'] = 'Список бонусних карток <a href=index.php>Головна сторінка</a>';
  if (isset($_POST['gen_button'])) {
  
    include('../config.php');
    include(LOGIC_DIR.'functions.php');
    
    $gen_count = $_POST['gen_count'];
      
    for($i = 1; $i <= $gen_count; $i++) {
      $select_query = 'INSERT INTO card(series, number, issuance_date, expiration_date, amount, status_id, del_sign)
	VALUES(\''.$_POST['gen_series'].'\', \''.generate_number().'\', NOW(), DATE_ADD(NOW(), INTERVAL '.$_POST['gen_date'].' MONTH), 0, 1, 0)';
      $result_query = db_query($select_query);
      //echo $select_query;
    }
    
    header('location:/bonuscards/index.php');
  }
?>