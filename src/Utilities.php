<?php

namespace Drupal\px_web_graph;

/**
 * Class Utilities
 */
class Utilities {

  /**
   * @param $address
   *
   * @return \Drupal\px_web_graph\Px|null
   */
  public function getPxFile($address) {
    $px = NULL;

    try {
      $px_request_raw = file_get_contents($address);

      if ($px_request_raw) {
        $encoding = mb_detect_encoding($px_request_raw, 'iso-8859-15', TRUE);
        $px_file_data = mb_convert_encoding($px_request_raw, 'UTF-8', $encoding);
        $px = new Px($px_file_data);
      }
    }
    catch (\Exception $e) {
    }

    return $px;
  }

}
