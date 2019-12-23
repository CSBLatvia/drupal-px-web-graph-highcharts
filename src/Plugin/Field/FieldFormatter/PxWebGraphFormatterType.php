<?php

namespace Drupal\px_web_graph\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'px_web_graph_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "px_web_graph_formatter_type",
 *   label = @Translation("PX Web Graph (Highcharts) formatter type"),
 *   field_types = {
 *     "px_web_graph_field_type"
 *   }
 * )
 */
class PxWebGraphFormatterType extends FormatterBase {

  /**
   * @var int
   */
  public static $currentId;

  /**
   * @return int
   */
  public static function getNextId() {
    PxWebGraphFormatterType::$currentId += 1;

    return PxWebGraphFormatterType::$currentId;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $id = PxWebGraphFormatterType::getNextId();
      $storageName = "pxPlaceholder" . $id;

      $elements[$delta] = [
        '#attached' => [
          'library' => [
            'px_web_graph/px_web_graph_form_actions',
          ],
        ],
        '#theme' => 'px__web__graph',
        '#title' => $item->title,
        '#subtitle' => $item->subtitle,
        '#yAxisName' => $item->yAxisName,
        '#comment' => $item->comment,
        '#displayType' => $item->displayType,
        '#displayMode' => $item->displayMode,
        '#savedResultUrl' => $item->savedResultUrl,
        '#savedResultText' => $item->savedResultText,
        '#displayOptions' => $item->displayOptions,
        '#seriesNames' => $item->seriesNames,
        '#seriesColor' => $item->seriesColor,
        '#seriesType' => $item->seriesType,
        '#seriesSign' => $item->seriesSign,
        '#legendsVisibility' => $item->legendsVisibility,
        '#id' => $id,
        '#storageName' => $storageName,
        '#chartDisplayOptions' => '',
        '#sortDirection' => $item->sortDirection,
        '#animate' => $item->animate,
      ];
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

  /**
   * @return mixed
   */
  private function getDefaultDisplayOptions() {
    return json_decode('{
      "credits": {
        "enabled": false
      },
      "chart": {
        "type": "line",
        "spacing": [50, 30, 50, 30]
      },
      "rangeSelector": {
        "enabled": false
      },
      "exporting": {
        "buttons": {
          "contextButton": {
            "y": -10
          }
        }
      },
      "navigator": {
        "enabled": true
      },
      "title": {
        "text": "",
        "align": "left",
        "y": 0,
        "margin": 20
      },
      "subtitle": {
        "text": "",
        "align": "left",
        "y": 22 
      },
      "legend": {
        "layout": "horizontal",
        "align": "center",
        "verticalAlign": "top",
        "itemStyle": {
          "color": "#000",
          "fontWeight": "normal"
        }
      },
      "xAxis": {
        "title": {
          "enabled": false
        },
        "tickInterval": 31104000000,
        "min": 0,
        "max": 0,
        "type": "datetime",
        "labels": {
          "style": {
            "color": "#000",
            "fontSize": "11px"
          }
        }
      },
      "yAxis": {
        "title": {
          "align": "high",
          "offset": 0,
          "rotation": 0,
          "y": -23,
          "x": -3,
          "text": ""
        },
        "lineColor": "#000",
        "tickColor": "#000",
        "labels": {
          "formatter": "function () { return Highcharts.numberFormat(this.value, 0); }"
        }
      },
      "legend": {
        "enabled": true,
        "layout": "horizontal",
        "backgroundColor": "#FFFFFF",
        "align": "center",
        "verticalAlign": "top",
        "y": -20
      },
      "tooltip": {
        "enabled": true
      },
      "plotOptions": {
        "line": {
          "marker": {
            "enabled": false
          },
          "dataLabels": {
            "enabled": false
          }
        },
        "series": {
          "showInNavigator": true
        }
      }
    }', TRUE);
  }

}
