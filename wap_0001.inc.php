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
// fPrintWapRedirect
// ----------------------------------------------------------------------
function fPrintWapRedirect($urlRedirect) {
  $ret = "";
  $ret = $ret . "Content-type: text/vnd.wap.wml\n\n";
  $ret = $ret . "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
  $ret = $ret . "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">";
  $ret = $ret . "<wml>";
  $ret = $ret . "<card id=\"cargando\" title=\"cargando...\" ontimer=\"$urlRedirect\">";
  $ret = $ret . "<timer value=\"1\"/>";
  $ret = $ret . "</card>";
  $ret = $ret . "</wml>";
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>