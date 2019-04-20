<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 07/04/19
 * Time: 12:57 PM
 */

namespace Drupal\priority_quadrant\Plugin\Field\FieldWidget;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\priority_quadrant\ScaleConversionTrait;

/**
 * A priority entry.
 *
 * @FieldWidget(
 *   id = "priority_number",
 *   label = @Translation("Priority number"),
 *   field_types = {
 *     "priority_quadrant_priority",
 *   }
 * )
 */
class PriorityNumberWidget extends WidgetBase implements WidgetInterface {
  
  use ScaleConversionTrait;
  
  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    
    $item =& $items[$delta];
    
    // The key of the element should be the setting name
    $element['task'] = [
      '#title' => $this->t('Task'),
      '#type' => 'textfield',
      '#default_value' => $item->task,
    ];
    
    // Create a number array for options
    $options = $this->createNumberArray(10);
    
    // Check to make sure the item complexity isn't null
	  // If it is null, default to lowest
	  if ($item->complexity == NULL) {
	    $item->complexity = 1;
	  }
	  
//    $default_complexity = is_numeric($item->complexity) ? $item->complexity : $this->shirtToNumber($item->complexity);
	  $default_complexity = $item->complexity;
	  
    $element['complexity'] = [
      '#title' => $this->t('Complexity'),
      '#type' => 'select',
      '#options' => $options,
      '#default_value' => $default_complexity,
    ];
	
	  // Check to make sure the item value isn't null
	  // If it is null, default to lowest
	  if ($item->value == NULL) {
		  $item->value = 1;
	  }
    
//    $default_value = is_numeric($item->value) ? $item->value : $this->shirtToNumber($item->value);
	  $default_value = $item->value;
    $element['value'] = [
      '#title' => $this->t('Value'),
      '#type' => 'select',
      '#options' => $options,
      '#default_value' => $default_value,
    ];
    
    return $element;
  }
  
  /**
   * Creates a number array from 1 up the amount passed.
   *
   * @param int $max
   *
   * @return array
   */
  public function createNumberArray(int $max): array {
    
    $output = [];
    
    for($i = 0; $i < $max; $i++) {
      $output[$i + 1] = $i + 1;
    }
    
    return $output;
  }
}