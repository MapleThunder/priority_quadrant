<?php

namespace Drupal\priority_quadrant\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
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
      "scale" => "shirt",
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $output["scale"] = [
      "#title" => t("Scale"),
      "#type" => "select",
      "#options" => [
        "shirt" => t("Shirt sizes"),
        "one_ten" => t('One to ten'),
      ],
      "#default_value" => $this->getSetting("scale"),
    ];

    return $output;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $output = [];
    $scale = $this->getSetting("scale");

    // Iterate over every field item and build a renderable array for each item.
    foreach ($items as $delta => $item) {
      $build = [];

      $build["task"] = [
        "#type" => "container",
        "#attributes" => [
          "class" => ["task__string"],
        ],
        "label" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__label"],
          ],
          "#markup" => t("Task"),
        ],
        "value" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__item"],
          ],
          "#plain_text" => $item->task,
        ],
      ];

      $complexity_string = ($scale == "one_ten") ?
        $item->complexity :
        $this->formatShirtString($item->complexity);

      $build["complexity"] = [
        "#type" => "container",
        "#attributes" => [
          "class" => ["complexity__string"],
        ],
        "label" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__label"],
          ],
          "#markup" => t("Complexity"),
        ],
        "value" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__item"],
          ],
          "#plain_text" => $complexity_string,
        ],
      ];

      $value_string = ($scale == "one_ten") ?
        $item->value :
        $this->formatShirtString($item->value);

      $build["task_value"] = [
        "#type" => "container",
        "#attributes" => [
          "class" => ["task_value__string"],
        ],
        "label" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__label"],
          ],
          "#markup" => t("Value"),
        ],
        "value" => [
          "#type" => "container",
          "#attributes" => [
            "class" => ["field__item"],
          ],
          "#plain_text" => $value_string,
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
   *   The numerical size in string format.
   *
   * @return string
   *   The tshirt size string.
   */
  protected function formatShirtString(string $size): string {

    switch ($size) {
      case "1":
      case "2":
        $output = "Extra Small";
        break;

      case "3":
      case "4":
        $output = "Small";
        break;

      case "5":
      case "6":
        $output = "Medium";
        break;

      case "7":
      case "8":
        $output = "Large";
        break;

      case "9":
      case "10":
        $output = "Extra Large";
        break;

      default:
        $output = '';
    }

    return $output;
  }

}
