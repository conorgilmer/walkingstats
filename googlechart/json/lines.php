<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <!--script type="text/javascript" src="jquery-1.9.1.min.js"></script-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script type="text/javascript">

                // Load the Visualization API and the chart package.
                google.load('visualization', '1', {'packages':['corechart']});
  function drawItems(num) {
    var jsonChartData = $.ajax({
      url: "genlinegraph.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonChartData);
                        var options = {
                                title: 'Walking ' +num,
                                width: 500,
                                height: 300
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                }
    </script>


</head>
<body>
  <form>
  <select name="users" onchange="drawItems(this.value)">
  <option value="">Select a Graph:</option>
    <option value="calories">Calories</option>
    <option value="distance_km">Distance</option>
    <option value="minutes">Time</option>
    <option value="speed">Speed</option>
  </select>
  </form>
  <div id="chart_div"></div>
  <div id="table_div"></div>
</body>
</html>
