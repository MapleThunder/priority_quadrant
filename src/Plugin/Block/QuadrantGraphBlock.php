<?php
/**
 * Created by PhpStorm.
 * User: niko
 * Date: 24/03/19
 * Time: 3:30 PM
 */

namespace Drupal\priority_quadrant\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a block to display the graph from a Priority Grouping.
 *
 * @Block(
 *   id = "rs_copyright_block",
 *   admin_label = @Translation("Priority Quadrant Graph Block"),
 *   category = @Translation("Organization"),
 * )
 */
class QuadrantGraphBlock extends BlockBase
{
  
  /**
   * {@inheritdoc}
   */
  public function build()
  {
    // TODO: Implement build() method.
  }
}