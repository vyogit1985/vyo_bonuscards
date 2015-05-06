<?php
  if (!defined('TEMPLATE_DIR')) die('TEMPLATE_DIR not defined.');
  
  if (isset($_POST['search_button'])) {
    $where_clauses = '';
    if (!is_empty($_POST['serch_series'])) $where_clauses .= ' AND C.series = "'.$_POST['serch_series'].'"';
    if (!is_empty($_POST['serch_number'])) $where_clauses .= ' AND C.number = "'.$_POST['serch_number'].'"';
    if (!is_empty($_POST['serch_issuance_date'])) $where_clauses .= ' AND C.issuance_date = "'.$_POST['serch_issuance_date'].'"';
    if (!is_empty($_POST['serch_expiration_date'])) $where_clauses .= ' AND C.expiration_date = "'.$_POST['serch_expiration_date'].'"';
    if (!is_empty($_POST['serch_status'])) $where_clauses .= ' AND S.name = "'.$_POST['serch_status'].'"';
  
    //echo "Check where clause ".$where_clauses;
  }
  else $where_clauses = '';
  
  /*check WHERE expiration_date < NOW()*/
  $select_query = 'UPDATE card SET status_id = 2 WHERE expiration_date < NOW()';
  $result_query = db_query($select_query);

  $content['bonuscards_list'] = '';
  
  if (!$bonuscards_list_template = file_get_contents(TEMPLATE_DIR.'bonuscards_list.html')) {
    die('Cannot load bonuscards_list.html');
  }
  
  if (!$content['bonuscards_search'] = file_get_contents(TEMPLATE_DIR.'bonuscards_search.html'))
  {
    die('Cannot load bonuscards_search.html');
  }

  $select_query = 'SELECT COUNT(*) FROM card C JOIN status S ON C.status_id = S.id AND C.del_sign = 0 WHERE del_sign = 0'.$where_clauses;
  $result_query = db_query($select_query);
  $records_all = mysql_result($result_query, 0);

  if ($records_all == 0) {
    $content['bonuscards_list'] = 'Немає жодної бонусної карти...';
  }
  else {
    $select_query = 'SELECT C.id, C.series, C.number, C.issuance_date, C.expiration_date, S.name AS status 
      FROM card C JOIN status S ON C.status_id = S.id AND C.del_sign = 0'.$where_clauses;
    $result_query = db_query($select_query);
    
    /**/
    $temp_page = $bonuscards_list_template;
    $temp_page = str_replace('{row_history}', 'H', $temp_page);
    $temp_page = str_replace('{row_status}', 'S', $temp_page);
    $temp_page = str_replace('{row_delete}', 'D', $temp_page);
    $temp_page = str_replace('{bc_series}', 'Серія', $temp_page);
    $temp_page = str_replace('{bc_number}', 'Номер', $temp_page);
    $temp_page = str_replace('{bc_issuance_date}', 'Дата заведення', $temp_page);
    $temp_page = str_replace('{bc_expiration_date}', 'Дата закінчення', $temp_page);
    $temp_page = str_replace('{bc_status}', 'Статус', $temp_page);
    $content['bonuscards_list'] .= $temp_page;

    while ($row = mysql_fetch_assoc($result_query)) {    
      $temp_page = $bonuscards_list_template;
      $temp_page = str_replace('{row_history}', '<a href="index.php?link=row_history&id='.$row['id'].'">Історія</a>', $temp_page);
      $temp_page = str_replace('{row_status}', '<a href="index.php?link=row_history&id='.$row['id'].'&op=S">Змінити статус</a>', $temp_page);
      $temp_page = str_replace('{row_delete}', '<a href="index.php?link=row_history&id='.$row['id'].'&op=D">Видалити картку</a>', $temp_page);
      $temp_page = str_replace('{bc_series}', $row['series'], $temp_page);
      $temp_page = str_replace('{bc_number}', $row['number'], $temp_page);
      $temp_page = str_replace('{bc_issuance_date}', $row['issuance_date'], $temp_page);
      $temp_page = str_replace('{bc_expiration_date}', $row['expiration_date'], $temp_page);
      $temp_page = str_replace('{bc_status}', $row['status'], $temp_page);
      $content['bonuscards_list'] .= $temp_page;
    }
  }
?>