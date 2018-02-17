(function($) {
    'use strict';

    let isDebug = true;
    let defaultDisplayOptions = 
    {
        credits: {
            enabled: false
        },
        chart: {
            type: "line",
            backgroundColor: "rgba(255, 255, 255, 0)",
            borderWidth: 0,
            renderTo: "container",
            marginRight: 20
        },
        rangeSelector: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        navigator: {
            enabled: true
        },
        title: {
            text: ""
        },
        subtitle: {
            text: ""
        },
        legend: {
            layout: "horizontal",
            align: "center",
            verticalAlign: "top",
            itemStyle: {
                color: "#000",
                fontWeight: "normal"
            }
        },
        xAxis: {
            title: {
                enabled: false
            },
            tickInterval: 2629746000,
            min: 0,
            max: 0,
            type: "datetime",
            labels: {
                style: {
                    color: "#000",
                    fontSize: "11px"
                },
            }
        },
        yAxis: {
            title: {
                text: "Test",
                style: {
                    color: "#000",
                    fontWeight: "normal",
                    fontSize: "12px"
                }
            },
            lineColor: "#000",
            tickColor: "#000",
            labels: {
                formatter: function () {
                    return Highcharts.numberFormat(this.value, 0);
                },
                style: {
                    color: "#000",
                    fontSize: "11px"
                }
            },
        },
        legend: {
            enabled: true
        },
        tooltip: {
            enabled: true
        },
        plotOptions: {
            line: {
                marker: {
                    enabled: false,
                },
                dataLabels: {
                    enabled: true,
                    color: "#000",
                    useHTML: true,
                    crop: false,
                    overflow: false
                }
            },
            series: {
                showInNavigator: true
            }
        }
    };

    Drupal.behaviors.px_web_action = {
        attach(context, settings) {            
            
            log(context);
            log(settings);
            //Lookup Elements
            log("--- Lookup Elements ---");

            //let $base =  $(context);
            let $elements = $(context).find(".field--type-stored-query-field-type");

            log($elements);
            $.each($elements,function(index, element) {
                let $base = $(element);
            let displayOptionsLabel = $base.find(".display-options-label");
            let displayOptionsWrapper = $base.find(".display-options-wrapper");
            let displayOptionsField = $base.find(".edit-field-display-options");
            let savedResultText = $base.find(".edit-field-saved-result-text");
            let savedResultElement = $base.find(".edit-field-saved-result");
            let displayOptionsDefaultsButton = savedResultElement.closest('div').parent().find('.load-display-options-default-button');            
            let loadPXDataFromUrlAddressButton = savedResultElement.closest('div').parent().find('.load-saved-result-button');            

            log($base);
            log(displayOptionsLabel);
            log(displayOptionsWrapper);
            log(displayOptionsField);
            log(savedResultText);
            log(savedResultElement);
            log(displayOptionsDefaultsButton);
            log(loadPXDataFromUrlAddressButton);

            //Update elements

            //Update displayOptionsWrapper
            displayOptionsWrapper.css("display","none");
            displayOptionsLabel.click(function() {
                if(displayOptionsWrapper.css("display") == "none") {
                    displayOptionsWrapper.css("display","block");
                } else {
                    displayOptionsWrapper.css("display","none");
                }
            });

            ////Update displayOptionsDefaultsButton
            displayOptionsDefaultsButton.html("<a target='_blank' href='#'>Innles standard uppsetan</a>");
            displayOptionsDefaultsButton.click((function(e) {
                e.preventDefault();

                displayOptionsField.val(JSON.stringify(defaultDisplayOptions,0,4));
            }));

            //Update loadPXDataFromUrlAddressButton
            loadPXDataFromUrlAddressButton.html("<a target='_blank' href='#'>Innles ella endurinnles dáta</a>");
            loadPXDataFromUrlAddressButton.click(function(e) {
                e.preventDefault();
                
                var address = savedResultElement.val();
                
                if(address) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var px = new Px(xhr.responseText);
                            let text = JSON.stringify(px, null, 4);
                            savedResultText.val(text);
                        }
                    };
                    
                    xhr.open('GET', address);
                    xhr.overrideMimeType('text/xml; charset=iso-8859-15');
                    xhr.send();
                } else {
                    log("NOT " + address);
                    savedResultText.val("");
                }

                return false;
            });

        });
        }
    }

    let log = function(text) {
        if(isDebug)
            console.log(text);
    }
})(jQuery);

