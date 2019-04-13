<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 07/04/19
 * Time: 1:03 PM
 */

namespace Drupal\priority_quadrant;


/**
 * Trait ScaleConversionTrait
 *
 * @package Drupal\priority_quadrant\Plugin\Field\FieldWidget
 */
trait ScaleConversionTrait {
  
  /**
   * Converts a 1-10 scale number into a shirt size scale.
   *
   * @param int $number
   *
   * @return string
   */
  public function numberToShirt(int $number): string {
    
    // Cut the number in half and floor it to give us a 1-5 scale to match the shirt sizes.
    $n = floor($number/2);
    
    switch ($n) {
      case 1:
        $shirt = 'xs';
        break;
      case 2:
        $shirt = 'sm';
        break;
      case 3:
        $shirt = 'md';
        break;
      case 4:
        $shirt = 'lg';
        break;
      case 5:
        $shirt = 'xl';
        break;
      
      default:
        // Default the size to be an empty string if the conversion fails
        $shirt = '';
    }
    
    return $shirt;
    
  }
  
  /**
   * Converts a shirt size scale to a 1-10 number scale.
   * @param string $shirt
   *
   * @return int
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