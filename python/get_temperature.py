from SenseHandler import SenseHandler

sense = SenseHandler()

temp = sense.get_temperature()

sense.sendMessage(temp)