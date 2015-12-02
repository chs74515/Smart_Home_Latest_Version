from sys import argv
from sys import exit
from SenseHandler import SenseHandler

#last argument is the light status
lightstatus = argv[len(argv)-1]

for i in range(1,len(argv)-2):
    lightId = argv[i]
    if(lightstatus == "on"):
		sense.turn_on_light(lightId, [0,255,0])
	elif(lightstatus ==  "off"):
		sense.turn_off_light(lightId)
	else:
		print "unknown light status for lightId " + lightID
