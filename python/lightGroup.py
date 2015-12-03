from sys import argv
from sys import exit
from SenseHandler import SenseHandler

sense = SenseHandler()

#last argument is the light status
lightstatus = argv[1]

for i in range(2,len(argv)):
    lightId = int(argv[i])

    if(lightstatus == "on"):
        sense.turn_on_light(lightId, [0,255,0])
    elif(lightstatus ==  "off"):
        sense.turn_off_light(lightId)
    else:
        print "unknown light status for lightId " + lightID
