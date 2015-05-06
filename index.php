<?php
  include('./config.php');
  include(LOGIC_DIR.'functions.php');

  /*
  URL has format like this: page_name.php?link=[link_name]&action=[action_name]
  check GET parameter and his validation
  */

  $real_menu = array('main', 'row_history', 'card_gen');

  if (!isset($_GET['link'])) $_GET['link'] = 'main';
  if (!in_array($_GET['link'], $real_menu)) 
  {
    $_GET['link'] = 'main';
  }

  /*BEGIN CODE OF THE MAIN PAGES PARTS*/
  if (!$page = file_get_contents(TEMPLATE_DIR.'index.html'))
  {
    die('Cannot load index.html');
  }

  if (!$content['page_content'] = file_get_contents(TEMPLATE_DIR.$_GET['link'].'.html'))
  {
    die('Cannot load template');
  }
  
  if (!$content['page_header'] = file_get_contents(TEMPLATE_DIR.'header.html'))
  {
    die('Cannot load header.html');
  }

  if (!$content['page_footer'] = file_get_contents(TEMPLATE_DIR.'footer.html'))
  {
    die('Cannot load footer.html');
  }	
  /*END CODE OF THE MAIN PAGES PARTS, all another part must be down*/
  
  $content['page_title'] = 'Бонусні картки';
  $content['footer_content'] = 'Розроблено нашвидкоруч <a href=mailto:vyomail1985@gmail.com>VYO</a> 2015-'.date('Y').'рр.';
  $content['header_content'] = 'Список бонусних карток <a href=index.php?link=card_gen>Генератор карток</a>';
  
  include(LOGIC_DIR.$_GET['link'].'.php');
  
  /*replace all special words in template*/
  foreach ($content as $key => $value)
  {
    $page = str_replace('{'.$key.'}', $value, $page);
    //echo $key.' - '.$value.'<br>';
  }

  echo $page;
?>