./servod
for i in `seq 1 99`
do
echo $i

j=$((100 - i))

echo 0=$i% > /dev/servoblaster
echo 5=$j% > /dev/servoblaster
sleep 0.1
done

for i in `seq 1 99`
do
echo $i

j=$((100 - i))

echo 5=$i% > /dev/servoblaster
echo 0=$j% > /dev/servoblaster

echo 5=$i% 
echo 0=$j%
sleep 0.1
done
./servod
