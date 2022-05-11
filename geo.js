am5.ready(function() {
    
    // Create root
    var root = am5.Root.new("chartdiv"); 
    
    // Set themes
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    var chart = root.container.children.push(am5map.MapChart.new(root, {
      panX: "rotateX",
      panY: "none",
      projection: am5map.geoNaturalEarth1(),
      layout: root.horizontalLayout
    }));
    
    // Create polygon series
    var polygonSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
      geoJSON: am5geodata_worldLow,
      valueField: "value",
      calculateAggregates: true
    }));
    
    polygonSeries.mapPolygons.template.setAll({
      tooltipText: "{name}: {value}"
    });
    
    polygonSeries.set("heatRules", [{
      target: polygonSeries.mapPolygons.template,
      dataField: "value",
      min: am5.color(0xff621f),
      max: am5.color(0x661f00),
      key: "fill"
    }]);
    
    polygonSeries.mapPolygons.template.events.on("pointerover", function(ev) {
      heatLegend.showValue(ev.target.dataItem.get("value"));
    });
    
    polygonSeries.data.setAll([
      {id: "TH", value: 4447100 },
      {id: "AF" , value: 2112345 },
      {id: "AL" , value: 4000000 },
      {id: "DZ" , value: 4000000 },
      {id: "AD" , value: 4000000 },
      {id: "AO" , value: 4000000 },
      {id: "AG" , value: 4000000 },
      {id: "AR" , value: 4000000 },
      {id: "AM" , value: 4000000 },
      {id: "AU" , value: 4000000 },
      {id: "AT" , value: 4000000 },
      {id: "AZ" , value: 4000000 },
      {id: "BS" , value: 4000000 },
      {id: "BH" , value: 4000000 },
      {id: "BD" , value: 4000000 },
      {id: "BB" , value: 4000000 },
      {id: "BY" , value: 4000000 },
      {id: "BE" , value: 4000000 },
      {id: "BZ" , value: 4000000 },
      {id: "BJ" , value: 4000000 },
      {id: "BT" , value: 4000000 },
      {id: "BO" , value: 4000000 },
      {id: "BA" , value: 4000000 },
      {id: "BW" , value: 4000000 },
      {id: "BR" , value: 4000000 },
      {id: "BN" , value: 4000000 },
      {id: "BG" , value: 4000000 },
      {id: "BF" , value: 4000000 },
      {id: "BI" , value: 4000000 },
      {id: "CV" , value: 4000000 },
      {id: "KH" , value: 4000000 },
      {id: "CM" , value: 4000000 },
      {id: "CA" , value: 4000000 },
      {id: "CF" , value: 4000000 },
      {id: "CL" , value: 4000000 },
      {id: "CN" , value: 4000000 },
      {id: "CO" , value: 4000000 },
      {id: "KM" , value: 4000000 },
      {id: "CK" , value: 4000000 },
      {id: "CR" , value: 4000000 },
      {id: "CI" , value: 4000000 },
      {id: "HR" , value: 4000000 },
      {id: "CU" , value: 4000000 },
      {id: "CY" , value: 4000000 },
      {id: "CZ" , value: 4000000 },
      {id: "CD" , value: 4000000 },
      {id: "DK" , value: 4000000 },
      {id: "DJ" , value: 4000000 },
      {id: "DM" , value: 4000000 },
      {id: "DO" , value: 4000000 },
      {id: "EC" , value: 4000000 },
      {id: "EG" , value: 4000000 },
      {id: "SV" , value: 4000000 },
      {id: "EE" , value: 4000000 },
      {id: "ET" , value: 4000000 },
      {id: "FJ" , value: 4000000 },
      {id: "FI" , value: 4000000 },
      {id: "FR" , value: 4000000 },
      {id: "GA" , value: 4000000 },
      {id: "GE" , value: 4000000 },
      {id: "DE" , value: 4000000 },
      {id: "GH" , value: 4000000 },
      {id: "GR" , value: 4000000 },
      {id: "GT" , value: 4000000 },
      {id: "GN" , value: 4000000 },
      {id: "GY" , value: 4000000 },
      {id: "HT" , value: 4000000 },
      {id: "VA" , value: 4000000 },
      {id: "HN" , value: 4000000 },
      {id: "HU" , value: 4000000 },
      {id: "IS" , value: 4000000 },
      {id: "IN" , value: 4000000 },
      {id: "ID" , value: 4000000 },
      {id: "IR" , value: 4000000 },
      {id: "IQ" , value: 4000000 },
      {id: "IE" , value: 4000000 },
      {id: "IL" , value: 4000000 },
      {id: "IT" , value: 4000000 },
      {id: "JM" , value: 4000000 },
      {id: "JP" , value: 4000000 },
      {id: "JO" , value: 4000000 },
      {id: "KZ" , value: 4000000 },
      {id: "KE" , value: 4000000 },
      {id: "KW" , value: 4000000 },
      {id: "KG" , value: 4000000 },
      {id: "LA" , value: 4000000 },
      {id: "LV" , value: 4000000 },
      {id: "LB" , value: 4000000 },
      {id: "LS" , value: 4000000 },
      {id: "LR" , value: 4000000 },
      {id: "LI" , value: 4000000 },
      {id: "LT" , value: 4000000 },
      {id: "LU" , value: 4000000 },
      {id: "MG" , value: 4000000 },
      {id: "MW" , value: 4000000 },
      {id: "MY" , value: 4000000 },
      {id: "MV" , value: 4000000 },
      {id: "ML" , value: 4000000 },
      {id: "MT" , value: 4000000 },
      {id: "MH" , value: 4000000 },
      {id: "MR" , value: 4000000 },
      {id: "MU" , value: 4000000 },
      {id: "MX" , value: 4000000 },
      {id: "MC" , value: 4000000 },
      {id: "MN" , value: 4000000 },
      {id: "ME" , value: 4000000 },
      {id: "MA" , value: 4000000 },
      {id: "MZ" , value: 4000000 },
      {id: "MM" , value: 4000000 },
      {id: "NP" , value: 4000000 },
      {id: "NL" , value: 4000000 },
      {id: "NZ" , value: 4000000 },
      {id: "NI" , value: 4000000 },
      {id: "NE" , value: 4000000 },
      {id: "NG" , value: 4000000 },
      {id: "MK" , value: 4000000 },
      {id: "NO" , value: 4000000 },
      {id: "OM" , value: 4000000 },
      {id: "PK" , value: 4000000 },
      {id: "PW" , value: 4000000 },
      {id: "PA" , value: 4000000 },
      {id: "PG" , value: 4000000 },
      {id: "PY" , value: 4000000 },
      {id: "PE" , value: 4000000 },
      {id: "PH" , value: 4000000 },
      {id: "PL" , value: 4000000 },
      {id: "PT" , value: 4000000 },
      {id: "QA" , value: 4000000 },
      {id: "KR" , value: 4000000 },
      {id: "MD" , value: 4000000 },
      {id: "RO" , value: 4000000 },
      {id: "RU" , value: 4000000 },
      {id: "RW" , value: 4000000 },
      {id: "SM" , value: 4000000 },
      {id: "ST" , value: 4000000 },
      {id: "SA" , value: 4000000 },
      {id: "SN" , value: 4000000 },
      {id: "RS" , value: 4000000 },
      {id: "SC" , value: 4000000 },
      {id: "SL" , value: 4000000 },
      {id: "SG" , value: 4000000 },
      {id: "SK" , value: 4000000 },
      {id: "SI" , value: 4000000 },
      {id: "ZA" , value: 4000000 },
      {id: "ES" , value: 4000000 },
      {id: "LK" , value: 4000000 },
      {id: "VC" , value: 4000000 },
      {id: "PS" , value: 4000000 },
      {id: "SD" , value: 4000000 },
      {id: "SE" , value: 4000000 },
      {id: "CH" , value: 4000000 },
      {id: "SY" , value: 4000000 },
      {id: "TJ" , value: 4000000 },
      {id: "TO" , value: 4000000 },
      {id: "TT" , value: 4000000 },
      {id: "TN" , value: 4000000 },
      {id: "TR" , value: 4000000 },
      {id: "UG" , value: 4000000 },
      {id: "UA" , value: 4000000 },
      {id: "AE" , value: 4000000 },
      {id: "GB" , value: 4000000 },
      {id: "TZ" , value: 4000000 },
      {id: "US" , value: 4000000 },
      {id: "UY" , value: 4000000 },
      {id: "UZ" , value: 4000000 },
      {id: "VE" , value: 4000000 },
      {id: "VN" , value: 4000000 },
      {id: "ZM" , value: 4000000 },
      {id: "ZW" , value: 4000000 }

    ]);
    
    var heatLegend = chart.children.push(am5.HeatLegend.new(root, {
      orientation: "vertical",
      startColor: am5.color(0xff621f),
      endColor: am5.color(0x661f00),
      startText: "Lowest",
      endText: "Highest",
      stepCount: 5
    }));
    
    heatLegend.startLabel.setAll({
      fontSize: 12,
      fill: heatLegend.get("startColor")
    });
    
    heatLegend.endLabel.setAll({
      fontSize: 12,
      fill: heatLegend.get("endColor")
    });
    
    // change this to template when possible
    polygonSeries.events.on("datavalidated", function () {
      heatLegend.set("startValue", polygonSeries.getPrivate("valueLow"));
      heatLegend.set("endValue", polygonSeries.getPrivate("valueHigh"));
    });
    
    }); // end am5.ready()