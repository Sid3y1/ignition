wait
read -n1 -r -p "Press space to continue..." key
python stepperX.py 10 5000 1 &
wait
python stepperX.py 10 5000 -1 &
python stepperY.py 10 5000 1 &
wait
python stepperX.py 10 5000 1 &
wait
python stepperX.py 10 2500 -1 &
python stepperY.py 10 2500 1 &
wait
python stepperX.py 10 2500 -1 &
python stepperY.py 10 2500 -1 &
wait
python stepperY.py 10 5000 -1 &
wait
python stepperX.py 10 5000 1 &
python stepperY.py 10 5000 1 &
wait
python stepperY.py 10 5000 -1 &
wait
