<?php

/**
 * start code
 */
function start_highlight()
{

  render_md();
  ob_start();

} //end function start_highlight */


/**
 * start code
 */
function display_highlight($lang = 'php', $code = null)
{

  if (is_null($code)) {
    $code = trim(ob_get_contents());
    ob_end_clean();
  }

  if (class_exists('GeSHi')) {
    $geshi = new GeSHi($code, $lang);
    $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 10);
    $geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');
    $geshi->set_overall_style('width:750px;margin-bottom:10px;', true);
    echo $geshi->parse_code();

   //echo '<div style="width:750px;margin-bottom:10px;" >'.$geshi->parse_code().'</div>';
  } else {
    echo '<pre style="width:750px;margin-bottom:10px;" >' . htmlentities($code, ENT_QUOTES, 'utf-8') . '</pre>';
  }

  start_md();

} //end function display_highlight */


/**
 * Start a MD Render area
 */
function start_md()
{

  ob_start();
} //end function start_md */


/**
 * Render the markdown
 */
function render_md($content = null)
{

  if (is_null($content)) {
    $content = trim(ob_get_contents());
    ob_end_clean();
  }

  $markdownParser = new \dflydev\markdown\MarkdownParser();
  
  /*
  $content = preg_replace(
  	'#(\A|[^=\]\'"a-zA-Z0-9])(http[s]?://(.+?)/[^()<>\s]+)#i',
  	'\\1<a href="\\2" target="__new" >\\2</a>',
    $content
  );*/

  echo $markdownParser->transformMarkdown($content);

} //end function render_md */


function renderMenuTree($fileName)
{

  $jsonTree = json_decode(file_get_contents($fileName));

  return renderMenuSubtree($jsonTree, 1);

}

function renderMenuSubtree($subTree, $headLevel)
{

}

function renderGlosar($data)
{

  //$data = jspn
}


function renderTopMenu( $modules, $data)
{

  $code = '';
  $stack = array();

  foreach( $modules as $key ){

    // ignore nonloaded repos
    if ( !isset($data[$key]) )
      continue;

  $stack[] = <<<HTML
      <li><a onclick="show_chapter( '{$key}' );" href="#{$key}" >{$data[$key][0]}</a></li>
HTML;

  }

  return implode( ' <li>|</li> ', $stack );

}

function renderPageMenu($key)
{

  start_md();

  if ($key) {

    $tkn = explode( ':' , $key);

    $page = DOC_ROOT.$tkn[0].'/doc/de/'. str_replace(array (
      '/', '.'
    ), array (
      '', '/'
    ), $tkn[1]) . '/menu.php';

  } else {

    $page = './doc/de/menu.php';
  }

  include $page;

  return render_md();
}
