<?php
// ----------------------------------------------------------------------
// phpMyLib Version: 0.1.3 Release Date: 20140522
// © Copyright 2001-2024 Manu Herrán. Todos los derechos reservados
// Free download source code:
// https://manuherran.com/
// ----------------------------------------------------------------------
// Para mantener la compatibilidad entre editores de texto, en este 
// fichero se utilizar�ara identar el espacio, y no el tabulador
// ----------------------------------------------------------------------
// html_0001
// ----------------------------------------------------------------------
// html_0001_htmlHead
// html_0001_htmlBrLike2TagBr
// html_0001_htmlMultiTagBr2DoubleBr
// html_0001_stripHtmlTags
// html_0001_quitarAcentos
// html_0001_ponerAcute
// html_0001_html2title
// html_0001_extractHtmlPrePost
// html_0001_fShowHiddenChars
// html_0001_dbText2richText
// html_0001_urlTextLinesToUrlLinks
// html_0001_shortInHtmlWordsLargerThan
// html_0001_utf8_decode
// ----------------------------------------------------------------------
// urlencode / urldecode %20 rawurlencode
// ----------------------------------------------------------------------
function html_0001_htmlHead($lang, $mlType, $charset, $more1, $more2) {
  // esp, eng
  // Html-Old, Html-Transitional, Html-Strict, Html-Facebook, Xml-Strict
  // None, iso-8859-1, UTF-8
  $ret = "";
  if ($mlType == "") {
    $mlType = "Html-Old";
  }
  if ($charset == "") {
    $charset = "None";
  }
  $lngTag1 = "";
  $lngTag2 = "";
  if ($lang == "esp") {
    $lngTag1 = " xml:lang=\"es\" lang=\"es\"";
    $lngTag2 = "lang=\"es-ES\"";
  } elseif ($lang == "eng") {
    $lngTag1 = " xml:lang=\"en\" lang=\"en\"";
    $lngTag2 = "lang=\"en-US\"";
  }
  if ($mlType == "Html-Old") {
    $ret = $ret . "<html>\n";
  } elseif ($mlType == "Html-Transitional") {
    $ret = $ret . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
    $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\"" . $lngTag1 . ">\n";
  } elseif ($mlType == "Html-Strict") {
    $ret = $ret . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
  } elseif ($mlType == "Html-Facebook") {
    $ret = $ret . "<html \n";
    $ret = $ret . "xmlns=\"http://www.w3.org/1999/xhtml\" \n";
    $ret = $ret . "xmlns:fb=\"http://www.facebook.com/2008/fbml\" \n";
    $ret = $ret . "xmlns:og=\"http://opengraphprotocol.org/schema/\" \n";
    $ret = $ret . $lngTag2 . " \n";
    $ret = $ret . ">\n";
  } elseif ($mlType == "Xml-Strict") {
    $ret = $ret . "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
    $ret = $ret . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
  } else {
    $ret = $ret . "<html>\n";
  }
  $ret = $ret . "<head>\n";
  if ($charset == "None") {
  } elseif ($charset == "iso-8859-1") {
    $ret = $ret . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
  } elseif ($charset == "UTF-8") {
    $ret = $ret . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
  } else {
  }
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_htmlBrLike2TagBr($htmlText) {
  $ret = $htmlText;
  $ret = str_replace("<p>", "[br]", $ret);
  $ret = str_replace("<br>", "[br]", $ret);
  $ret = str_replace("<table>", "[br]", $ret);
  $ret = str_replace("<tr>", "[br]", $ret);
  $ret = str_replace("<td>", "[br]", $ret);
  $ret = str_replace("<div>", "[br]", $ret);
  $ret = str_replace("</p>", "[br]", $ret);
  $ret = str_replace("</div>", "[br]", $ret);
  $ret = str_replace("</em>", "[br]", $ret);
  $ret = str_replace("</blockquote>", "[br]", $ret);
  $ret = str_replace("</li>", "[br]", $ret);
  $ret = str_replace("</ul>", "[br]", $ret);
  $ret = str_replace("</h1>", "[br]", $ret);
  $ret = str_replace("</h2>", "[br]", $ret);
  $ret = str_replace("</h3>", "[br]", $ret);
  $ret = str_replace("</h3>", "[br]", $ret);
  $ret = str_replace("</h4>", "[br]", $ret);

  $ret = preg_replace("/\[br\]+\s+/", "[br]", $ret);
  $ret = preg_replace("/\s+\[br\]+/", "[br]", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_htmlMultiTagBr2DoubleBr($txt) {
  $ret = $txt;
  $ret = preg_replace("/\[br\]+\s+/", "[br]", $ret);
  $ret = preg_replace("/\s+\[br\]+/", "[br]", $ret);
  $ret = preg_replace("/\[br\]+/", "\n<br><br>\n", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_stripHtmlTags($htmlText) {
  // --------------------------------------------------------------------
  // Antes de usar esta función hay que eliminar los saltos de linea
  // --------------------------------------------------------------------
  $ret = $htmlText;
  //v1: $ret =~ s/<\S[^>]*>//g;
  //v2: $ret = preg_replace("/<\S[^>]*>/", "", $ret);
  // \S es cualquier cosa que no sea un espacio
  // ^> es cualquier cosa que no sea >
  // v2 funciona porque despues de < casi siempre viene una letra
  // pero esa expresion deberia ser <[^>]*>
  // Esto: <[^>]*> es cualquier cosa entre corchetes

  $ret = preg_replace("/<!--(.*?)-->/", "", $ret);
  $ret = preg_replace("/<style(.*?)<\/style>/i", "", $ret);
  $ret = preg_replace("/<script(.*?)<\/script>/i", "", $ret);
  $ret = preg_replace("/<[^>]*>/", "", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_quitarAcentos($texto) {
  $ret = $texto;

  $ret = str_replace("á", "a", $ret);
  $ret = str_replace("à", "a", $ret);
  $ret = str_replace("ä", "a", $ret);
  $ret = str_replace("é", "e", $ret);
  $ret = str_replace("è", "e", $ret);
  $ret = str_replace("ë", "e", $ret);
  $ret = str_replace("í", "i", $ret);
  $ret = str_replace("ì", "i", $ret);
  $ret = str_replace("ï", "i", $ret);
  $ret = str_replace("ó", "o", $ret);
  $ret = str_replace("ò", "o", $ret);
  $ret = str_replace("ö", "o", $ret);
  $ret = str_replace("ú", "u", $ret);
  $ret = str_replace("ù", "u", $ret);
  $ret = str_replace("ü", "u", $ret);
  $ret = str_replace("Á", "A", $ret);
  $ret = str_replace("À", "A", $ret);
  $ret = str_replace("Ä", "A", $ret);
  $ret = str_replace("É", "E", $ret);
  $ret = str_replace("È", "E", $ret);
  $ret = str_replace("Ë", "E", $ret);
  $ret = str_replace("Í", "I", $ret);
  $ret = str_replace("Ì", "I", $ret);
  $ret = str_replace("Ï", "I", $ret);
  $ret = str_replace("Ó", "O", $ret);
  $ret = str_replace("Ò", "O", $ret);
  $ret = str_replace("Ö", "O", $ret);
  $ret = str_replace("Ú", "U", $ret);
  $ret = str_replace("Ù", "U", $ret);
  $ret = str_replace("Ü", "U", $ret);

  $ret = str_replace("ÿ", "y", $ret);
  $ret = str_replace("Ý", "Y", $ret);

  // Opcional, nueva versión
  //$ret = str_replace("ñ", "n", $ret);
  //$ret = str_replace("Ñ", "N", $ret);

  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_ponerAcute($texto) {

  $ret = $texto;
  $ret = str_replace("á", "&aacute;", $ret);
  $ret = str_replace("é", "&eacute;", $ret);
  $ret = str_replace("í", "&iacute;", $ret);
  $ret = str_replace("ó", "&oacute;", $ret);
  $ret = str_replace("ú", "&uacute;", $ret);

  $ret = str_replace("Á", "&Aacute;", $ret);
  $ret = str_replace("É", "&Eacute;", $ret);
  $ret = str_replace("Í", "&Iacute;", $ret);
  $ret = str_replace("Ó", "&Oacute;", $ret);
  $ret = str_replace("Ú", "&Uacute;", $ret);

  $ret = str_replace("ü", "&uacute;", $ret);
  $ret = str_replace("Ü", "&Uacute;", $ret);

  $ret = str_replace("ñ", "&ntilde;", $ret);
  $ret = str_replace("Ñ", "&Ntilde;", $ret);

  $ret = str_replace("¡", "&iexcl;", $ret);
  $ret = str_replace("¿", "&#191;", $ret);

  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_html2title($htmlText) {
  $ret = "";
  if (preg_match("/<title\s*>(.+?)<\/title\s*>/i", $htmlText, $matches)) {
    $ret = $matches[1];
  }
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_extractHtmlPrePost($htmlText, $pre, $post) {
  $ret = "";
  $htmlText = str_replace("\r", "", $htmlText);
  $htmlText = str_replace("\n", "", $htmlText);
  $htmlText = str_replace("
", "", $htmlText);
  if (preg_match("/$pre(.+?)$post/i", $htmlText, $matches)) {
    $ret = $matches[1];
  }
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_fShowHiddenChars($texto) {
  //fWritePropFile($vguEntornoSistemaDeEjecucion, "./inc/lib/prueba.txt", $texto, "0666");
  $ret = $texto;
  //foreach ($texto as $line) {
  //  $ret = $ret . "1<br>";
  //}
  $ret = str_replace("\r\n", "[rn]\r\n", $ret);
  $ret = str_replace("\r", "[r]\r", $ret);
  $ret = str_replace("\n", "[n]\n", $ret);
  $ret = str_replace("\t", "[t]\t", $ret);
  //$ret = str_replace("", "[xn]", $ret);
  //$ret = str_replace("%0D", "[r]%0D", $ret);
  //$ret = str_replace("%0A", "[n]%0A", $ret);
  $ret = "<textarea cols=80 rows=20>" . $ret . "</textarea>";
  //$ret = "<pre>" . $ret . "</pre>";

  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_dbText2richText($texto) {
  $ret = $texto;

  // Asi, si la ultima linea es texto url sin salto, funciona el reemplazo de texto url
  //$ret = $ret . "\n\r";
  $ret = $ret . "\r";

  // Convierto url en links
  $ret = html_0001_urlTextLinesToUrlLinks($ret);

  // Segundo genero saltos de linea
  $ret = str_replace("\r", "<br>\r", $ret);

  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_urlTextLinesToUrlLinks($texto) {
  $ret = $texto;
  
  $ret = $ret . "\r";

  if (substr_count($texto, "algun texto clave para mostrar debug") > 0) {
    print "<textarea>\n\n";
    print $texto;
    print "</textarea>";
  }

  $ret = str_replace("\n", "\r", $ret);
  $ret = str_replace("\r", "\r", $ret);

  // Completo URL sin http al principio
  $ret = str_replace("\rwww.", "\rhttp://www.", $ret);

  // Convierto URL en links. Por algun motivo hace una de cada dos. Si se hace dos veces se arregla
  for ($i=1;$i<=2;$i++) {
    $ret = preg_replace("/\rhttp\:(.*?)\s*\r/i", "\r<a href=\"http:\${1}\" title=\"http:\${1}\" target=\"_blank\">http:\${1}</a>\r", $ret);
    $ret = preg_replace("/\rhttps\:(.*?)\s*\r/i", "\r<a href=\"https:\${1}\" title=\"https:\${1}\" target=\"_blank\">https:\${1}</a>\r", $ret);
    // Estas dos son las que creo que están funcionando. Por eso la ultima linea no la convierte (le falta el <br>)
    $ret = preg_replace("/<br>http\:(.*?)\s*<br>/i", "<br><a href=\"http:\${1}\" title=\"http:\${1}\" target=\"_blank\">http:\${1}</a><br>", $ret);
    $ret = preg_replace("/<br>https\:(.*?)\s*<br>/i", "<br><a href=\"https:\${1}\" title=\"https:\${1}\" target=\"_blank\">https:\${1}</a><br>", $ret);
  }

  // Convierto URL en links (old)
  //$ret = preg_replace("/\nhttp\:(.*?)\n/i", "\n<a href=\"http:\${1}\" title=\"http:\${1}\" target=\"_blank\">http:\${1}</a>\n", $ret);
  //$ret = preg_replace("/\nhttps\:(.*?)\n/i", "\n<a href=\"https:\${1}\" title=\"https:\${1}\" target=\"_blank\">https:\${1}</a>\n", $ret);

  // Por algun motivo la última linea no la convierte a URL

  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_shortInHtmlWordsLargerThan($text, $max) {
  $ret = "";
  //$text = str_replace("\r", " ", $text);
  //$text = str_replace("\n", " ", $text);
  //$text = trim($text);
  $debug=0;
  // Todos los tags a la izquierda los paso a la salida, hasta que termine el html
  while (preg_match("/^(<[^>]*?>)(.*)$/", $text, $matches)) {
    if ($debug==1) {
      print "<br>";
      print "a=" . $matches[1] . "<br>";
      print "b=" . $matches[2] . "<br>";
      print "<br>";
    }
    $ret = $ret . $matches[1];
    $text = $matches[2];
  }
  // Lo que tengo ahora seguro que es texto, o vacio
  if ($text != "") {
    if (preg_match("/^([^<]*)(.*)$/", $text, $matches)) {
      if ($debug==1) {
        print "<br>";
        print "c=" . $matches[1] . "<br>";
        print "d=" . $matches[2] . "<br>";
        print "<br>";
      }
      $ret = $ret . str_0001_shortWordsLargerThan($matches[1], $max);
      $ret = $ret . html_0001_shortInHtmlWordsLargerThan($matches[2], $max);
    }
  }
  return $ret;
}
// ----------------------------------------------------------------------
function html_0001_utf8_decode($text) {
  $ret = $text;
  if (1 == 1) {
    $ret = utf8_decode($ret);
  } else {
    $ret = str_replace("Ã¡", "á", $ret);
    $ret = str_replace("Ã©", "é", $ret);
    $ret = str_replace("Ã­", "í", $ret);
    $ret = str_replace("Ã³", "ó", $ret);
    $ret = str_replace("Ãº", "ú", $ret);
    $ret = str_replace("Ã±", "ñ", $ret);
  }
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>