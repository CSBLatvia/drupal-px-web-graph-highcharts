<?php

namespace Drupal\px_web_graph\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'px_web_graph_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "px_web_graph_widget_type",
 *   label = @Translation("PX Web Graph (Highcharts) widget type"),
 *   field_types = {
 *     "px_web_graph_field_type"
 *   },
 *   multiple_values = TRUE
 * )
 */
class PxWebGraphWidgetType extends WidgetBase {

  /**
   * @var int
   */
  private $id = 0;

  /**
   * @var int
   */
  public static $currentId;

  /**
   * @return mixed
   */
  public static function getNextId() {
    PxWebGraphWidgetType::$currentId += 1;

    return PxWebGraphWidgetType::$currentId;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->id == 0) {
      $this->id = PxWebGraphWidgetType::getNextId();
    }

    $wrapper_class = 'px-web-' . $this->id;
    $element += [
      '#attributes' => ['class' => [$wrapper_class]],
      '#attached' => [
        'drupalSettings' => [
          'wrapperClass' => $wrapper_class
        ],
        'library' => [
            'px_web_graph/px_web_graph_form_actions',
            'px_web_graph/px.min',
            'px_web_graph/underscore-min'
        ],
      ],
    ];

    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += [
        '#type' => 'fieldset',
      ];
    }

    $element['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => isset($items[$delta]->title) ? $items[$delta]->title : "",
    ];

    $element['subtitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subtitle'),
      '#default_value' => isset($items[$delta]->subtitle) ? $items[$delta]->subtitle : "",
    ];

    $element['yAxisName'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Y-axis name'),
      '#default_value' => isset($items[$delta]->yAxisName) ? $items[$delta]->yAxisName : "",
    ];

    $element['comment'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Comment'),
      '#default_value' => isset($items[$delta]->comment) ? $items[$delta]->comment : "",
    ];

    $element['displayType'] = [
      '#type' => 'radios',
      '#title' => $this->t('Display type'),
      '#options' => [0 => $this->t('Chart'), 1 => $this->t('Table'), 2 => $this->t('Land map')],
      '#default_value' => isset($items[$delta]->displayType) ? $items[$delta]->displayType : 1,
    ];

    $element['displayMode'] = [
      '#type' => 'radios',
      '#title' => $this->t('Display mode'),
      '#options' => [0 => $this->t('Live data'), 1 => $this->t('Static data')],
      '#default_value' => isset($items[$delta]->displayMode) ? $items[$delta]->displayMode : 1,
    ];

    $element['savedResultUrl'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Saved result URL'),
      '#suffix' => '<div class="load-saved-result-button"></div>',
      '#attributes' => ['class' => ['edit-field-saved-result']],
      '#default_value' => isset($items[$delta]->savedResultUrl) ? $items[$delta]->savedResultUrl : "",
    ];

    $element['savedResultText'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Saved result text'),
      '#attributes' => ['class' => ['edit-field-saved-result-text']],
      '#default_value' => isset($items[$delta]->savedResultText) ? $items[$delta]->savedResultText : "",
    ];

    $element['seriesNames'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Series names'),
      '#prefix' => '<div><span class="display-options-label">' . $this->t('<strong>Series configuration (Click to expand)</strong>') . '</span><div class="display-options-wrapper">',
      '#default_value' => isset($items[$delta]->seriesNames) ? $items[$delta]->seriesNames : "",
    ];

    $element['seriesColor'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Series color'),
      '#default_value' => isset($items[$delta]->seriesColor) ? $items[$delta]->seriesColor : "",
    ];

    $element['seriesType'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Series type'),
      '#default_value' => isset($items[$delta]->seriesType) ? $items[$delta]->seriesType : "",
    ];

    $element['seriesSign'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Series sign'),
      '#default_value' => isset($items[$delta]->seriesSign) ? $items[$delta]->seriesSign : "",
    ];

    $element['legendsVisibility'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Legend visibility'),
      '#default_value' => isset($items[$delta]->legendsVisibility) ? $items[$delta]->legendsVisibility : "",
    ];

    $element['sortDirection'] = [
      '#type' => 'radios',
      '#title' => $this->t('Sort direction'),
      '#options' => [0 => $this->t('ASC'), 1 => $this->t('DESC')],
      '#default_value' => isset($items[$delta]->sortDirection) ? $items[$delta]->sortDirection : 0,
    ];

    $element['animate'] = [
      '#type' => 'radios',
      '#title' => $this->t('Animate'),
      '#options' => [0 => $this->t('No'), 1 => $this->t('Yes')],
      '#default_value' => isset($items[$delta]->animate) ? $items[$delta]->animate : 0,
    ];

    $element['displayOptions'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Display options'),
      '#prefix' => '<div class="display-options-wrapper">',
      '#suffix' => '<div class="load-display-options-default-button"></div></div></div></div>',
      '#attributes' => ['class' => ['edit-field-display-options']],
      '#default_value' => isset($items[$delta]->displayOptions) ? $items[$delta]->displayOptions : "",
    ];

    return $element;
  }

}
