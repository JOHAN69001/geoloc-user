a<?php

$ip = $_SERVER['REMOTE_ADDR'];
$geoIp = geoip_record_by_name($ip);
$regionsJSON = file_get_contents('.' . $assetPath['js'] . '/french-regions-departments.json');
$regions = json_decode($regionsJSON, true);
$countryCode = $geoIp['country_code'];
$regionCode = $geoIp['region'];

if (!empty($geoIp['city'])) {
  $city = $geoIp['city'];
}

if ($countryCode == 'FR' && !empty($geoIp['postal_code'])) {
    $postalCode = substr($geoIp['postal_code'], 0, 2);
    $deptm = $regions[$postalCode]['name'];
} 

if (!empty($countryCode) && !empty($regionCode)) {
  $region = geoip_region_name_by_code($countryCode, $regionCode);
}


echo $region, $deptm, $city;

?>
