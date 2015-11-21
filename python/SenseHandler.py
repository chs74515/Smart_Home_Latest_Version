from sense_hat import SenseHat

class SenseHandler(object):
	def __init__(self):
		global sense
		sense = SenseHat()

	def turn_on_light(self, index, color = [255,255,255]):
		pixels = sense.get_pixels()
		pixels[index] = color
		sense.set_pixels(pixels)

	def turn_off_light(self, index):
		pixels = sense.get_pixels()
		pixels[index] = [0,0,0]
		sense.set_pixels(pixels)

	def turn_off_all_lights(self):
		sense.clear()

	def send_message(self, message, speed = .1):
		sense.show_message(message, speed)
        
        def set_pixels(self, ids):
            sense.set_pixels(ids)
        
        def get_pixels(self):
            return sense.get_pixels()

	def get_temperature(self):
		print sense.get_temperature()	
