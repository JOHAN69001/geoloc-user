<?php

$ip = EZ_ISDEV ? '185.81.52.141' : $_SERVER['REMOTE_ADDR'];
$geoIp = geoip_record_by_name($ip);
$regionsJSON = file_get_contents('.' . $assetPath['js'] . '/french-regions-departments.json');
$regions = json_decode($regionsJSON, true);
$countryCode = $geoIp['country_code'];
$regionCode = $geoIp['region'];

if (!empty($geoIp['city'])) {
  $city = $geoIp['city'];
}

if (!empty($countryCode) && !empty($regionCode)) {
    if($countryCode == 'FR' && !empty($geoIp['postal_code'])) {
        $postalCode = substr($geoIp['postal_code'], 0, 2);
        $region = $regions[$postalCode]['name'];
    } else {
        $region = geoip_region_name_by_code($countryCode, $regionCode);
    }
} else {
    $region = _("À proximité");
}

echo $region, $city;

?>
