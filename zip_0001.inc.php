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
// zip_0001_fUnzipFileInFolder
// 
// 
// ----------------------------------------------------------------------
function zip_0001_fUnzipFileInFolder ($fileName, $folderName, $overwrite) {
  $zip = new ZipArchive;
  if ($zip->open($fileName) === TRUE) {
    $zip->extractTo($folderName);
    $zip->close();
    return 1;
  } else {
    return 0;
  }
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>