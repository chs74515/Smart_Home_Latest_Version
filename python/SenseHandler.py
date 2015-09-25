from sense_hat import SenseHat

class SenseHandler(object):
	def __init__(self):
		global sense
		sense = SenseHat()

	def turn_on_light(self, index):
		pixels = sense.get_pixels()
		pixels[index] = [255,255,255]
		sense.set_pixels(pixels)

	def turn_off_light(self, index):
		pixels = sense.get_pixels()
		pixels[index] = [0,0,0]
		sense.set_pixels(pixels)

	def turn_off_all_lights(self):
		sense.clear()

	def send_message(self, message, speed = .1):
		sense.show_message(message, speed)