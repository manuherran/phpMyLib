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
// abc: Adobe Business Catalyst
// ----------------------------------------------------------------------
// abc_0001_fApiRequest
// abc_0001_fApiParseSimpleApiOutputOneRecord
// 
// 
// ----------------------------------------------------------------------
// https://worldsecuresystems.com/catalystwebservice/catalystcrmwebservice.asmx
// https://worldsecuresystems.com/catalystwebservice/catalystecommercewebservice.asmx
// ----------------------------------------------------------------------
function abc_0001_fApiRequest ($abcWebsiteDomainName, $abcWebsiteId, $abcUser, $abcPassword, $abcApiName, $abcApiFunctionName, $abcApiParam1, $abcApiParam2, $abcApiParam3) {
  // $apiName "CRM", "eCommerce"
  // Ejemplos de llamada:
  // print abc_0001_fApiRequest ("car023.businesscatalyst.com", "1387360", "api@businesscatalyst.es", "(pass)", "CRM",       "SecureZoneList_Retrieve", "",      "", "");
  // print abc_0001_fApiRequest ("car023.businesscatalyst.com", "1387360", "api@businesscatalyst.es", "(pass)", "eCommerce", "Product_ListRetrieve",    "-1",    "", ""); // Todos los productos
  // print abc_0001_fApiRequest ("car023.businesscatalyst.com", "1387360", "api@businesscatalyst.es", "(pass)", "eCommerce", "Product_ListRetrieve",    "17823", "", ""); // Prodcutos del catalogo 17823

  $soapUrl = "";
  if ($abcApiName == "CRM") {
    $soapUrl = "https://" . $abcWebsiteDomainName . "/CatalystWebService/CatalystCRMWebservice.asmx";
  } else if ($abcApiName == "eCommerce") {
    $soapUrl = "https://" . $abcWebsiteDomainName . "/CatalystWebService/catalystecommercewebservice.asmx";
  }

  $soapBody = "";
  if ($abcApiName == "CRM") {
    $soapBody = $soapBody . "<" . $abcApiFunctionName . " xmlns=\"http://tempuri.org/CatalystDeveloperService/CatalystCRMWebservice\">\n";
    $soapBody = $soapBody . "<username>" . $abcUser . "</username>\n";
    $soapBody = $soapBody . "<password>" . $abcPassword . "</password>\n";
    $soapBody = $soapBody . "<siteId>" . $abcWebsiteId . "</siteId>\n";
    $soapBody = $soapBody . "</" . $abcApiFunctionName . ">\n";
  } else if ($abcApiName == "eCommerce") {
    $soapBody = $soapBody . "<" . $abcApiFunctionName . " xmlns=\"http://tempuri.org/CatalystDeveloperService/CatalystEcommerceWebservice\">\n";
    $soapBody = $soapBody . "<Username>" . $abcUser . "</Username>\n";
    $soapBody = $soapBody . "<Password>" . $abcPassword . "</Password>\n";
    $soapBody = $soapBody . "<SiteId>" . $abcWebsiteId . "</SiteId>\n";
    if ($abcApiFunctionName == "Product_ListRetrieve") {
      $soapBody = $soapBody . "<CatalogId>" . $abcApiParam1 ."</CatalogId>\n";
    }
    $soapBody = $soapBody . "</" . $abcApiFunctionName . ">\n";
  }

  return soap_0001_fSoapRequestV1($soapUrl, $soapBody);
}
// ----------------------------------------------------------------------
function abc_0001_fApiParseSimpleApiOutputOneRecord($xmlOutput, $firstTag, $lastTag) {
  // Ejemplo de llamada:
  // $apiData = abc_0001_fApiRequest(... "CRM", "SecureZoneList_Retrieve" ...);
  // $apiData = abc_0001_fApiParseSimpleApiOutputOneRecord ($apiData, "<SecureZone>", "</SecureZone>");
  // print $apiData->secureZoneID . " " . $apiData->secureZoneName . " " . $apiData->secureZoneExpiryDate . " " . $apiData->secureZoneUnsubscribe;

  // Ejemplo de llamada:
  // $apiData = abc_0001_fApiRequest(... "eCommerce", "Product_ListRetrieve" ...);
  // $apiData = abc_0001_fApiParseSimpleApiOutputOneRecord ($apiData, "<Products>", "</Products>");
  // print $apiData->productId . " " . $apiData->productCode . " " . $apiData->productName . " " . $apiData->description . " " . $apiData->smallImage . " " . $apiData->largeImage . " ";

  $xmlData = $xmlOutput;
  //print "<hr>" . $xmlData . "<hr>";
  $xmlData = xml_0001_fTrimXmlText($xmlData, $firstTag, $lastTag);
  //print "<hr>" . $xmlData . "<hr>";
  //print_r(json_decode(json_encode(simplexml_load_string($xmlData))));
  $structuredData = json_decode(json_encode(simplexml_load_string($xmlData)));
  return $structuredData;
}
// ----------------------------------------------------------------------
// https://worldsecuresystems.com/catalystwebservice/catalystcrmwebservice.asmx
// https://worldsecuresystems.com/catalystwebservice/catalystecommercewebservice.asmx
// ----------------------------------------------------------------------
// OJO NO DEJAR LINEAS EN BLANCO AL FINAL DE ESTE FICHERO
// ----------------------------------------------------------------------
?>