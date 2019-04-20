<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 24/03/19
 * Time: 3:49 PM
 */

namespace Drupal\priority_quadrant\Plugin\Field\FieldType;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field type of Priority Item.
 *
 * @FieldType(
 *   id = "priority_quadrant_priority",
 *   label = @Translation("Priority"),
 *   description = @Translation("Custom field to map prioriry to a task."),
 *   category = @Translation("Organization"),
 *   default_formatter = "priority_default",
 *   default_widget = "priority_shirt",
 * )
 */
class PriorityItem extends FieldItemBase implements FieldItemInterface {
  
  
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    
    $output = [];
    
    // Create a basic column for the task.
    $output['columns']['task'] = [
      'description' => 'The task to be completed.',
      'type' => 'varchar',
      'length' => 512,
    ];
    
    $output['columns']['complexity'] = [
      'description' => 'How difficult or complex the task is to complete.',
      'type' => 'int',
      'unsigned' => TRUE,
    ];
    
    $output['columns']['value'] = [
      'description' => 'How valuable the completed task is to the end result.',
      'type' => 'int',
      'unsigned' => TRUE,
    ];
    
    
    return $output;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];
    $properties['task'] = DataDefinition::create('string')
      ->setLabel(t("Task"));
    $properties['complexity'] = DataDefinition::create('integer')
      ->setLabel(t("Complexity"));
    $properties['value'] = DataDefinition::create('integer')
      ->setLabel(t("Value"));
    
    return $properties;
  }
  
  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
  
    return [];
  }
  
  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    // Grab the values and create a flag to indicate if the field has data or not.
    $item = $this->getValue();
    $has_stuff = FALSE;
    
    // Check to see if any of the fields have a value currently
    $t_bool = isset($item['task']) && !empty($item['task']);
//    $c_bool = isset($item['complexity']) && !empty($item['row']['complexity']);
//    $v_bool = isset($item['value']) && !empty($item['value']);
    
    // Use the value checks to determine if the has_stuff flag should be switched
    if ($t_bool) {
      $has_stuff = TRUE;
    }
    
    // Return the flag
    return !$has_stuff;
  }
}