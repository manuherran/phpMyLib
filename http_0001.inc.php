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
// peticionHttpGet --> http_0001_fHttpGetRequest
// http_0001_fHttpGetRequest
// http_0001_fHttpGetFlexibleRequest
// readGlobalInputVar
// http_0001_fTrueRemoteAddr
// http_0001_fPrintObjectHttpContentTypeHeader
// ----------------------------------------------------------------------
// http://es.php.net/manual/es/function.fopen.php
// ----------------------------------------------------------------------
function peticionHttpGet($url, $maxLines, $maxLineSize) {
  return http_0001_fHttpGetRequest($url, $maxLines, $maxLineSize);
}
// ----------------------------------------------------------------------
function http_0001_fHttpGetRequest($url, $maxLines, $maxLineSize) {
  // URL file-access is disabled in the server configuration
  // .htaccess: php_value allow_url_fopen = On
  // .htaccess: php_value allow_url_fopen On
  // php.ini allow_url_fopen = On

  // ini_set("php_value allow_url_fopen", true);
  // ini_set("php_value allow_url_fopen", 1);

  // fopen --> file_get_contents
  // fopen --> cURL 

  if ($maxLines == "" or $maxLines < 1) {$maxLines = 900;}
  if ($maxLineSize == "" or $maxLineSize < 1) {$maxLineSize = 4096;}
  $ret = "";
  if (1==1 or $hostType == "okt") {
    $fd=@fopen($url, "r");
  } else {
    $fd=fopen($url, "r");
  }
  if ($fd) {
    $peligro=0;
    while (!feof($fd) and $peligro < $maxLines) {
      $peligro++;
      $linea = fgets($fd, $maxLineSize);
      $ret .= $linea;
    }
    fclose ($fd);
    return $ret;
  } else {
    //print "Error $url <br>";
    return "Error: " . $url;
  }
}
// ----------------------------------------------------------------------
function http_0001_fHttpGetFlexibleRequest($hostType, $url, $maxLines, $maxLineSize, $showErrors, $returnIfError) {
  //if (intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
  if (intval(get_cfg_var('allow_url_fopen')) && function_exists('file_get_contents')) {
    // Webstorage
    // OVH
    //$ret = @readfile($url); 
    //$ret = readfile($url); 
    $ret = file_get_contents($url); 
  } elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
    if ($content = @file($url)) {
      $ret = @join('', $content);
    }
  } elseif(function_exists('curl_init')) {
    $ch = curl_init ($url);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec ($ch);
    if (curl_error($ch)) {
      //$ret = "Error 1 " . $url;
    }
    curl_close ($ch);
  } else {
    //$ret = "Error 0 " . $url;
  }
  return $ret;
}
// ----------------------------------------------------------------------
function readGlobalInputVarSIMPLE($name) {
// !isset is_null
  if (!(isset($_POST[$name]))) {
    if (!(isset($_GET[$name]))) {
      if (!(isset($_COOKIE[$name]))) {
        return "";
      } else {
        return $_COOKIE[$name];
      }
    } else {
      return $_GET[$name];
    }
  } else {
    return $_POST[$name];
  }
}
// ----------------------------------------------------------------------
function readGlobalInputVar($name) {
// !isset is_null
  if (!(isset($_POST[$name]))) {
    if (!(isset($_GET[$name]))) {
      if (!(isset($_COOKIE[$name]))) {
        //if (defined($_REQUEST[$name])) {
        if (isset($_REQUEST[$name])) {
          return $_REQUEST[$name];
        } else {
          return "";
        }
      } else {
        return $_COOKIE[$name];
      }
    } else {
      return $_GET[$name];
    }
  } else {
    return $_POST[$name];
  }
}
// ----------------------------------------------------------------------
function readGlobalInputVar2($name) {
  //if (defined($_REQUEST[$name])) {
  if (isset($_REQUEST[$name])) {
    return $_REQUEST[$name];
  } else {
    return "";
  }
}
// ----------------------------------------------------------------------
function http_0001_fTrueRemoteAddr() {
  if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
    //return $_SERVER["HTTP_X_FORWARDED_FOR"];
    return getenv("HTTP_X_FORWARDED_FOR");
  } else {
    //return $_SERVER["REMOTE_ADDR"];
    return getenv("REMOTE_ADDR");
  }
}
// ----------------------------------------------------------------------
function http_0001_fPrintObjectHttpContentTypeHeader($lang, $contentType, $charset, $downloadableFileName, $realFileName) {
  $ret = "";
  if ($contentType == "dynamic_excel") {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"" . $downloadableFileName . "\""); 
    header("Content-length: " . filesize($realFileName));
    $ret = $ret . "<html>\n";
    $ret = $ret . "<head>\n";
    //$ret = $ret . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
  } elseif ($contentType == "dynamic_txt") {
    header("Content-Type: text/plain");
  } elseif ($contentType == "zip") {
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    //header("Content-type: application/zip");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $downloadableFileName . "\""); 
    header("Content-length: " . filesize($realFileName));
    header("Content-Transfer-Encoding: binary");
  } elseif ($contentType == "word" or $contentType == "word-doc" or $contentType == "word-docx") {
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=\"" . $downloadableFileName . "\""); 
    header("Content-length: " . filesize($realFileName));
  } elseif ($contentType == "excel") {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"" . $downloadableFileName . "\""); 
    header("Content-length: " . filesize($realFileName));
  } elseif ($contentType == "png") {
    header("Content-type: image/png");
  } elseif ($contentType == "txt") {
    header("Content-type: text/plain");
  } else {
    header("Content-Type: text/html");
    $ret = $ret . "ERROR Content-Type\n";
  }
  return $ret;
}
// ----------------------------------------------------------------------
// Redireccionador:
// web_0005_fPrintRedirect
// header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $url_relativa);
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>