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
	pixels[0] = [0,255,0]
	pixels[1] = [0,255,0]
	pixels[2] = [0,255,0]
	pixels[3] = [0,255,0]

	pixels[4] = [0,0,0]
	pixels[5] = [0,0,0]
	pixels[6] = [0,0,0]
	pixels[7] = [0,0,0]

	pixels[8] = [0,255,0]
	pixels[9] = [0,255,0]
	pixels[10] = [0,255,0]
	pixels[11] = [0,255,0]

	pixels[12] = [0,0,0]
	pixels[13] = [0,0,0]
	pixels[14] = [0,0,0]
	pixels[15] = [0,0,0]

	pixels[16] = [0,255,0]
	pixels[17] = [0,255,0]
	pixels[18] = [0,255,0]
	pixels[19] = [0,255,0]

	pixels[20] = [0,0,0]
	pixels[21] = [0,0,0]
	pixels[22] = [0,0,0]
	pixels[23] = [0,0,0]

	pixels[24] = [0,255,0]
	pixels[25] = [0,255,0]
	pixels[26] = [0,255,0]
	pixels[27] = [0,255,0]

	pixels[28] = [0,0,0]
	pixels[29] = [0,0,0]
	pixels[30] = [0,0,0]
	pixels[31] = [0,0,0]

	pixels[32] = [0,255,0]
	pixels[33] = [0,255,0]
	pixels[34] = [0,255,0]
	pixels[35] = [0,255,0]

	pixels[36] = [0,0,0]
	pixels[37] = [0,0,0]
	pixels[38] = [0,0,0]
	pixels[39] = [0,0,0]

	pixels[40] = [0,255,0]
	pixels[41] = [0,255,0]
	pixels[42] = [0,255,0]
	pixels[43] = [0,255,0]

	pixels[44] = [0,0,0]
	pixels[45] = [0,0,0]
	pixels[46] = [0,0,0]
	pixels[47] = [0,0,0]

	pixels[48] = [0,255,0]
	pixels[49] = [0,255,0]
	pixels[50] = [0,255,0]
	pixels[51] = [0,255,0]

	pixels[52] = [0,0,0]
	pixels[53] = [0,0,0]
	pixels[54] = [0,0,0]
	pixels[55] = [0,0,0]

	pixels[56] = [0,255,0]
	pixels[57] = [0,255,0]
	pixels[58] = [0,255,0]
	pixels[59] = [0,255,0]

	pixels[60] = [0,0,0]
	pixels[61] = [0,0,0]
	pixels[62] = [0,0,0]
	pixels[63] = [0,0,0]
	
	sense.set_pixels(pixels)

elif (lightid == "allamb"):
	pixels = sense.get_pixels()
	pixels[0] = [156,42,0]
	pixels[1] = [156,42,0]
	pixels[2] = [156,42,0]
	pixels[3] = [156,42,0]

	pixels[4] = [156,42,0]
	pixels[5] = [156,42,0]
	pixels[6] = [156,42,0]
	pixels[7] = [156,42,0]

	pixels[8] = [156,42,0]
	pixels[9] = [156,42,0]
	pixels[10] = [156,42,0]
	pixels[11] = [156,42,0]

	pixels[12] = [156,42,0]
	pixels[13] = [156,42,0]
	pixels[14] = [156,42,0]
	pixels[15] = [156,42,0]

	pixels[16] = [156,42,0]
	pixels[17] = [156,42,0]
	pixels[18] = [156,42,0]
	pixels[19] = [156,42,0]

	pixels[20] = [156,42,0]
	pixels[21] = [156,42,0]
	pixels[22] = [156,42,0]
	pixels[23] = [156,42,0]

	pixels[24] = [156,42,0]
	pixels[25] = [156,42,0]
	pixels[26] = [156,42,0]
	pixels[27] = [156,42,0]

	pixels[28] = [156,42,0]
	pixels[29] = [156,42,0]
	pixels[30] = [156,42,0]
	pixels[31] = [156,42,0]

	pixels[32] = [156,42,0]
	pixels[33] = [156,42,0]
	pixels[34] = [156,42,0]
	pixels[35] = [156,42,0]

	pixels[36] = [156,42,0]
	pixels[37] = [156,42,0]
	pixels[38] = [156,42,0]
	pixels[39] = [156,42,0]

	pixels[40] = [156,42,0]
	pixels[41] = [156,42,0]
	pixels[42] = [156,42,0]
	pixels[43] = [156,42,0]

	pixels[44] = [156,42,0]
	pixels[45] = [156,42,0]
	pixels[46] = [156,42,0]
	pixels[47] = [156,42,0]

	pixels[48] = [156,42,0]
	pixels[49] = [156,42,0]
	pixels[50] = [156,42,0]
	pixels[51] = [156,42,0]

	pixels[52] = [156,42,0]
	pixels[53] = [156,42,0]
	pixels[54] = [156,42,0]
	pixels[55] = [156,42,0]

	pixels[56] = [156,42,0]
	pixels[57] = [156,42,0]
	pixels[58] = [156,42,0]
	pixels[59] = [156,42,0]

	pixels[60] = [156,42,0]
	pixels[61] = [156,42,0]
	pixels[62] = [156,42,0]
	pixels[63] = [156,42,0]

	sense.set_pixels(pixels)


