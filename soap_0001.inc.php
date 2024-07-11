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
// soap_0001_fSoapRequestV1
// soap_0001_fSoapRequestV2
// ----------------------------------------------------------------------
function soap_0001_fSoapRequestV1($soapUrl, $soapBody) {
  $xml = "";
  $xml = $xml . "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  $xml = $xml . "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">\n";
  $xml = $xml . "<soap:Body>\n";
  $xml = $xml . $soapBody;
  $xml = $xml . "</soap:Body>\n";
  $xml = $xml . "</soap:Envelope>\n";
  //print "\n\n\n<hr>xml:\n\n\n" . $xml . "\n\n\n<hr>\n\n\n";
  $headers[] = "Content-Type: text/xml; charset=utf-8";
  $ch = curl_init($soapUrl);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
// ----------------------------------------------------------------------
function soap_0001_fSoapRequestV2($soapUrl, $soapUser, $soapPass, $soapBody, $xmlnsCon) {
  $xml = "";
  $xml = $xml . "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  $xml = $xml . "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:con=\"" . $xmlnsCon . "\">\n";
  $xml = $xml . "<soapenv:Header/>\n";
  $xml = $xml . "<soapenv:Body>\n";
  $xml = $xml . $soapBody;
  $xml = $xml . "</soapenv:Body>\n";
  $xml = $xml . "</soapenv:Envelope>\n";
  //print "\n\n\n<hr>xml:\n\n\n" . $xml . "\n\n\n<hr>\n\n\n";
  $headers = array();
  $headers[] = 'Content-Type: application/soap+xml; charset=utf-8; action="[' . $xmlnsCon . ']"';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //TRUE=1
  curl_setopt($ch, CURLOPT_URL, $soapUrl);  
  curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPass);  
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>