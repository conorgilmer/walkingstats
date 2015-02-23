#walkstats.awk
One thing awk is great for is reading in data and churning it out
> awk -f walkstats.awk walks.csv
or
> awk -f walkstats.awk walks.csv > report.out

##Layout out input csv file
number,mintues,distance_km,speed,date,
