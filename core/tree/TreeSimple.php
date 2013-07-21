<?php 
/**
 * No its no OOP, i know!
 * That's part of the plan.
 *
 */
class TreeSimple
{
  
  /**
   * @param stdClass
   *  class:string
   *  sub:[]
   * @param boolean $out, direkt per echo ausgeben?
   */
  public static function renderByJson( $data, $out = true )
  {
    
    $jsonData =json_decode($data);

    return self::render($jsonData, $out);
    
  }//end public static function render */
  
  /**
   * @param stdClass
   *  class:string
   *  sub:[]
   * @param boolean $out, direkt per echo ausgeben?
   */
  public static function render( $data, $out = true )
  {
    
    if ( !$data )
      return '<span>Invalid Input</span>';
    
    $html = '<ul class="'.$data->class.'" >';
    
    if (isset($data->sub)){
      foreach ( $data->sub as $subNode ){
        $html .= self::renderSubNode( $subNode );
      }
    }
    
    $html .= '</ul>';
    
    if ($out)
      echo $html;
      
    return $html;
    
    
  }//end public static function render */
  
  /**
   * @param stdClass
   *  text:string
   *  sub:[]
   *  
   * @return string, den gerenderten subtree
   */
  private static function renderSubNode( $data )
  {
    
    $html = '<li>';
    $html .= $data->text;
    if ( isset($data->sub)){
      $html .= '<ul>';
      foreach ( $data->sub as $subNode ){
        $html .= self::renderSubNode( $subNode );
      }
      $html .= '</ul>';
    }
    
    $html .= '</li>';
    
    return $html;
    
  }//end private static function renderSubNode */

}
