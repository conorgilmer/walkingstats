#!/bin/awk
# Usage : awk -f walkstats.awk walks.csv > report.out
# or   cat walks.csv | awk -f walkstats.awk
# calculate the average time distancespend for each item in the csv file

BEGIN { FS = ","
        print "\n Walking Report"
        print "\nNo.\tDate    \tTime\tDistance\tSpeed\n";
	min1 =1000;
	min2 =1000;
	min3 =1000;
}
{
        printf "%s\t%s\t%.0f\t%.2f\t\t%.3f\n" , NR, $4, $1, $2, $3;
        sum1+=$1;
        sum2+=$2;
        sum3+=$3;
        ++n;

        min1 = (min1>$1)?$1:min1;
        min2 = (min2>$2)?$2:min2;
        min3 = (min3>$3)?$3:min3;

        max1=(max1>$1)?max1:$1;
        max2=(max2>$2)?max2:$2;
        max3=(max3>$3)?max3:$3;
}
END {
       printf "\n\tAverage:\t%.2f\t%.2f\t\t%.3f\n\n", sum1/n, sum2/n, sum3/n;
       printf "\tMinimum: \t %.0f\t %.2f\t\t%.3f\n", min1, min2, min3;
       printf "\tMaximum: \t %.0f\t %.2f\t\t%.3f\n", max1, max2, max3;
       printf "\n\tTotal:\t\t%.0f\t%.2f\t\n\n", sum1,sum2;
}
