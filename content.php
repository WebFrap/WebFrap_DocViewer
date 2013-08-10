<div style="width:900px;" >
<?php
define('PHP_TAG', '<?php');

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

if (isset($_GET ['page'])) {

  $tkn = explode( ':' , $_GET ['page']);

  $page = DOC_ROOT.$tkn[0].'/doc/de/'. str_replace(array (
    '/', '.'
  ), array (
    '', '/'
  ), $tkn[1]) . '.php';

} else {

  $page = './doc/de/start.php';
}

if (file_exists($page)) {

  start_md();
  echo "<a href=\"editor.php?page=".$_GET['page']."\" class=\"clink\" >Seite Editieren</a><br />\n";
  include $page;
  echo render_md();

} elseif ('127.0.0.1' == $_SERVER ['SERVER_NAME']) {

  if (!is_dir(dirname($page)))
    mkdir(dirname($page), 0777, true);

  $tmp = explode('.', $_GET ['page']);

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
  echo "<a href=\"editor.php?page=".$_GET['page']."\" class=\"clink\" >Seite Editieren</a><br />\n";
  include $page;
  render_md();

} else {

  include 'doc/de/errors/404.php';
}
?>
</div>