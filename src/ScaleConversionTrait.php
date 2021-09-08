<?php

namespace Drupal\priority_quadrant;

/**
 * Trait to help convert priority values.
 *
 * @package Drupal\priority_quadrant\Plugin\Field\FieldWidget
 */
trait ScaleConversionTrait {

  /**
   * Converts a 1-10 scale number into a shirt size scale.
   *
   * @param int $number
   *   The number to convert.
   *
   * @return string
   *   The corresponding tshirt size.
   */
  public function numberToShirt(int $number): string {
    switch ($number) {
      case 1:
      case 2:
        $shirt = 'xs';
        break;

      case 3:
      case 4:
        $shirt = 'sm';
        break;

      case 5:
      case 6:
        $shirt = 'md';
        break;

      case 7:
      case 8:
        $shirt = 'lg';
        break;

      case 9:
      case 10:
        $shirt = 'xl';
        break;

      default:
        // Default the size to be an empty string if the conversion fails.
        $shirt = '';
    }

    return $shirt;

  }

  /**
   * Converts a shirt size scale to a 1-10 number scale.
   *
   * @param string $shirt
   *   The shirt size to convert.
   *
   * @return int
   *   The corresponding number on a 1-10 scale.
   */
  public function shirtToNumber(string $shirt): int {

    switch ($shirt) {
      case 'xs':
        $number = 2;
        break;

      case 'sm':
        $number = 4;
        break;

      case 'md':
        $number = 6;
        break;

      case 'lg':
        $number = 8;
        break;

      case 'xl':
        $number = 10;
        break;

      default:
        $number = 0;
    }

    return $number;

  }

}
