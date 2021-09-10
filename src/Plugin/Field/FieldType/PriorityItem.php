<?php

namespace Drupal\priority_quadrant\Plugin\Field\FieldType;

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
 *   default_formatter = "priority_default",
 *   default_widget = "priority_shirt",
 *   description = @Translation("Custom field to map priority to a task."),
 *   category = @Translation("Organization"),
 * )
 */
class PriorityItem extends FieldItemBase implements FieldItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      // Columns contains the values that the field will store.
      'columns' => [
        'task' => [
          'description' => 'The task to be completed.',
          'type' => 'varchar',
          'length' => 512,
        ],
        'complexity' => [
          'description' => 'How difficult or complex the task is to complete.',
          'type' => 'int',
          'unsigned' => TRUE,
        ],
        'value' => [
          'description' => 'How valuable the completed task is to the end result.',
          'type' => 'int',
          'unsigned' => TRUE,
        ]
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    return [
      'task' => DataDefinition::create('string')->setLabel(t("Task")),
      'complexity' => DataDefinition::create('integer')->setLabel(t("Complexity")),
      'value' => DataDefinition::create('integer')->setLabel(t("Value")),
    ];
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
    $t_bool = isset($item['task']) && !empty($item['task']);
    return !$t_bool;
  }

}
