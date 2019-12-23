<?php

namespace Drupal\px_web_graph\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'px_web_graph_field_type' field type.
 *
 * @FieldType(
 *   id = "px_web_graph_field_type",
 *   label = @Translation("PX Web graph"),
 *   description = @Translation("This is a PX Web Graph (Highcharts)"),
 *   default_widget = "px_web_graph_widget_type",
 *   default_formatter = "px_web_graph_formatter_type"
 * )
 */
class PxWebGraphFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.
    $properties['title'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Title'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['subtitle'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Subtitle'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['yAxisName'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Y-axis name'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['comment'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Comment'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['displayType'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Display type'))
      ->setRequired(TRUE);;
    $properties['displayMode'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Display mode'))
      ->setRequired(TRUE);;
    $properties['savedResultUrl'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Saved result URL'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['savedResultText'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Saved result text'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['displayOptions'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Display options'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(FALSE);
    $properties['seriesNames'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Series names'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['seriesColor'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Series color'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['seriesType'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Series type'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['seriesSign'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Series sign'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['legendsVisibility'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Legend visibility'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);
    $properties['sortDirection'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Sort direction'))
      ->setRequired(TRUE);
    $properties['animate'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Animate'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'title' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'subtitle' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'yAxisName' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'comment' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'displayType' => [
          'type' => 'int',
          'default' => 0,
        ],
        'displayMode' => [
          'type' => 'int',
          'default' => 0,
        ],
        'savedResultUrl' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'savedResultText' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'displayOptions' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'seriesNames' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'seriesColor' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'seriesType' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'seriesSign' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'legendsVisibility' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'text' : 'text',
          'length' => 65000,
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'sortDirection' => [
          'type' => 'int',
          'default' => 0,
        ],
        'animate' => [
          'type' => 'int',
          'default' => 0,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $title = $this->get('title')->getValue();
    $subtitle = $this->get('subtitle')->getValue();
    $y_axis_name = $this->get('yAxisName')->getValue();
    $comment = $this->get('comment')->getValue();
    $display_type = $this->get('displayType')->getValue();
    $display_mode = $this->get('displayMode')->getValue();
    $saved_result_url = $this->get('savedResultUrl')->getValue();
    $saved_result_text = $this->get('savedResultText')->getValue();
    $display_options = $this->get('displayOptions')->getValue();
    $series_names = $this->get('seriesNames')->getValue();
    $series_color = $this->get('seriesColor')->getValue();

    return empty($title) &&
      empty($subtitle) &&
      empty($y_axis_name) &&
      empty($comment) &&
      empty($display_type) &&
      empty($display_mode) &&
      empty($storedViewFromPx) &&
      empty($saved_result_url) &&
      empty($saved_result_text) &&
      empty($display_options) &&
      empty($series_names) &&
      empty($series_color);
  }

}
