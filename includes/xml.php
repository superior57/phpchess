<?php

  ////////////////////////////////////////////////////////////////////////////
  //
  // (c) phpChess Limited, 2004-2006, in association with Goliath Systems. 
  // All rights reserved. Please observe respective copyrights.
  // phpChess - Chess at its best
  // you can find us at http://www.phpchess.com. 
  //
  ////////////////////////////////////////////////////////////////////////////

  if(!defined('CHECK_PHPCHESS')){
    die("Hacking attempt");
    exit;
  }

  /**********************************************************************
  * xmlize
  *
  */
  function xmlize($data, $WHITE=1){

    $data = trim($data);
    $vals = $index = $array = array();
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, $WHITE);

    if(!xml_parse_into_struct($parser, $data, $vals, $index)){
	die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($parser)),
                    xml_get_current_line_number($parser)));

    }

    xml_parser_free($parser);

    $i = 0; 
    $tagname = $vals[$i]['tag'];

    if(isset ($vals[$i]['attributes'])){
      $array[$tagname]['@'] = $vals[$i]['attributes'];
    }else{
      $array[$tagname]['@'] = array();
    }

    $array[$tagname]["#"] = xml_depth($vals, $i);

    return $array;

  }


  /**********************************************************************
  * xml_depth
  *
  */
  function xml_depth($vals, &$i){
 
    $children = array(); 

    if(isset($vals[$i]['value'])){
      array_push($children, $vals[$i]['value']);
    }

    while(++$i < count($vals)){ 

      switch ($vals[$i]['type']){ 

        case 'open': 
          
          if(isset($vals[$i]['tag'])){
            $tagname = $vals[$i]['tag'];
          }else{
            $tagname = '';
          }

          if(isset($children[$tagname])){
            $size = sizeof($children[$tagname]);
          }else{
            $size = 0;
          }

          if(isset($vals[$i]['attributes'])){
            $children[$tagname][$size]['@'] = $vals[$i]["attributes"];
          }

          $children[$tagname][$size]['#'] = xml_depth($vals, $i);
          break; 

        case 'cdata':
          array_push($children, $vals[$i]['value']); 
          break; 

        case 'complete': 
          $tagname = $vals[$i]['tag'];

          if(isset($children[$tagname])){
            $size = sizeof($children[$tagname]);
          }else{
            $size = 0;
          }

          if(isset($vals[$i]['value'])){
            $children[$tagname][$size]["#"] = $vals[$i]['value'];
          }else{
            $children[$tagname][$size]["#"] = '';
          }

          if(isset($vals[$i]['attributes'])){
            $children[$tagname][$size]['@'] = $vals[$i]['attributes'];
          }
          break; 

        case 'close':
          return $children; 
          break;
      } 

    } 

    return $children;

  }


  /**********************************************************************
  * traverse_xmlize
  *
  */
  function traverse_xmlize($array, $arrName = "array", $level = 0){

    foreach($array as $key=>$val){

      if(is_array($val)){
        traverse_xmlize($val, $arrName . "[" . $key . "]", $level + 1);
      }else{
        $GLOBALS['traverse_array'][] = '$' . $arrName . '[' . $key . '] = "' . $val . "\"\n";
      }
    
    }

    return 1;

  }

?>