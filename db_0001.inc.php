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
// db_0001_fArFreeDBOneRowQuery      = db_0001_fFreeDBOneRowArrayQuery ¿?
// db_0001_fFreeDBOneRowQuery        <-- Devuelve cadena
// db_0001_fFreeDBOneRowArrayQuery   <-- Devuelve array
// ----------------------------------------------------------------------
// db_0001_fFreeDBNRowQuery          <-- Devuelve array
// db_0001_fFreeDBNRowNotArrayQuery  <-- Devuelve cadena
// ----------------------------------------------------------------------
// db_0001_fFreeDBHtmlTableQuery
// db_0001_fFreeDBNoSelectQuery
// db_0001_fDBRowExists
// ----------------------------------------------------------------------
// db_0001_fLoadDb1RowQueryToArrayAsocIdData
// db_0001_fLoadDbNRowQueryToArrayAsocIdDataOne
// db_0001_fLoadDbNRowQueryToArrayAsocIdDataByOrder
// db_0001_fLoadDbNRowQueryToArrayAsocIdDataById
// db_0001_fPrepareStringToBuildSql <-- db_0001_fPrepareTxtFieldToBeInserted
// db_0001_fPrepareIntToBuildSql
// db_0001_fPrepareLongToBuildSql
// db_0001_fRestoreTxtFieldToBeInserted --> ???
// db_0001_fRestoreTxtFieldToBeShown
// ----------------------------------------------------------------------
define("CTE_DB_OK", "Operación realizada con éxito");
define("CTE_DB_REGISTRO_NO_EXISTENTE", "No se han encontrado registros que cumplan ese criterio");
define("CTE_DB_ALTA_EXISTENTE", "Ya existe un registro con esa clave");
// ----------------------------------------------------------------------
function db_0001_fArFreeDBOneRowQuery($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $row = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
    return "";
  } else {
    $row = mysql_fetch_array($result);
    $numberOfFields = mysql_num_fields($result);
    return $row;
  }
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBOneRowQuery($dbHost, $dbName, $dbUser, $dbPass, $sql, $outputFormat) {
// Esta funcion deberia cambiarse a devolver array o generar una nueva
  $ret = "";
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
    $ret = "***NO EXISTE***";
  } else {
    $row = mysql_fetch_array($result);
    $numberOfFields = mysql_num_fields($result);
    for ($i=0; $i < $numberOfFields; $i++) {
      if       ($outputFormat == "0") {
        // sólo valor
        $ret = $ret . $row[$i];
      } elseif ($outputFormat == "1") {
        // nombre_campo=valor
        $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i];
      } elseif ($outputFormat == "2") {
        // sólo valor
        $ret = $ret . $row[$i];
      } elseif ($outputFormat == "3") {
        $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i];
      } else {
        $ret = $ret . $row[$i];
      }
    }
  }
  return $ret;
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBOneRowArrayQuery($dbHost, $dbName, $dbUser, $dbPass, $sql) {
// Ejemplo de llamada
// list($nombre, $email) = db_0001_fFreeDBOneRowArrayQuery($dbHost, $dbName, $dbUser, $dbPass, $sql);
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $row = mysql_fetch_array($result);
    $numberOfFields = mysql_num_fields($result);
    for ($i=0; $i < $numberOfFields; $i++) {
      $AR_ret[$i] = $row[$i];
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBNRowQuery($dbHost, $dbName, $dbUser, $dbPass, $sql, $outputFormat) {
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $numberOfFields = mysql_num_fields($result);
    $contR = 0;
    while ($row = mysql_fetch_array($result)) {
      $contR++;
      $ret = "";
      for ($i=0; $i < $numberOfFields; $i++) {
        //$row[$i] = str_replace("\r", " ", $row[$i]);
        //$row[$i] = str_replace("\n", " ", $row[$i]);

        if       ($outputFormat == "0") {
          // lista de valores y coma y espacio como separadores
          $ret = $ret . $row[$i] . ", ";
        } elseif ($outputFormat == "1") {
          // nombre_campo=valor y salto de linea en html
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . "<br>";
        } elseif ($outputFormat == "2") {
          // nombre_campo=valor y espacio como separadores
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . " ";
        } elseif ($outputFormat == "3") {
          // lista de valores y espacio como separadores
          $ret = $ret . $row[$i] . " ";
        } elseif ($outputFormat == "4") {
          // lista de valores y coma y espacio como separadores
          $ret = $ret . $row[$i] . ", ";
        } elseif ($outputFormat == "5") {
          // separador
          $ret = $ret . $row[$i] . "<##FieldSep-->";
        } elseif ($outputFormat == "6") {
          // El campo sin separadores (viene bien si en cada registro solo hay un campo)
          $ret = $ret . $row[$i];
        } elseif ($outputFormat == "7") {
          // 1 si tiene valor
          $ret = 1;
        } elseif ($outputFormat == "8") {
          $ret = $ret . $row[$i] . "#";
        } elseif ($outputFormat == "9") {
          $ret = $ret . $row[$i] . "~";
        } elseif ($outputFormat == "10") {
          $ret = $ret . $row[$i] . "|";
        } else {
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . "<br>";
        }
      }
      $AR_ret[$contR] = $ret;
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBNRowNotArrayQuery($dbHost, $dbName, $dbUser, $dbPass, $sql, $outputFormat) {
  $ret = "";
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $numberOfFields = mysql_num_fields($result);
    $contR = 0;
    while ($row = mysql_fetch_array($result)) {
      $contR++;
      for ($i=0; $i < $numberOfFields; $i++) {
        //$row[$i] = str_replace("\r", " ", $row[$i]);
        //$row[$i] = str_replace("\n", " ", $row[$i]);

        if       ($outputFormat == "0") {
          // lista de valores y coma y espacio como separadores
          if ($contR > 1) {
            $ret = $ret . ", ";
          }
          $ret = $ret . $row[$i];
        } elseif ($outputFormat == "1") {
          // nombre_campo=valor y salto de linea en html
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . "<br>";
        } elseif ($outputFormat == "2") {
          // nombre_campo=valor y espacio como separadores
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . " ";
        } elseif ($outputFormat == "3") {
          // lista de valores y espacio como separadores
          $ret = $ret . $row[$i] . " ";
        } elseif ($outputFormat == "4") {
          // lista de valores y coma y espacio como separadores
          $ret = $ret . $row[$i] . ", ";
        } elseif ($outputFormat == "5") {
          // separador
          $ret = $ret . $row[$i] . "<##FieldSep-->";
        } elseif ($outputFormat == "6") {
          // El campo sin separadores (viene bien si en cada registro solo hay un campo)
          $ret = $ret . $row[$i];
        } elseif ($outputFormat == "13") {
          // lista de valores y espacio como separadores. Después de cada registro hay un salto de linea
          $ret = $ret . $row[$i] . " ";
        } elseif ($outputFormat == "14") {
          // lista de valores y coma como separador
          if ($contR > 1) {
            $ret = $ret . ",";
          }
          $ret = $ret . $row[$i];
        } else {
          $ret = $ret . mysql_field_name($result, $i) . "=" . $row[$i] . "<br>";
        }
      }
      if       ($outputFormat == "13") {
        $ret = $ret . "\n";
      }
    }
  }
  return $ret;
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBHtmlTableQuery($dbHost, $dbName, $dbUser, $dbPass, $sql, $outputFormat) {
  $ret = "";
  $lineaActual = 1;
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  $ret = "";
  if ($numrows == 0) {
    //$ret = $ret . "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\"><tr><td>";
    //$ret = $ret . "No data";
    //$ret = $ret . "</td></tr></table>";
  } else {
    $ret = $ret . "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">";
    while ($row = mysql_fetch_array($result)) {
      if ($lineaActual == 1) {
        $numberOfFields = mysql_num_fields($result);
        $ret = $ret . "<tr>";
        for ($i=0; $i < $numberOfFields; $i++) {
          $ret = $ret . "<td bgcolor=\"#000000\"><b><font color=\"#FFFFFF\" size=\"1\">" . mysql_field_name($result, $i) . "</font></b></td>";
        }
        $ret = $ret . "</tr>";
      }        
      $ret = $ret . "<tr>";
      for ($i=0; $i < $numberOfFields; $i++) {
        $ret = $ret . "<td bgcolor=\"#DDDDDD\"><font size=\"1\">";
        if       ($outputFormat == "0") {
          $ret = $ret . $row[$i];
        } elseif ($outputFormat == "1") {
          $ret = $ret . $row[$i];
        } elseif ($outputFormat == "2") {
          $ret = $ret . $row[$i];
        } else                       {
          $ret = $ret . $row[$i];
        }
        $ret = $ret . "</font></td>";
      }
      $ret = $ret . "</tr>";
      $lineaActual++;
    }
    $ret = $ret . "</table>";
  }
  return $ret;
}
// ----------------------------------------------------------------------
function db_0001_fFreeDBNoSelectQuery($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  return $result;
}
// ----------------------------------------------------------------------
function db_0001_fDBRowExists($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows > 0) {
    $result = "True";
  } else {
    $result = "False";
  }
  return $result;
}
// ----------------------------------------------------------------------
function db_0001_fLoadDb1RowQueryToArrayAsocIdData($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $row = mysql_fetch_array($result);
    $numberOfFields = mysql_num_fields($result);
    for ($i=0; $i < $numberOfFields; $i++) {
      $AR_ret[mysql_field_name($result, $i)] = $row[$i];
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fLoadDbNRowQueryToArrayAsocIdDataOne($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $numberOfFields = mysql_num_fields($result);
    while ($row = mysql_fetch_array($result)) {
      $AR_ret[$row[0]] = $row[1];
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fLoadDbNRowQueryToArrayAsocIdDataByOrder($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $numberOfFields = mysql_num_fields($result);
    $contRec=0;
    while ($row = mysql_fetch_array($result)) {
      $contRec++;
      for ($i=0; $i < $numberOfFields; $i++) {
        if ($i > 0) {
          $AR_ret[$contRec] = $AR_ret[$contRec] . "---";
        }
        $AR_ret[$contRec] = $AR_ret[$contRec] . $row[$i];
      }
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fLoadDbNRowQueryToArrayAsocIdDataById($dbHost, $dbName, $dbUser, $dbPass, $sql) {
  $AR_ret = array();
  $link = mysql_connect ($dbHost, $dbUser, $dbPass) or die ("Could not connect as $dbUser to $dbName");
  mysql_select_db($dbName) or die("Invalid database");
  //$result = mysql_query($sql) or die("<br>Invalid query: $sql<br>");
  $result = mysql_query($sql) or print("<br>Invalid query: $sql<br>");
  $numrows = mysql_numrows($result);
  if ($numrows == 0) {
  } else {
    $numberOfFields = mysql_num_fields($result);
    $contRec=0;
    while ($row = mysql_fetch_array($result)) {
      $contRec++;
      for ($i=0; $i < $numberOfFields; $i++) {
        //$AR_ret[$contRec][mysql_field_name($result, $i)] = $row[$i];
          $AR_ret[$row[0]][mysql_field_name($result, $i)] = $row[$i];
      }
    }
  }
  return $AR_ret;
}
// ----------------------------------------------------------------------
function db_0001_fPrepareTxtFieldToBeInserted($txtValue) {
  return db_0001_fPrepareStringToBuildSql($txtValue);
}
// ----------------------------------------------------------------------
function db_0001_fPrepareStringToBuildSql($txtValue) {
  $ret = $txtValue;
  // Limite de caracteres 10.000.000 da error
  // Limite de caracteres  5.000.000 da error
  // Limite de caracteres  2.000.000 da error
  // Limite de caracteres  1.000.000 funciona
  $ret = substr($ret, 0, 1000000);

  $ret = str_replace("'", "\'", $ret);
  $ret = str_replace("\\\\'", "\'", $ret);
  // Cadenas prohibidas
  $ret = str_replace("CHAR(0x27)", "", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function db_0001_fPrepareIntToBuildSql($intNumber) {
  if (is_int($intNumber)) {
    return $intNumber;
  } else {
    // En el caso de ser cadena numerica, intval devolverá el valor numérico entero
    // En el caso de no ser cadena numerica, devolverá 0
    return intval($intNumber);
    //return 0;
  }
}
// ----------------------------------------------------------------------
function db_0001_fPrepareLongToBuildSql($longNumber) {
  if (is_long($longNumber)) {
    return $intNumber;
  } else {
    //settype()
    return 0;
  }
}
// ----------------------------------------------------------------------
function db_0001_fRestoreTxtFieldToBeInserted($txtValue) {
  $ret = $txtValue;
  $ret = str_replace("\\'", "'", $ret);
  $ret = str_replace("\\\"", "\"", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
function db_0001_fRestoreTxtFieldToBeShown($txtValue) {
  $ret = $txtValue;
  $ret = str_replace("\\'", "'", $ret);
  $ret = str_replace("\\\"", "\"", $ret);
  return $ret;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>