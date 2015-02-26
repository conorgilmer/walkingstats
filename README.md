#Walking Stats

+ PHP (Basic)
+ Awk 


##Basic (PHP)
Measure and keep track of distances and times you do when walking
The basic app does 
###Admin App
---------
+ Add a walk saving date, time and distance (maybe comment etc. aswell)
+ Walk can up added, updated and deleted
+ List Walks (various ways)
+ Walk can up added, updated and deleted
+ Display statistics
  + Time - line and bar chart
  + Distance - line and bar chart
  + Speed - line chart
+ Print Report (PDF) - To Do
+ Import CSV to mysql - commandline/browser no gui
+ Export CSV
+ logout fn

###Public App
+ List walks
+ Login fn

##Awk
The awk version reads in a csv file and calculates average, totals, minimum and maximum very neatly
> awk -f walkstats.awk walks.csv > report.out
