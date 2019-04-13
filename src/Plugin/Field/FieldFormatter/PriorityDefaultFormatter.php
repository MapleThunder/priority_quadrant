<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 24/03/19
 * Time: 4:42 PM
 */

namespace Drupal\priority_quadrant\Plugin\Field\FieldFormatter;


use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\priority_quadrant\ScaleConversionTrait;

/**
 * Plugin implementation of the 'priority_default' formatter.
 *
 * @FieldFormatter(
 *   id = "priority_default",
 *   label = @Translation("Priority default"),
 *   field_types = {
 *     "priority_quadrant_priority"
 *   }
 * )
 */
class PriorityDefaultFormatter extends FormatterBase {
  
  use ScaleConversionTrait;
  
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    
    return [
      'scale' => 'shirt',
    ] + parent::defaultSettings();
  }
  
  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
  
    $output['scale'] = [
      '#title' => t('Scale'),
      '#type' => 'select',
      '#options' => [
        'shirt' => t('Shirt sizes'),
        'one_ten' => t("One to ten"),
      ],
      '#default_value' => $this->getSetting('scale'),
    ];
    
    return $output;
  }
  
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $output = [];
  
    // Iterate over every field item and build a renderable array for each item.
    foreach ($items as $delta => $item) {
      $build = [];
  
      // Render the task. Nothing fancy as such.
      // We build a "container" element, within which we render
      // 2 child elements: one, the label of the property (Name);
      // two, the value of the property (The name of the burrito
      // as entered by the user).
      $build['task'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['task__string',],
        ],
        'label' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__label',],
          ],
          '#markup' => t('Task'),
        ],
        'value' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__item',],
          ],
          // We use #plain_text instead of #markup to prevent XSS.
          // plain_text will clean up the task string and render an
          // HTML entity encoded string to prevent bad-guys from
          // injecting JavaScript.
          '#plain_text' => $item->task,
        ],
      ];
  
      $complexity_string = is_numeric($item->complexity) ? $item->complexity : $this->formatShirtString($item->complexity);
      $build['complexity'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['complexity__string',],
        ],
        'label' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__label',],
          ],
          '#markup' => t('Complexity'),
        ],
        'value' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__item',],
          ],
          // We use #plain_text instead of #markup to prevent XSS.
          // plain_text will clean up the task string and render an
          // HTML entity encoded string to prevent bad-guys from
          // injecting JavaScript.
          '#plain_text' => $complexity_string,
        ],
      ];
  
      $value_string = is_numeric($item->value) ? $item->value : $this->formatShirtString($item->value);
      $build['task_value'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['task_value__string',],
        ],
        'label' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__label',],
          ],
          '#markup' => t('Value'),
        ],
        'value' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__item',],
          ],
          // We use #plain_text instead of #markup to prevent XSS.
          // plain_text will clean up the task string and render an
          // HTML entity encoded string to prevent bad-guys from
          // injecting JavaScript.
          '#plain_text' => $value_string,
        ],
      ];
      
      $output[$delta] = $build;
    }
    
    return $output;
  }
  
  /**
   * Formats a user readable string from a shirt size code.
   *
   * @param string $size
   *
   * @return string
   */
  protected function formatShirtString(string $size): string {
    
    switch ($size) {
      case 'xs':
        $output = 'Extra Small';
        break;
      case 'sm':
        $output = 'Small';
        break;
      case 'md':
        $output = 'Medium';
        break;
      case 'lg':
        $output = 'Large';
        break;
      case 'xl':
        $output = 'Extra Large';
        break;
  
      default:
        $output = '';
    }
    
    return $output;
  }
}