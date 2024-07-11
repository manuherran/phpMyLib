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
// jsval_0005_fTextBoxJsValidationCode
// ----------------------------------------------------------------------
function jsval_0005_fTextBoxJsValidationCode($lang, $textBoxJsVal, $formName, $textBoxName, $textBoxLabel) {
  $ret = "";

  $textBoxLabel = html_0001_stripHtmlTags($textBoxLabel);
  $textBoxLabel = preg_replace("/_HIDE_/", "", $textBoxLabel);
  $textBoxLabel = preg_replace("/&nbsp;/", " ", $textBoxLabel);
  $textBoxLabel = preg_replace("/\s+/", " ", $textBoxLabel);

  $elValorDe = "";
  $noPuedeSerVacio = "";
  $noEsUnDominioValido = "";
  $noEsUnEmailValido = "";
  $soloPuedeContenerNumeros = "";
  $soloPuedeContenerNumerosLetrasEtc = "";
  $noPuedeContenerEspacios = "";
  $noPuedeContenerComilla = "";

  if ($lang == "eng") {
    $elValorDe = "The value of";
    $noPuedeSerVacio = "can not be empty";
    $noEsUnDominioValido = "is not a valid domain name";
    $noEsUnEmailValido = "is not a valid email address";
    $soloPuedeContenerNumeros = "can contain only numbers";
    $soloPuedeContenerNumerosLetrasEtc = "can contain only numbers, letters and the _underscore_";
    $noPuedeContenerEspacios = "can not contain spaces";
    $noPuedeContenerComilla = "may not contain the single quote character";
  } else {
    $elValorDe = "El valor de";
    $noPuedeSerVacio = "no puede ser vacío";
    $noEsUnDominioValido = "no es un dominio válido";
    $noEsUnEmailValido = "no es un email válido";
    $soloPuedeContenerNumeros = "sólo puede contener números";
    $soloPuedeContenerNumerosLetrasEtc = "sólo puede contener números, letras _y el guión bajo_";
    $noPuedeContenerEspacios = "no puede contener espacios";
    $noPuedeContenerComilla = "no puede contener el caracter de comilla simple";
  }

  $textBoxLabel = trim($textBoxLabel);
  if ($textBoxLabel == "") {
    $textBoxLabel = $textBoxName;
  }

  if (preg_match ("/novacio/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (jsMyLib_val_0001_isEmpty(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $noPuedeSerVacio . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/dominio/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (!jsMyLib_val_0001_isDomain(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $noEsUnDominioValido . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/email/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (!jsMyLib_val_0001_isEmail(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $noEsUnEmailValido . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/numerico/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (isNaN(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $soloPuedeContenerNumeros . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/solonumerosletras/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (!jsMyLib_val_0001_isAlphanumeric(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $soloPuedeContenerNumerosLetrasEtc . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/numerico2/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (!jsMyLib_val_0001_isNumeric(document.forms['$formName'].$textBoxName.value)) {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $soloPuedeContenerNumeros . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/noespacios/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (jsMyLib_val_0001_containsChar(document.forms['$formName'].$textBoxName.value, \" \"))  {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $noPuedeContenerEspacios . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  if (preg_match ("/nocomillasimple/", $textBoxJsVal, $matches)) {
    $ret = $ret . "    } else if (jsMyLib_val_0001_containsChar(document.forms['$formName'].$textBoxName.value, \"'\"))  {\n";
    $ret = $ret . "      mensaje += \"" . $elValorDe . " '$textBoxLabel' " . $noPuedeContenerComilla . ". \";\n";
    $ret = $ret . "      alert(mensaje);\n";
  }
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>