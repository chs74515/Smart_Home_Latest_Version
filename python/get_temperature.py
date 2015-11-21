from SenseHandler import SenseHandler

sense = SenseHandler()

temp = sense.get_temperature()

sense.send_message(temp)