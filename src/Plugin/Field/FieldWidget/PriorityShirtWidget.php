<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 24/03/19
 * Time: 4:47 PM
 */

namespace Drupal\priority_quadrant\Plugin\Field\FieldWidget;

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
    
    $default_complexity = is_numeric($item->complexity) ? $this->numberToShirt($item->complexity) : $item->complexity;
    $element['complexity'] = [
      '#title' => $this->t('Complexity'),
      '#type' => 'select',
      '#options' => [
        'xs' => $this->t('Extra Small'),
        'sm' => $this->t('Small'),
        'md' => $this->t('Medium'),
        'lg' => $this->t('Large'),
        'xl' => $this->t('Extra Large'),
      ],
      '#default_value' => $default_complexity,
    ];
  
    $default_value = is_numeric($item->value) ? $this->numberToShirt($item->value) : $item->value;
    $element['value'] = [
      '#title' => $this->t('Value'),
      '#type' => 'select',
      '#options' => [
        'xs' => $this->t('Extra Small'),
        'sm' => $this->t('Small'),
        'md' => $this->t('Medium'),
        'lg' => $this->t('Large'),
        'xl' => $this->t('Extra Large'),
      ],
      '#default_value' => $default_value,
    ];
    
    return $element;
  }
}