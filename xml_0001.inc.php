<?php
// ----------------------------------------------------------------------
// phpMyLib Version: 0.1.3 Release Date: 20140522
// © Copyright 2001-2024 Manu Herrán. Todos los derechos reservados
// Free download source code:
// https://manuherran.com/
// ----------------------------------------------------------------------
// Para mantener la compatibilidad entre editores de texto, en este 
// fichero se utilizará para identar el espacio, y no el tabulador
// ----------------------------------------------------------------------
// parsearXML
// xml_0001_fTrimXmlText
// xml_0001_fExtractXmlBetween
// xml_0001_fXmlTable2csvFile2D
// ----------------------------------------------------------------------
function parsearXML($str_dicc_xsl, $str_xml) {
  //Parsea el codigo XML $str_xml con el diccionario XSL $str_dicc_xsl y devuelve una cadena $str_out
  //con el resultado
  //$resultado =llamarHTTP("http://url.pl?param");
  //$str_dicc_xsl = read_file("amor.xsl");
  //$resultado = trim(parsearXML($str_dicc_xsl, $resultado));
  //$resultado = str_replace("\n", " ", $resultado);
  if (@xslt_process($str_dicc_xsl, $str_xml, $str_out)) {
    return $str_out;
  } else {
    echo ("Transformation failed.");
    echo "\tError number: " . xslt_errno() . "\n";
    echo "\tError string: " . xslt_error() . "\n";
    exit;
  }
}
// ----------------------------------------------------------------------
function xml_0001_fTrimXmlText($xmlData, $firstTag, $lastTag) {
  $ret = $xmlData;
  $ret = $firstTag . str_0001_rightSideOf($ret, $firstTag);
  $ret = str_0001_leftSideOf($ret, $lastTag) . $lastTag;
  return $ret;
}
// ----------------------------------------------------------------------
function xml_0001_fExtractXmlBetween($xmlData, $firstTag, $lastTag) {
  $ret = $xmlData;
  $ret = str_0001_rightSideOf($ret, $firstTag);
  $ret = str_0001_leftSideOf($ret, $lastTag);
  return $ret;
}
// ----------------------------------------------------------------------
function xml_0001_fXml2DTable2csvFormat($xmlData, $AR_fieldName, $AR_defaultValue, $lineSep, $fieldSep) {
  // Ejemplo de llamada:
  // $AR_fieldName = Array();
  // $AR_fieldName[1] = "productId";
  // $AR_fieldName[2] = "productCode";
  // $AR_fieldName[3] = "productName";
  // $AR_fieldName[4] = "largeImage";
  // $AR_defaultValue = Array();
  // $AR_defaultValue[1] = "";
  // $AR_defaultValue[2] = "";
  // $AR_defaultValue[3] = "";
  // $AR_defaultValue[4] = "";
  // print xml_0001_fXml2DTable2csvFormat($xmlData2, $AR_fieldName, $AR_defaultValue, "\n", " - ");
  $ret = "";
  $xmlParser = xml_parser_create();
  xml_parse_into_struct($xmlParser, $xmlData, $AR_val, $AR_index);
  xml_parser_free($xmlParser);
  $numItems = sizeof($AR_val); //count($AR_val);
  $numFields = sizeof($AR_fieldName);
  //print "\n\nProcesando " . $numItems . " items. Buscando " . $numFields . " campos\n";
  $contRows = 0;
  $lastFieldDetected = "";
  for($contItem = 0; $contItem < $numItems; $contItem++){ 
    $contField = 0;
    foreach ($AR_fieldName as $fieldName) {
      $contField++;
      //$ret = $ret . "(" . $contField . ")";
      if ($AR_val[$contItem]['tag'] == strtoupper($fieldName)) { 
        if ($fieldName == $lastFieldDetected) {
          $ret = $ret .  "|" . $AR_val[$contItem]['value'];
        } else {
          if ($contField > 1) {
            $ret = $ret . $fieldSep;
          }
          if ($AR_defaultValue[$contField] == "") {
            //print "c:" . $contItem . "=" . $AR_val[$contItem]['value'] . " ";
            //if (defined($AR_val[$contItem]['value'])) {
              $ret = $ret .  $AR_val[$contItem]['value'];
            //}  
          } else {
            $ret = $ret .  $AR_defaultValue[$contField];
          }
          if ($contField == $numFields) {
            $contRows++;
            //$ret = $ret . "(ENDROW" . $contRows . ")";
            $ret = $ret . $lineSep;
          }
        }
        $lastFieldDetected = $fieldName;
      }
    }
  }
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>