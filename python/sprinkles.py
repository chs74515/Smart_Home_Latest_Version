import random
import time



from sense_hat import SenseHat
sense = SenseHat()
while(True):
	x = random.randint(0,7)
	y = random.randint(0,7)
	r = random.randint(0,255)
	g = random.randint(0,255)
	b = random.randint(0,255)
	sense.set_pixel(x,y,r,g,b)
	time.sleep(.01)
	sense.clear()