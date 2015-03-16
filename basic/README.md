#Walking Stats
Measure and keep track of distances and times you do when walking
The basic app does 
Uploaded to www.conorgilmer.eu/basic/index.php

##Admin App
---------
+ Add a walk saving date, time and distance (maybe comment etc. aswell)
+ Walk can up added, updated and deleted
+ List Walks (various ways)
+ Walk can up added, updated and deleted
+ Display statistics (graphs using http://phpmygraph.abisvmm.nl/)
  + Time - line and bar chart
  + Distance - line and bar chart
  + Speed - line chart
  + Places - Pie chart (using LibChart)
+ Generate Report display on screen
+ Print Report (PDF) - using www.fpdf.org and LibChart
+ Import CSV to mysql - commandline/browser no gui
+ Export CSV
+ logout fn

##Public App
+ list walks without editing/deleting functionality
+ Summary Graphs
+ Login fn


##To Do
+ Validation on insert/update of both walks and routes
  + basic php string and isnumeric (done)
  + javascript validation
+ Date formating on entry
+ Add are you sure to delete procedure
+ Disable delete on deleting a route which exists
+ make mobile friendly
+ replace addedby but whoevers is logged on
+ combo graphs
+ add calories
+ add graphs for each walk
