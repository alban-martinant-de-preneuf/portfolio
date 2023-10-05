#!/bin/bash
for i in *.{jpg,png,gif} 
do
   echo "Prcoessing image $i ..."
   /usr/bin/convert -thumbnail 300 $i thumbnail/thumb.$i
done
