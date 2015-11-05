from sys import argv
from sys import exit
from SenseHandler import SenseHandler

# checks numbers of input
if(len(argv) < 3):
	print "Not enough params"
	exit(1)


lightid = argv[1]
lightstatus = argv[2]

sense = SenseHandler()

if(lightid == "lside"): # left side
	pixels = sense.get_pixels()
        for i in range(0,64,8):
            for j in range(i, i+4,1):
                pixels[j] = [0,255,0]
            for j in range(i+4, i+8,1):
                pixels[j] = [0,0,0]
	sense.set_pixels(pixels)

elif (lightid == "allamb"):
	pixels = sense.get_pixels()
        for i in range(0,64,1):
            pixels[i] = [0,0,153]
	sense.set_pixels(pixels)


elif (lightid == "rside"): #right side
	pixels = sense.get_pixels()
        for i in range(0,64,8):
            for j in range(i, i+4,1):
                pixels[j] = [0,0,0]
            for j in range(i+4, i+8,1):
                pixels[j] = [255,0,0]
	sense.set_pixels(pixels)

else: # got a number
	lightid = int(lightid)
	if(lightstatus == "on"):
		sense.turn_on_light(lightid, [0,255,0])
	elif(lightstatus ==  "off"):
		sense.turn_off_light(lightid)
	else:
		print "unknown light status"