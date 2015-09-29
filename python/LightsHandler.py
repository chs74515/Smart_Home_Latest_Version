from sys import argv
from sys import exit
from SenseHandler import SenseHandler

# checks numbers of input
if(len(argv) < 3):
	print "Not enough params"
	exit(1)


lightid = int(argv[1])
lightstatus = argv[2]

sense = SenseHandler()

if(lightstatus == "on"):
	sense.turn_on_light(lightid, [0,255,0])
elif(lightstatus ==  "off"):
	sense.turn_off_light(lightid)
else:
	print "unknown light status"