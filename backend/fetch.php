<?php
  $json = file_get_contents('http://data.stadt-salzburg.at/geodaten/wfs?service=WFS&version=1.1.0&request=GetFeature&srsName=urn:x-ogc:def:crs:EPSG:4326&outputFormat=application/json&typeName=ogdsbg:parkplatz');
  $data = json_decode($json);
  $pretty_data = array();

  foreach ($data->features as $feature) {
    $pretty_data[] = array(
      'legacyID' => $feature->id,
      'longitude' => $feature->geometry->coordinates[0],
      'latitude' => $feature->geometry->coordinates[1],
      'name' => $feature->properties->BEZEICHNUNG,
      'availableParkingSpots' => available_parking_spots($feature->properties->FREIE_PLAETZE)
    );
  }

  header('Content-Type: text/html; charset=utf-8');

  function available_parking_spots($input) {
    if (preg_match('/(\d+) \(\d+%\)/', $input, $matches)) {
      return $matches[1];
    } else {
      return null;
    }
  }

  file_put_contents('parking_sites.json', json_encode($pretty_data));
?>

<pre>
  <?php var_dump($pretty_data); ?>
</pre>
