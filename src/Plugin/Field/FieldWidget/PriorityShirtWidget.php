<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 24/03/19
 * Time: 4:47 PM
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
 *   id = "priority_shirt",
 *   label = @Translation("Priority shirt"),
 *   field_types = {
 *     "priority_quadrant_priority",
 *   }
 * )
 */
class PriorityShirtWidget extends WidgetBase implements WidgetInterface {
  
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
    
//    $default_complexity = is_numeric($item->complexity) ? $this->numberToShirt($item->complexity) : $item->complexity;
    $default_complexity = $item->complexity + ($item->complexity % 2);
    
    $element['complexity'] = [
      '#title' => $this->t('Complexity'),
      '#type' => 'select',
      '#options' => [
        2 => $this->t('Extra Small'),
        4 => $this->t('Small'),
        6 => $this->t('Medium'),
        8 => $this->t('Large'),
        10 => $this->t('Extra Large'),
      ],
      '#default_value' => $default_complexity,
    ];
  
//    $default_value = is_numeric($item->value) ? $this->numberToShirt($item->value) : $item->value;
    $default_value = $item->value + ($item->value % 2);
    $element['value'] = [
      '#title' => $this->t('Value'),
      '#type' => 'select',
      '#options' => [
	      2 => $this->t('Extra Small'),
	      4 => $this->t('Small'),
	      6 => $this->t('Medium'),
	      8 => $this->t('Large'),
	      10 => $this->t('Extra Large'),
      ],
      '#default_value' => $default_value,
    ];
    
    return $element;
  }
}