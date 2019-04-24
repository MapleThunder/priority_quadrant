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
	
//	  $element['row'] = [
//		  '#type' => 'container',
//		  '#attributes' => [
//			  'class' => ['row',],
//		  ],
//	  ];
//
//	  $element['row']['task_container'] = [
//		  '#type' => 'container',
//		  '#attributes' => [
//			  'class' => ['col-sm-8',],
//		  ],
//	  ];
//	  $element['row']['comp_container'] = [
//		  '#type' => 'container',
//		  '#attributes' => [
//			  'class' => ['col-sm-2',],
//		  ],
//	  ];
//	  $element['row']['value_container'] = [
//		  '#type' => 'container',
//		  '#attributes' => [
//			  'class' => ['col-sm-2',],
//		  ],
//	  ];
	  
    // The key of the element should be the setting name
//    $element['row']['task_container']['task'] = [
    $element['task'] = [
      '#title' => $this->t('Task'),
      '#type' => 'textfield',
      '#default_value' => $item->task,
    ];
    
    $default_complexity = $item->complexity + ($item->complexity % 2);
    
//    $element['row']['comp_container']['complexity'] = [
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
  
    $default_value = $item->value + ($item->value % 2);
//    $element['row']['value_container']['value'] = [
    $element['value'] = [
      '#title' => $this->t('Task Value'),
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