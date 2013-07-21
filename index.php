<?php
/*******************************************************************************
 *
 * @author      : Dominik Bonsch <dominik.bonsch@webfrap.net>
 * @date        :
 * @copyright   : Webfrap Developer Network <contact@webfrap.net>
 * @project     : Webfrap Web Frame Application
 * @projectUrl  : http://webfrap.net
 *
 * @licence     : BSD License see: LICENCE/BSD Licence.txt
 *
 * @version: @package_version@  Revision: @package_revision@
 *
 * Changes:
 *
 *******************************************************************************/

define('PHP_TAG', '<?php');

define('BUIZ',false);

// geshi einbinden
if (file_exists('./core/vendor/geshi/geshi.php'))
  include './core/vendor/geshi/geshi.php';

include './core/vendor/dflydev/markdown/IMarkdownParser.php';
include './core/vendor/dflydev/markdown/MarkdownParser.php';
include './core/vendor/dflydev/markdown/MarkdownExtraParser.php';
use dflydev\markdown\MarkdownParser;

include './conf/conf.php';
include './core/functions.php';
include './core/grid/SimpleGrid.php';
include './core/tree/TreeSimple.php';

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<title>WebFrap Dokumentation</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-Script-Type" content="application/javascript" />
<meta http-equiv="content-Style-Type" content="text/css" />
<meta http-equiv="content-language" content="de" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link href="./css/normalize.css" rel="stylesheet" type="text/css" />
<link href="./css/main.css" rel="stylesheet" type="text/css" />
<link href="./css/doc.css" rel="stylesheet" type="text/css" />
<link href="./css/jquery.treeview.css" rel="stylesheet" type="text/css" />

<link type="text/plain" rel="author" href="./humans.txt" />

</head>
<body>
  <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser.
    Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->

  <div id="docu-head" class="lbox" >
    <div class="headBox" >
      <h1>
        <a href="index.php" target="menu" >Web<span>Frap</span></a>
        <a href="index.php" target="menu" class="erDoc" >The Web Frame Application</a>
      </h1>
      <!-- <h3>&nbsp; just a placeholder for the space here </h3>-->
    </div>

    <ul class="topMenu" >
      <?php echo renderTopMenu( Conf::$modules, Conf::$topMenu ) ?>
    </ul>
  </div>

  <div id="docu-menu" class="lbox" >
  <?php echo renderPageMenu( isset($_GET['page'])?$_GET['page']:null ); ?>
  </div>


  <div id="docu-content" class="content lbox" >
    <div style="width:900px;" >
<?php

if (isset($_GET ['page'])) {
  $page = '../doc/de/' . str_replace(array (
    '/', '.'
  ), array (
    '', '/'
  ), $_GET ['page']) . '.php';
} else {
  $page = './doc/de/start.php';
}

if (file_exists($page)) {

  start_md();
  include $page;
  echo render_md();

} elseif ('127.0.0.1' == $_SERVER ['SERVER_NAME']) {

  if (!is_dir(dirname($page)))
    mkdir(dirname($page), 0777, true);

  $tmp = explode('.', $_GET['page']);

  $key = ucfirst(array_pop($tmp));

  file_put_contents( $page, <<<HTML
#{$key}

Hier könnte ihre Dokumentation stehen... Wenn sie endlich jemand schreiben würde...

## Codebeispiel
<?php start_highlight(); ?>
<_..._>
</_..._>
<?php display_highlight( 'xml' ); ?>
HTML
);

  start_md();
  include $page;
  render_md();

} else {
  include '../doc/de/errors/404.php';
}

?>
    </div>
  </div>

  <div id="docu-footer" class="lbox" >
Copyright usw.
  </div>


  <script type="application/javascript" src="./js/vendor/jquery-1.9.0.min.js"></script>
  <script type="application/javascript" src="./js/vendor/modernizr-2.6.2.min.js"></script>
  <script type="application/javascript" src="./js/plugins.js"></script>
  <script type="application/javascript" src="./js/main.js"></script>
  <script type="application/javascript" src="./js/jquery.treeview.js"></script>
  <script type="application/javascript" src="./js/d3.js"></script>
  <script type="application/javascript" src="./js/graphs.js"></script>
  <script type="application/javascript" src="./js/documentor.js"></script>
</body>

</html>
