<?php
  if (!defined('TEMPLATE_DIR')) die('TEMPLATE_DIR not defined.');
  
  $enable_op = array('S', 'D');
  
  if (isset($_GET['op']) && in_array($_GET['op'], $enable_op)) {
    if ($_GET['op'] == 'S') {
      $select_query = 'SELECT C.status_id FROM card C WHERE id = '.$_GET['id'];
      $result_query = db_query($select_query);
      $record_value = mysql_result($result_query, 0);
      
      if ($record_value == 1) $record_newvalue = 2;
      else $record_newvalue = 1;
      
      $select_query = 'UPDATE card SET status_id = '.$record_newvalue.' WHERE id = '.$_GET['id'];
      $result_query = db_query($select_query);
    }
    
    if ($_GET['op'] == 'D') {
      $select_query = 'UPDATE card SET del_sign = 1 WHERE id = '.$_GET['id'];
      $result_query = db_query($select_query);
    }
    
    header('location:index.php');
  }

  $content['bonuscards_history_list'] = '';
  
  if (!$bonuscards_list_template = file_get_contents(TEMPLATE_DIR.'row_history_list.html')) {
    die('Cannot load bonuscards_history_list.html');
  }

  $select_query = 'SELECT COUNT(*) FROM card_history WHERE card_id = '.$_GET['id'];
  $result_query = db_query($select_query);
  $records_all = mysql_result($result_query, 0);

  if ($records_all == 0) {
    $content['bonuscards_history_list'] = 'Немає жодних покупок по картці...';
  }
  else {
    $select_query = 'SELECT CH.id, CH.history_date, G.name AS goods, CH.amount
      FROM card_history CH JOIN goods G ON CH.goods_id = G.id
      WHERE card_id = '.$_GET['id'];
    $result_query = db_query($select_query);

    /**/
    $temp_page = $bonuscards_list_template;
    $temp_page = str_replace('{bc_history_date}', 'Дата операції', $temp_page);
    $temp_page = str_replace('{bc_goods}', 'Придбаний товар', $temp_page);
    $temp_page = str_replace('{bc_amount}', 'Сума витрат', $temp_page);
    $content['bonuscards_history_list'] .= $temp_page;
    
    while ($row = mysql_fetch_assoc($result_query)) {
      $temp_page = $bonuscards_list_template;
      $temp_page = str_replace('{bc_history_date}', $row['history_date'], $temp_page);
      $temp_page = str_replace('{bc_goods}', $row['goods'], $temp_page);
      $temp_page = str_replace('{bc_amount}', $row['amount'], $temp_page);
      $content['bonuscards_history_list'] .= $temp_page;
    }
  }
  
      
  $select_query = 'SELECT C.series, C.number FROM card C WHERE id = '.$_GET['id'].' LIMIT 1';
  $result_query = db_query($select_query);
   
  $row = mysql_fetch_assoc($result_query);
  $content['page_title'] = 'Історія по картці';
  $content['header_content'] = '<a href="index.php"><-</a>'.$row['series'].' '.$row['number']; 
?>