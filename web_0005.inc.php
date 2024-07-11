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
// web_0005_linkWithoutHttp
// web_0005_linkWithHttp
// ----------------------------------------------------------------------
// web_0005_fdLinkSimple
// web_0005_fdLinkSimpleNewWindow
// web_0005_fdLink
// web_0005_fddLink
// web_0005_fdLinkN
// web_0005_fiLink
// web_0005_fcLink
// web_0005_fdLinkNewWindow
// web_0005_fiLinkNewWindow
// web_0005_fcLinkNewWindow
// ----------------------------------------------------------------------
// web_0005_fPackUrlString
// web_0005_fButtonLink
// web_0005_fPrintRedirect
// web_0005_fPrintStandardValJsHtmlForm
// web_0005_fTextareaitems2Array
// web_0005_fiFrame
// web_0005_text2RichText
// web_0005_fPrintHistoryBackButton
// web_0005_fSelectItemsFromArray
// web_0005_fPrintAnchorage
// web_0005_fPrintYoutubeVideoContent
// web_0005_fOn2True
// web_0005_fOn2SI
// web_0005_fPrintHtmlImg
// web_0005_fPrintHtmlCropImg
// web_0005_fPrintHtmlFrameAndCropImg
// ----------------------------------------------------------------------
// urlencode / urldecode %20 rawurlencode
// ----------------------------------------------------------------------
function web_0005_linkWithoutHttp($url) {
  $url = preg_replace("'^http://'", "", $url);
  $url = preg_replace("'^https://'", "", $url);
  $url = preg_replace("'/$'", "", $url);
  return $url;
}
// ----------------------------------------------------------------------
function web_0005_linkWithHttp($cadena, $tipo, $texto, $returnIfVoid, $txtPre, $txtPost) {
  $ret = trim($cadena);

  if (strtolower($ret) == "http://") {
    $ret = "";
  }
  if (strtolower($ret) == "https://") {
    $ret = "";
  }

  if ($ret != '') {
    if (strtolower(substr($cadena,0,7)) != 'http://' and strtolower(substr($cadena,0,8)) != 'https://') {
      $ret = "http://" . $ret;
    }
    if ($tipo == "URL") {
      $ret = $txtPre . $ret . $txtPost;
    } elseif ($tipo == "LINK") {
      $ret = $txtPre . web_0005_fiLink($ret) . $txtPost;
    } elseif ($tipo == "LINK_NW") {
      $ret = $txtPre . web_0005_fiLinkNewWindow($ret) . $txtPost;
    } elseif ($tipo == "DLINK") {
      $ret = $txtPre . web_0005_fdLink($ret, $texto) . $txtPost;
    } elseif ($tipo == "DLINK_NW") {
      $ret = $txtPre . web_0005_fdLinkNewWindow($ret, $texto) . $txtPost;
    } else {
      $ret = $txtPre . $ret . $txtPost;
    }
  } else {
    $ret = $returnIfVoid;
  }

  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fdLinkSimple($url, $text) {
  return "<a href=\"" . $url . "\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fdLinkSimpleNewWindow($url, $text) {
  return "<a href=\"" . $url . "\" target=\"_blank\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fdLink($url, $text) {
  return "<a href=\"" . $url . "\" title=\"" . str_0001_fDoubleQuotes2SingleQuotes(html_0001_stripHtmlTags($text)) . "\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fdLinkN($url, $text) {
  return "<a href=\"" . $url . "\"  title=\"" . str_0001_fDoubleQuotes2SingleQuotes(html_0001_stripHtmlTags($text)) . "\" style=\"text-decoration:none;\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fddLink($url, $text1, $text2) {
  return "<a href=\"" . $url . "\" title=\"" . $text2 . "\">" . $text1 . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fiLink($url) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\">" . $url . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fiLinkMaxLen($url, $maxLen) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\">" . str_0001_shortText($url, $maxLen) . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fiLinkMaxLenShortLeft($url, $maxLen) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\">" . str_0001_shortTextLeft($url, $maxLen) . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fcLink($url, $text) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\">" . $url . "</a> " . $text;
}
// ----------------------------------------------------------------------
function web_0005_fdLinkNewWindow($url, $text) {
  return "<a href=\"" . $url . "\" title=\"" . str_0001_fDoubleQuotes2SingleQuotes(html_0001_stripHtmlTags($text)) . "\" target=\"_blank\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fiLinkNewWindow($url) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\" target=\"_blank\">" . $url . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fcLinkNewWindow($url, $text) {
  return "<a href=\"" . $url . "\" title=\"" . $url . "\" target=\"_blank\">" . $url . "</a> " . $text;
}
// ----------------------------------------------------------------------
function web_0005_fPackUrlString($parametros) {
  return urlencode($parametros);
}
// ----------------------------------------------------------------------
function web_0005_fButtonLink($formName, $url, $text) {
  return "<FORM style=\"margin:0; padding:0; display:inline;\" method=\"post\" name=\"$formName\" action=\"$url\"><input type=\"submit\" value=\"$text\"></form>";
}
// ----------------------------------------------------------------------
function web_0005_fPrintRedirect($url) {
  // header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $url_relativa);
  $ret = "";
  //$ret .= "Content-Type: text/html\n\n";
  $ret .= "<html><head>\n";
  $ret .= "<meta name=\"robots\" content=\"none\">";
  $ret .= "<meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
  $ret .= "<meta http-equiv=\"Cache-Control\" content=\"no-store\" forua=\"true\"/>\n";
  $ret .= "<meta http-equiv=\"Cache-Control\" content=\"max-age=0\" forua=\"true\"/>\n";
  $ret .= "<meta http-equiv=\"Cache-Control\" content=\"must-revalidate\" forua=\"true\"/>\n";
  $ret .= "<meta http-equiv=\"Expires\" content=\"Tue, 01 Jan 1980 1:00:00 GMT\" forua=\"true\"/>\n";
  $ret .= "<meta HTTP-EQUIV=Refresh CONTENT=\"0;URL=$url\">\n";
  $ret .= "<title></title></head>";
  $ret .= "<body></body></html>\n";
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fPrintStandardValJsHtmlForm($lang, $params) {

  $params = array_reverse($params);
  //5,6,3,7,6,4,4

  $formAction          = array_pop($params); // $vguThisProgramName, $vguValVG{"thisProgramName"}
  $formName            = array_pop($params); // form_...
  $cssStyle            = array_pop($params); // no, auto, <estilo>
  $jsValOfFields       = array_pop($params); // KTRUE, KFALSE. No cambia el numero de campos de los controles
  $formFocus           = array_pop($params); // no, default, <control>. Preferiblemente usar "no". Puede dar problemas.

  $tableIsOnlyRows     = array_pop($params); // KTRUE, KFALSE
  $tableMode           = array_pop($params); // vertical, horizontal, none
  $tableOptions        = array_pop($params); // qq(border="0" cellpadding="0" cellspacing="0" width="1" align="left")
  $fontFace            = array_pop($params); // "Verdana, Geneva, Arial, Helvetica, sans-serif", "Tahoma, Arial, Helvetica, sans-serif"
  $titleColor          = array_pop($params); // #888888, #008800, #0066CC, #99CCFF
  $titleText           = array_pop($params); // ...

  $td1Options          = array_pop($params); // qq(valign="center" align="center")
  $td2aOptions         = array_pop($params); // qq(valign="center" align="right" width="20%")
  $td2bOptions         = array_pop($params); // qq(valign="center" align="left")

  $buttonPosition      = array_pop($params); // 0
  $buttonCss           = array_pop($params); // no, auto, default ($cssStyle), <estilo>
  $buttonType          = array_pop($params); // Button, Image, Text
  $buttonProp          = array_pop($params); // qq(value="Borrar"), qq(value="Borrar" style="font-size: 7pt;"), qq(value="Borrar" style="font-size: 13px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif") qq(value="Cancelar Solicitud" style="font-size: 7pt; BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none MARGIN-TOP: -25px; MARGIN-LEFT: 84px; hspace=0; align=right; border=0;") color='#000000'
  $mouseOverChImg      = array_pop($params); // KTRUE, KFALSE 
  $mouseOverImg        = array_pop($params); // ...
  $mouseOutImg         = array_pop($params); // ...

  $boldLabels          = array_pop($params); // KTRUE, KFALSE
  $emptyCell           = array_pop($params); // ...
  $betweenLabelsSep    = array_pop($params); // ...
  $afterLabelSep       = array_pop($params); // ...
  $beforeSubmit        = array_pop($params); // ...
  $afterSubmit         = array_pop($params); // ...

  $font1               = array_pop($params); // textos
  $font2               = array_pop($params); // controles
  $font3               = array_pop($params); // botones
  $font4               = array_pop($params); // titulo

  $fontPx1             = array_pop($params); // textos
  $fontPx2             = array_pop($params); // controles
  $fontPx3             = array_pop($params); // botones
  $fontPx4             = array_pop($params); // titulo

  //$colsOfControl;                            // 0, 1, 2, 3
  //$cssOfControl;                             // no, auto, default ($cssStyle), <estilo>
  //$typeOfControl;                            // Hidden, HiddenAndText, Text, TextBox, Password, TextArea, ComboBox, CheckBox, Radio
  //$propOfControl;                            // qq(onfocus="window.status='Mensaje.';" onblur="window.status='';")

  $retError = "";
  $retCss = "";
  $retJs = "";
  $retHtml = "";
  $retPostJs1 = "";
  $retPostJs2 = "";

  //$beginB;
  //$EndB;
  if ($boldLabels == "True") {
    $beginB = "<b>";
    $EndB = "</b>";
  } elseif ($boldLabels == "False") {
    $beginB = "";
    $EndB = "";
  } else {
    $retError .= "Error boldLabels. ";
  }













  
  // Solo control de errores
  if (is_null($formAction)) {
    $retError .= "Error No se ha definido formAction. ";
  }
  if (is_null($formName)) {
    $retError .= "Error No se ha definido formName. ";
  }
  if ($tableMode == "vertical") {
  } elseif ($tableMode == "horizontal") {
  } elseif ($tableMode == "none") {
  } else {
    $retError .= "Error tableMode: $tableMode ";
  }
  if ($jsValOfFields != "True" and $jsValOfFields != "False") {
    $retError .= "Error jsValOfFields: $jsValOfFields ";
  }

  // Titulo y cabecera de tabla
  if ($tableIsOnlyRows == "True" or $tableMode == "none") {
  } elseif ($tableIsOnlyRows == "False") {
    $retHtml .= "\n";
    $retHtml .= "<p><b><font color=\"$titleColor\" face=\"$fontFace\" size=\"$font4\">$titleText</font></b></p>";
    $retHtml .= "<table $tableOptions>";
  } else {
    $retError .= "Error tableIsOnlyRows: $tableIsOnlyRows ";
  }

  //$retHtml .= qq(<FORM method="post" action="https://secure.nameservers.com/dominio.com/cgi-bin/$formAction" name="$formName">);
  //$retHtml .= qq(<FORM method="post" action="$formAction" name="$formName">);
  //2009
  //$retHtml .= "<FORM method=\"post\" action=\"$formAction\" name=\"$formName\" enctype=\"x-www-form-urlencoded\">";
  //2010
  $retHtml .= "<FORM style=\"margin:0; padding:0; display:inline;\" method=\"post\" action=\"$formAction\" name=\"$formName\" enctype=\"multipart/form-data\">";

  if ($cssStyle == "auto") {
    $retCss = $retCss . "\n";

    //$retCss = $retCss . qq(<STYLE type=text/css>.style1_$formName {\n);
    //$retCss = $retCss . qq(  FONT-SIZE: ) . $fontPx1 . qq(px; FONT-FAMILY: $fontFace\n);
    //$retCss = $retCss . qq(}\n);
    //$retCss = $retCss . qq(</STYLE>\n);
  
    $retCss = $retCss . "<STYLE type=text/css>.style2_$formName {\n";
    $retCss = $retCss . "  FONT-SIZE: " . $fontPx2 . "px; FONT-FAMILY: $fontFace\n";
    $retCss = $retCss . "}\n";
    $retCss = $retCss . "</STYLE>\n";
  
    $retCss = $retCss . "<STYLE type=text/css>.style3_$formName {\n";
    $retCss = $retCss . "  FONT-SIZE: " . $fontPx3 . "px; FONT-FAMILY: $fontFace\n";
    $retCss = $retCss . "}\n";
    $retCss = $retCss . "</STYLE>\n";
  
    //$retCss = $retCss . qq(<STYLE type=text/css>.style4_$formName {\n);
    //$retCss = $retCss . qq(  FONT-SIZE: ) . $fontPx4 . qq(px; FONT-FAMILY: $fontFace\n);
    //$retCss = $retCss . qq(}\n);
    //$retCss = $retCss . qq(</STYLE>\n);

    $retCss = $retCss . "\n";
  }

  if ($jsValOfFields == "True") {
    $retJs = $retJs . "\n";
    $retJs = $retJs . "<script type=\"text/javascript\" language=\"JavaScript\">\n";
    $retJs = $retJs . "// -----------------------------------------------------------------------\n";
    $retJs = $retJs . "// Javascript code automatically generated by phpMyLib\n";
    $retJs = $retJs . "// Free download source code:\n";
    $retJs = $retJs . "// http://www.phpMyLib.com/\n";
    $retJs = $retJs . "// -----------------------------------------------------------------------\n";
    $retJs = $retJs . "// jsMyLib Version: 0.1.1 Release Date: 20130903\n";
    $retJs = $retJs . "// © Copyright 1999-2014 jsMyLib\n";
    $retJs = $retJs . "// Free download source code:\n";
    $retJs = $retJs . "// http://www.jsMyLib.com/\n";
    $retJs = $retJs . "// -----------------------------------------------------------------------\n";
    $retJs = $retJs . "  function validar_$formName() {\n";
    if ($lang == "eng") {
      $retJs = $retJs . "    var mensaje = \"Some of the values entered is not correct. \";\n";
    } else {
      $retJs = $retJs . "    var mensaje = \"Alguno de los valores introducidos no es correcto. \";\n";
    }
    $retJs = $retJs . "    if (false) {\n";
  }

  if ($tableMode == "horizontal") {
    $retHtml .= "<tr>";
  }

  $riskControlsCounter = 0;
  $fileButtonAlreadyShowed = 0;
  $firstFocuseableControl = "";
  $topOfQueue = array_pop($params);
  while(!is_null($topOfQueue)) {
    // Estos son los 4 parametros obligatorios de todas las lineas de controles: cols, css, type y prop. El resto son diferentes en cada caso
    $colsOfControl = $topOfQueue;
    $cssOfControl  = array_pop($params);
    $typeOfControl = array_pop($params);
    $propOfControl = array_pop($params);
    if      ($typeOfControl == "Hidden") {
      // ----------------------------------------------------------------
      $hiddenName  = array_pop($params);
      $hiddenValue = array_pop($params);
      $retHtml .= "<INPUT type=\"hidden\" name=\"$hiddenName\" value=\"$hiddenValue\">";
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "HiddenAndText") {
      // ----------------------------------------------------------------
      $hiddenName  = array_pop($params);
      $textLabel   = array_pop($params);
      $hiddenValue = array_pop($params);
      $textText    = array_pop($params);
      $retHtml .= "<INPUT type=\"hidden\" name=\"$hiddenName\" value=\"$hiddenValue\">";
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } else {
        //$retHtml .= "<td colspan=\"3\" $td2aOptions>";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      $retHtml .= $beginB . $textLabel . $EndB;
      $retHtml .= $betweenLabelsSep;
      if ($colsOfControl == "3") {
        $retHtml .= "</font></td><td>$emptyCell</td><td $td2bOptions>";
        $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "</font></td><td $td2bOptions>";
        $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      }
      $retHtml .= "$textText\n";
      $retHtml .= "</font></td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "Text") {
      // ----------------------------------------------------------------
      $textLabel   = array_pop($params);
      $textText    = array_pop($params);
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } else {
        //$retHtml .= "<td colspan=\"3\" $td2aOptions>";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      $retHtml .= $beginB . $textLabel . $EndB;
      $retHtml .= $betweenLabelsSep;
      if ($colsOfControl == "3") {
        $retHtml .= "</font></td><td>$emptyCell</td><td $td2bOptions>";
        $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "</font></td><td $td2bOptions>";
        $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      }
      $retHtml .= "$textText\n";
      $retHtml .= "</font></td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------      
    } elseif ($typeOfControl == "TextBox" or $typeOfControl == "Pass" or $typeOfControl == "Password") {
      // ----------------------------------------------------------------
      //$typeFrm;
      $riskControlsCounter++;
      if ($typeOfControl == "TextBox") {
        $typeFrm = "text";
      } else {
        $typeFrm = "password";
      }
      $textBoxName         = array_pop($params);
      $textBoxLabel        = array_pop($params);
      $textBoxDefaultValue = array_pop($params);
      $textBoxSize         = array_pop($params);
      $textBoxMaxLength    = array_pop($params);
      $textBoxJsVal        = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $textBoxName;
      }
      if ($jsValOfFields == "True") {
        $retJs = $retJs . jsval_0005_fTextBoxJsValidationCode($lang, $textBoxJsVal, $formName, $textBoxName, $textBoxLabel);
      }
      if (preg_match("/^_HIDE_/", $textBoxLabel, $matches)) {
        $textBoxLabel = "";
      } else {
        $textBoxLabel = "<font face=\"$fontFace\" size=\"$font1\">$textBoxLabel</font>";
      }
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "<td $td2aOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "<td $td2aOptions>";
      } else {
        //$retHtml .= "<td $td2aOptions>";
      }
      $retHtml .= $beginB . $textBoxLabel . $EndB . $afterLabelSep . "\n";
      if ($colsOfControl == "1") {
        $retHtml .= "";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font2\"><INPUT $classPropOfControl type=\"$typeFrm\" name=\"$textBoxName\" size=\"$textBoxSize\" maxlength=\"$textBoxMaxLength\" value=\"$textBoxDefaultValue\" $propOfControl></font>";
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------      
    } elseif ($typeOfControl == "File") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $textBoxName         = array_pop($params);
      $textBoxLabel        = array_pop($params);
      $textBoxDefaultValue = array_pop($params);
      $textBoxSize         = array_pop($params);
      $textBoxMaxLength    = array_pop($params);
      $textBoxFileMaxSize  = array_pop($params);
      $textBoxFileAccept   = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $textBoxName;
      }
      if (preg_match("/^_HIDE_/", $textBoxLabel, $matches)) {
        $textBoxLabel = "";
      } else {
        $textBoxLabel = "<font face=\"$fontFace\" size=\"$font1\">$textBoxLabel</font>";
      }
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "<td $td2aOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "<td $td2aOptions>";
      } else {
        //$retHtml .= "<td $td2aOptions>";
      }
      $retHtml .= $beginB . $textBoxLabel . $EndB . $afterLabelSep . "\n";
      if ($colsOfControl == "1") {
        $retHtml .= "";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      if ($fileButtonAlreadyShowed == 0) {
        $retHtml .= "<INPUT type=\"hidden\" name=\"LIMITREQUESTBODY\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"UPLOAD_LIMIT\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"POST_MAX_SIZE\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"". $textBoxFileMaxSize . "\">";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font2\"><INPUT $classPropOfControl type=\"File\" accept=\"" . $textBoxFileAccept . "\" name=\"$textBoxName\" size=\"$textBoxSize\" maxlength=\"$textBoxMaxLength\" value=\"$textBoxDefaultValue\" $propOfControl></font>";
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      $fileButtonAlreadyShowed = 1;
      // ----------------------------------------------------------------      
    } elseif ($typeOfControl == "MultipleFile") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $textBoxName         = array_pop($params);
      $textBoxLabel        = array_pop($params);
      $textBoxDefaultValue = array_pop($params);
      $textBoxSize         = array_pop($params);
      $textBoxMaxLength    = array_pop($params);
      $textBoxFileMaxSize  = array_pop($params);
      $textBoxFileAccept   = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $textBoxName;
      }
      if (preg_match("/^_HIDE_/", $textBoxLabel, $matches)) {
        $textBoxLabel = "";
      } else {
        $textBoxLabel = "<font face=\"$fontFace\" size=\"$font1\">$textBoxLabel</font>";
      }
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "<td $td2aOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "<td $td2aOptions>";
      } else {
        //$retHtml .= "<td $td2aOptions>";
      }
      $retHtml .= $beginB . $textBoxLabel . $EndB . $afterLabelSep . "\n";
      if ($colsOfControl == "1") {
        $retHtml .= "";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      if ($fileButtonAlreadyShowed == 0) {
        $retHtml .= "<INPUT type=\"hidden\" name=\"LIMITREQUESTBODY\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"UPLOAD_LIMIT\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"POST_MAX_SIZE\" value=\"". $textBoxFileMaxSize . "\">";
        $retHtml .= "<INPUT type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"". $textBoxFileMaxSize . "\">";
      }
      $retHtml = $retHtml . "<font face=\"$fontFace\" size=\"$font2\"><INPUT $classPropOfControl type=\"File\" accept=\"" . $textBoxFileAccept . "\" name=\"" . $textBoxName . "[]\" size=\"$textBoxSize\" maxlength=\"$textBoxMaxLength\" value=\"$textBoxDefaultValue\" $propOfControl multiple/></font>";
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      $fileButtonAlreadyShowed = 1;
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "TextArea") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $textAreaName         = array_pop($params);
      $textAreaLabel        = array_pop($params);
      $textAreaDefaultValue = array_pop($params);
      $textAreaRows         = array_pop($params);
      $textAreaCols         = array_pop($params);
      $textAreaJsVal        = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $textAreaName;
      }
      if ($jsValOfFields == "True") {
        $retJs = $retJs . jsval_0005_fTextBoxJsValidationCode($lang, $textAreaJsVal, $formName, $textAreaName, $textAreaLabel);
      }
      if (preg_match("/^_HIDE_/", $textAreaLabel, $matches)) {
        $textAreaLabel = "";
      } else {
        $textAreaLabel = "<font face=\"$fontFace\" size=\"$font1\">$textAreaLabel</font>";
      }
      $retHtml .= "<tr>";
      if ($colsOfControl == "1" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "<td colspan=\"1\" $td2aOptions>";
      } else {
      }
      //201011
      //$retHtml .= "<p align=\"center\">" . $beginB . $textAreaLabel . $EndB . "</p>";
      $retHtml .= $beginB . $textAreaLabel . $EndB;
      if ($colsOfControl == "1") {
        $retHtml .= "";
      } elseif ($colsOfControl == "2" and $tableMode != "none") {
        $retHtml .= "</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3" and $tableMode != "none") {
        $retHtml .= "</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font2\"><TEXTAREA $classPropOfControl NAME=\"$textAreaName\" rows=\"$textAreaRows\" cols=\"$textAreaCols\" wrap=\"virtual\" maxlength=\"55000\" $propOfControl>";
      $retHtml .= $textAreaDefaultValue . "";
      $retHtml .= "</TEXTAREA></font>";
      $retHtml .= "</td></tr>";
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "ComboBox") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $comboBoxName         = array_pop($params);
      $comboBoxLabel        = array_pop($params);
      $comboBoxDefaultValue = array_pop($params);
      $comboBoxListOfValues = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $comboBoxName;
      }
      $comboBoxLabel = "<font face=\"$fontFace\" size=\"$font1\">$comboBoxLabel</font>";
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } else {
        $retHtml .= "<td $td2aOptions>";
      }
      $retHtml .= $beginB . $comboBoxLabel . $EndB . $afterLabelSep . "\n";
      if ($colsOfControl == "1") {
        $retHtml .= "";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font2\"><SELECT $classPropOfControl NAME=\"$comboBoxName\" $propOfControl>";
      $AR_listOfPairsOfValues = preg_split("'\#\#\#'", $comboBoxListOfValues);
      foreach ($AR_listOfPairsOfValues as $listOfPairsOfValues) {
        $AR_pair = preg_split("'---'", $listOfPairsOfValues);
        $leftSide = $AR_pair[0];
        $rightSide = $AR_pair[1];
        if ($comboBoxDefaultValue == $leftSide) {
          //$retHtml .= "<option value=\"$leftSide\" SELECTED $propOfControl>$rightSide\n";
          $retHtml .= "<option value=\"$leftSide\" SELECTED>$rightSide\n";
        } else {
          //$retHtml .= "<option value=\"$leftSide\" $propOfControl>$rightSide\n";
          $retHtml .= "<option value=\"$leftSide\">$rightSide\n";
        }
      }
      $retHtml .= "</SELECT></font>";
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "CheckBox") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $checkBoxName  = array_pop($params);
      $checkBoxLabel = array_pop($params);
      $checkBoxValue = array_pop($params);
      $checkBoxLabel = "<font face=\"$fontFace\" size=\"$font1\">$checkBoxLabel</font>";
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $checkBoxName;
      }
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "<td>$emptyCell</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "<td>$emptyCell</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      if ($checkBoxValue == "on") {
        $retHtml .= "<INPUT $classPropOfControl type=\"CHECKBOX\" name=\"$checkBoxName\" value=\"SI\" CHECKED $propOfControl> $checkBoxLabel\n";
      } else {
        $retHtml .= "<INPUT $classPropOfControl type=\"CHECKBOX\" name=\"$checkBoxName\" value=\"SI\" $propOfControl> $checkBoxLabel\n";
      }
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "Radio") {
      // ----------------------------------------------------------------
      $riskControlsCounter++;
      $radioName  = array_pop($params);
      $radioLabel = array_pop($params);
      $radioValue = array_pop($params);
      $radioChecked = array_pop($params);
      if ($firstFocuseableControl == "") {
        $firstFocuseableControl = $radioName;
      }
      if ($tableMode == "vertical") {
        $retHtml .= "<tr>";
      }
      if ($colsOfControl == "1") {
        $retHtml .= "<td colspan=\"3\" $td1Options>";
      } elseif ($colsOfControl == "2") {
        $retHtml .= "<td>$emptyCell</td><td colspan=\"2\" $td2bOptions>";
      } elseif ($colsOfControl == "3") {
        $retHtml .= "<td>$emptyCell</td><td>$emptyCell</td><td $td2bOptions>";
      } else {
      }
      $retHtml .= "<font face=\"$fontFace\" size=\"$font1\">";
      if ($cssOfControl == "no") {
        $classPropOfControl = "";
      } elseif ($cssOfControl == "auto") {
        $classPropOfControl = "class=style2_" . $formName;
      } elseif ($cssOfControl == "default") {
        $classPropOfControl = $cssStyle;
      } else {
        //$classPropOfControl = $cssOfControl;
        $classPropOfControl = "style=\"" . $cssOfControl . "\"";
      }
      if ($radioChecked == $radioValue) {
        $retHtml .= "<INPUT $classPropOfControl type=\"radio\" name=\"$radioName\" value=\"$radioValue\" CHECKED $propOfControl> " . $beginB . $radioLabel . $EndB . "\n";
      } else {
        $retHtml .= "<INPUT $classPropOfControl type=\"radio\" name=\"$radioName\" value=\"$radioValue\" $propOfControl> " . $beginB . $radioLabel . $EndB . "\n";
      }      
      $retHtml .= "</font>";
      $retHtml .= "</td>";
      if ($tableMode == "vertical") {
        $retHtml .= "</tr>";
      }
      // ----------------------------------------------------------------
    } elseif ($typeOfControl == "AutoAction") {
      // ----------------------------------------------------------------
      $autoActionActive  = array_pop($params);
      $autoActionTimer = array_pop($params);
      if ($autoActionActive == "on") {
        $retPostJs2 = $retPostJs2 . "<script language=\"javascript\">\n";
        $retPostJs2 = $retPostJs2 . "  timerID = setTimeout(\"validar_$formName()\", " . $autoActionTimer * 1000 . ");\n";
        $retPostJs2 = $retPostJs2 . "</script>\n";
      } else {
        //$retPostJs2 = $retPostJs2 . "<script language=\"javascript\">\n";
        //$retPostJs2 = $retPostJs2 . "  clearTimeout(timerID);\n";
        //$retPostJs2 = $retPostJs2 . "</script>\n";
      }
    } else {
      // ----------------------------------------------------------------
      $retError .= "Error typeOfControl: $typeOfControl ";
      // ----------------------------------------------------------------
    }
    $topOfQueue = array_pop($params);
  }

  $aMouseProp = "";
  if ($mouseOverChImg == "True") {
    $aMouseProp = "onMouseOver=\"document['btn_$formName'].src='$mouseOverImg'\;\" onMouseOut=\"document['btn_$formName'].src = '$mouseOutImg'\;\"";
  }

  if ($tableMode == "vertical") {
    $retHtml .= "<tr>";
  }

  $colsOfControl = $buttonPosition;
  if ($colsOfControl == "1" and $tableMode != "none") {
    $retHtml .= "<td colspan=\"3\" $td1Options>";
  } elseif ($colsOfControl == "2" and $tableMode != "none") {
    $retHtml .= "<td colspan=\"3\" $td2aOptions>";
  } elseif ($colsOfControl == "3" and $tableMode != "none") {
    $retHtml .= "<td colspan=\"1\" $td2aOptions></td><td>$emptyCell</td><td $td2bOptions>";
  } else {
    //$retHtml .= "<td colspan=\"3\" $td2aOptions>";
  }
  $retHtml .= $beforeSubmit;

  if ($buttonCss == "no") {
    $classPropOfControl = "";
  } elseif ($buttonCss == "auto") {
    $classPropOfControl = "class=style3_" . $formName;
  } elseif ($buttonCss == "default") {
    $classPropOfControl = $cssStyle;
  } else {
    $classPropOfControl = $buttonCss;
  }

  //if ($classPropOfControl == "") {
  //  $classPropOfControl = "style='font-size: " . $fontPx3 . "pt;'";
  //}

  //$retError .= "jsValOfFields: $jsValOfFields ";

  // document.forms['$formName'] --> document.getElementById('$formName')

  if ($lang == "esp") {
    $TXT_seguro = "¿Está seguro?";
  } else {
    $TXT_seguro = "Are you sure?";
  }

  if ($jsValOfFields == "True") {
    $retJs = $retJs . "    } else {\n";
    if (substr_count($formName, "delete") > 0) {
      $retJs = $retJs . "      if (confirm('" . $TXT_seguro . "')) {\n";
      $retJs = $retJs . "        jsMyLib_cssMyLib_0001_showMyLoadingPanel();\n";
      $retJs = $retJs . "        document.forms['$formName'].submit();\n";
      $retJs = $retJs . "      }\n";
    } else {
      $retJs = $retJs . "      jsMyLib_cssMyLib_0001_showMyLoadingPanel();\n";
      $retJs = $retJs . "      document.forms['$formName'].submit();\n";
    }
    $retJs = $retJs . "    }\n";
    $retJs = $retJs . "  }\n";
    $retJs = $retJs . "</script>\n";
    if ($buttonType == "Button") {
      $retHtml = $retHtml . "<font face=\"$fontFace\" size=\"$font3\"><INPUT $classPropOfControl type=\"button\" " . $buttonProp . " onClick=\"validar_$formName();\"></font>";
    } elseif ($buttonType == "Image") {
      $retHtml = $retHtml . "<a href=\"javascript:validar_$formName();\" " . $aMouseProp . "><img name=\"btn_$formName\" " . $buttonProp . "></a>";
    } elseif ($buttonType == "Text") {
    } else {
    }
  } else {
    if ($buttonType == "Button") {
      $retHtml = $retHtml . "<font face=\"$fontFace\" size=\"$font3\"><INPUT $classPropOfControl type=\"submit\" " . $buttonProp . "></font>";
    } elseif ($buttonType == "Image") {
      //$retHtml = $retHtml . "<a href=\"#\" " . $aMouseProp . "><INPUT type=\"image\" " . $buttonProp . "></a>";
      $retHtml = $retHtml . "<a href=\"javascript:document.forms['$formName'].submit();\" " . $aMouseProp . "><INPUT type=\"image\" " . $buttonProp . "></a>";
    } elseif ($buttonType == "Text") {
      //$retHtml = $retHtml . "<a href=\"" . $formAction . "\" onclick=\"javascript:document.forms['$formName'].submit();\" " . $aMouseProp . ">" . $buttonProp . "</a>";
      $retHtml = $retHtml . "<a href=\"javascript:document.forms['$formName'].submit();\" " . $aMouseProp . ">" . $buttonProp . "</a>";
    } else {
    }
  }
  $retHtml .= $afterSubmit;
  $retHtml .= "</FORM>";
  if ($tableMode != "none") {
    $retHtml .= "</td></tr>";
  }

  if ($tableIsOnlyRows == "False" and $tableMode != "none") {
    $retHtml .= "</table>";
  }

  $retPostJs1 = "";

  if ($formFocus == "default") {
    if ($firstFocuseableControl != "") {
      $retPostJs1 = $retPostJs1 . "<script language=\"JavaScript\">\n";
      #$retPostJs1 = $retPostJs1 . qq(  document.forms[0] ? document.forms[0].elements[0].focus() : 0;\n); # Lo posiciona en el primero aunque sea hidden
      $retPostJs1 = $retPostJs1 . "  document.forms['$formName'].$firstFocuseableControl.focus();\n";
      $retPostJs1 = $retPostJs1 . "</script>\n";
    }
  } elseif ($formFocus == "no") {
    $retPostJs1 = "";
  } else {
    if ($formFocus != "") {
      $retPostJs1 = $retPostJs1 . "<script language=\"JavaScript\">\n";
      $retPostJs1 = $retPostJs1 . "  document.forms['$formName'].$formFocus.focus();\n";
      $retPostJs1 = $retPostJs1 . "</script>\n";
    }
  }

  // 20171128 Manu
  if ($riskControlsCounter == 0) {
    return $retError . $retCss . $retJs . $retHtml . $retPostJs1 . $retPostJs2;
  } else {
    return "";
  }

}
// ----------------------------------------------------------------------
function web_0005_fTextareaitems2Array($texto, $why) {
  $AR_ret = array();
  $temp = trim($texto);
  if ($why == "RECORD") {
    $temp = str_replace("\r", "\n", $temp);
    //split --> explode
    $AR_ret = explode("\n", $temp);
  }
  if ($why == "EMAIL") {
    $temp = str_replace("\r", ";", $temp);
    $temp = str_replace("\n", ";", $temp);
    $temp = str_replace(",", ";", $temp);
    $temp = str_replace(":", ";", $temp);
    $temp = str_replace(" ", ";", $temp);
    $temp = str_replace("<", ";", $temp);
    $temp = str_replace(">", ";", $temp);
    $temp = str_replace("'", ";", $temp);
    $temp = str_replace("\"", ";", $temp);
    $temp = str_replace("\\", ";", $temp);
    $temp = str_replace("^t", ";", $temp);
    $temp = str_replace("\t", ";", $temp);
    $AR_ret = explode(";", $temp);
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function web_0005_fiFrame($url, $width, $height) {
  $ret = "";
  $ret = $ret . "<iframe src=\"" . $url . "\" width=\"" . $width . "\" height=\"" . $height . "\" border=\"0\" frameborder=\"0\" framespacing=\"0\"></iframe>";
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_text2RichText($texto) {
  $ret = $texto;
  // Primero convierto URL
  $ret = preg_replace("/http:(.*)\r/i", "<a href=\"http:\${1}\">http:\${1}</a>\r", $ret);
  // Segundo genero saltos de linea
  $ret = str_replace("\r", "<br>\r", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fPrintHistoryBackButton($text) {
  $ret = "";
  $ret = $ret . web_0005_fdLink("javascript:history.back();", $text);
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fArray2OneLineSepComboBoxListOfItems($AR_items) {
  $ret = "";
  $cont = 0;
  foreach ($AR_items as $index => $value) {
    $cont++;
    if ($cont == 1) {
      $ret = $ret . $index . "---" . $value;
    } else {
      $ret = $ret . "###" . $index . "---" . $value;
    }
  }
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fPrintAnchorage($aName) {
  return "<a href=\"#\" name=\"" . $aName . "\">" . $text . "</a>";
}
// ----------------------------------------------------------------------
function web_0005_fPrintYoutubeVideoContent($youtube_video_code, $width, $height) {
  $ret = "";
  if ($youtube_video_code != "") {
    $ret = $ret . "<div style=\"width:" . $width . "px; padding:2px; border:solid 1px #eee; margin:25px auto 25px auto;\">\n";
    $ret = $ret . "<object width=\"" . $width . "\" height=\"" . $height . "\"><param name=\"movie\" value=\"http://www.youtube.com/v/" . $youtube_video_code . "&rel=0&egm=0&showinfo=0&fs=1\"></param><param name=\"wmode\" value=\"transparent\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"http://www.youtube.com/v/" . $youtube_video_code . "&rel=0&egm=0&showinfo=0&fs=1\" type=\"application/x-shockwave-flash\" width=\"" . $width . "\" height=\"" . $height . "\" allowFullScreen=\"true\" wmode=\"transparent\"></embed></object>\n";
    $ret = $ret . "</div>\n";
  }  
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fOn2True($value) {
  if ($value == "on") {
    return "True";
  } else {
    return "False";
  }
}
// ----------------------------------------------------------------------
function web_0005_fOn2SI($value) {
  if ($value == "on") {
    return "SI";
  } else {
    return "";
  }
}
// ----------------------------------------------------------------------
function web_0005_fPrintHtmlImg($img, $link, $description, $width, $height) {
  $ret = "";
  if ($link == "") {
    $ret = $ret . "<img alt=\"" . $description . "\" title=\"" . $description . "\"  src=\"" . $img . "\" border=\"0\" width=\"" . $width . "\" height=\"" . $height . "\">";
  } else { 
    $ret = $ret . "<a href=\"" . $link . "\" style=\"text-decoration:none;\"><img alt=\"" . $description . "\" title=\"" . $description . "\"  src=\"" . $img . "\" border=\"0\" width=\"" . $width . "\" height=\"" . $height . "\"></a>";
  }
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fPrintHtmlCropImg($img, $link, $description, $trans, $width, $height) {
  $ret = "";
  $ret = $ret . "<table border=\"0\"><tr><td background=\"" . $img . "\"><a href=\"" . $link . "\" style=\"text-decoration:none;\"><img alt=\"" . $description . "\" title=\"" . $description . "\"  src=\"" . $trans . "\" border=\"0\" width=\"" . $width . "\" height=\"" . $height . "\"></a></td></tr></table>";
  return $ret;
}
// ----------------------------------------------------------------------
function web_0005_fPrintHtmlFrameAndCropImg($img, $link, $description, $frame, $trans, $width, $height) {
  $ret = "";
  $ret = $ret . "<table border=\"0\"><tr><td background=\"" . $img . "\"><img src=\"" . $trans . "\" border=\"0\" width=\"" . $width . "\" height=\"" . $height . "\"></td></tr></table>";
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>