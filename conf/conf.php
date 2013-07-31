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

define( 'DOC_ROOT', realpath(__DIR__.'/../../').'/' );

function kw( $key ){

  static $kw = array(
    'platform.name' => 'WebFrap Plattform'
  );

  echo isset( $kw[$key] )? $kw[$key] : '??'.$key.'??';
}

class Conf
{

  public static $topMenu = array();

  public static $mainMenu = array();

  public static $data = array();

  public static $modules = array();

}
/*
if ('127.0.0.1' == $_SERVER ['SERVER_NAME'] ){
  Conf::$modules = array(
    'Buiznodes_42:org',
    'Buiznodes_42:buiz',
    'Buiznodes_42:architecture'
  );
}
*/

Conf::$modules = array_merge(Conf::$modules,array(
  'WebFrap_Doc:webfrap',
  'WebFrap_Wgt_Doc:wgt',
  'WebFrap_Wgt_Doc:ui',
  'WebFrap_Doc:wbf_arch',
  'WebFrap_Doc:gateway',
  'WebFrap_Genf_Doc:bdl',
  'WebFrap_Genf_Doc:genf',
  'WebFrap_Genf_Wbf_Doc:genf_wbf',
  'WebFrap_Vendor:vendor_lib',
  'WebFrap_Doc:admin_guide',
  'WebFrap_Doc:dev_guide',
  'WebFrap_Tools:tools',
  'WebFrap_Doc:user_guide',
));

foreach( Conf::$modules as $module ){

  $tkn   = explode( ':', $module );
  $fName = DOC_ROOT.$tkn[0].'/doc/de/'.$tkn[1].'/conf.php';

  // inkludieren der confs soweit vorhanden
  if ( file_exists( DOC_ROOT.$tkn[0].'/doc/de/'.$tkn[1].'/conf.php' ) )
    include $fName;

}
