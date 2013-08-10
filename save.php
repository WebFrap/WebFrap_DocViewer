<?php

include './conf/conf.php';
include './core/functions.php';

if (isset($_GET['page'])) {

  $tkn = explode( ':' , $_GET['page']);
  $page = DOC_ROOT.$tkn[0].'/doc/de/'. str_replace(array (
    '/', '.'
  ), array (
    '', '/'
  ), $tkn[1]) . '.php';

} else {

  $page = './doc/de/start.php';
}

if ('127.0.0.1' == $_SERVER ['SERVER_NAME']) {
  if (file_exists($page)) {
    if (isset($_POST['content'])) {
      file_put_contents($page,$_POST['content']);
    }
  }
}
?>