elif (lightid == "rside"): #right side
	pixels = sense.get_pixels()
	pixels[0] = [0,0,0]
	pixels[1] = [0,0,0]
	pixels[2] = [0,0,0]
	pixels[3] = [0,0,0]

	pixels[4] = [255,0,0]
	pixels[5] = [255,0,0]
	pixels[6] = [255,0,0]
	pixels[7] = [255,0,0]

	pixels[8] = [0,0,0]
	pixels[9] = [0,0,0]
	pixels[10] = [0,0,0]
	pixels[11] = [0,0,0]

	pixels[12] = [255,0,0]
	pixels[13] = [255,0,0]
	pixels[14] = [255,0,0]
	pixels[15] = [255,0,0]

	pixels[16] = [0,0,0]
	pixels[17] = [0,0,0]
	pixels[18] = [0,0,0]
	pixels[19] = [0,0,0]

	pixels[20] = [255,0,0]
	pixels[21] = [255,0,0]
	pixels[22] = [255,0,0]
	pixels[23] = [255,0,0]

	pixels[24] = [0,0,0]
	pixels[25] = [0,0,0]
	pixels[26] = [0,0,0]
	pixels[27] = [0,0,0]

	pixels[28] = [255,0,0]
	pixels[29] = [255,0,0]
	pixels[30] = [255,0,0]
	pixels[31] = [255,0,0]

	pixels[32] = [0,0,0]
	pixels[33] = [0,0,0]
	pixels[34] = [0,0,0]
	pixels[35] = [0,0,0]

	pixels[36] = [255,0,0]
	pixels[37] = [255,0,0]
	pixels[38] = [255,0,0]
	pixels[39] = [255,0,0]

	pixels[40] = [0,0,0]
	pixels[41] = [0,0,0]
	pixels[42] = [0,0,0]
	pixels[43] = [0,0,0]

	pixels[44] = [255,0,0]
	pixels[45] = [255,0,0]
	pixels[46] = [255,0,0]
	pixels[47] = [255,0,0]

	pixels[48] = [0,0,0]
	pixels[49] = [0,0,0]
	pixels[50] = [0,0,0]
	pixels[51] = [0,0,0]

	pixels[52] = [255,0,0]
	pixels[53] = [255,0,0]
	pixels[54] = [255,0,0]
	pixels[55] = [255,0,0]

	pixels[56] = [0,0,0]
	pixels[57] = [0,0,0]
	pixels[58] = [0,0,0]
	pixels[59] = [0,0,0]

	pixels[60] = [255,0,0]
	pixels[61] = [255,0,0]
	pixels[62] = [255,0,0]
	pixels[63] = [255,0,0]

	sense.set_pixels(pixels)

else: # got a number
	lightid = int(lightid)
	if(lightstatus == "on"):
		sense.turn_on_light(lightid, [0,255,0])
	elif(lightstatus ==  "off"):
		sense.turn_off_light(lightid)
	else:
		print "unknown light status"