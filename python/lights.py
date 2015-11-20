import random
import time
import sys



from sense_hat import SenseHat
sense = SenseHat()


name = sys.argv[1]
    
sense.show_message("Hello", .07)
sense.show_message(name, .08)
sense.show_message("You are now...",.07)
sense.show_message("BALLS DEEP",.08)
sense.show_message("in your Smart Home",.07)
