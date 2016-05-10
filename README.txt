    ___       ___       ___       ___       ___            ___       ___       ___       ___   
   /\  \     /\__\     /\  \     /\  \     /\  \          /\__\     /\  \     /\__\     /\  \  
  /::\  \   /::L_L_   /::\  \   /::\  \    \:\  \        /:/__/_   /::\  \   /::L_L_   /::\  \ 
 /\:\:\__\ /:/L:\__\ /::\:\__\ /::\:\__\   /::\__\      /::\/\__\ /:/\:\__\ /:/L:\__\ /::\:\__\
 \:\:\/__/ \/_/:/  / \/\::/  / \;:::/  /  /:/\/__/      \/\::/  / \:\/:/  / \/_/:/  / \:\:\/  /
  \::/  /    /:/  /    /:/  /   |:\/__/   \/__/           /:/  /   \::/  /    /:/  /   \:\/  / 
   \/__/     \/__/     \/__/     \|__|                    \/__/     \/__/     \/__/     \/__/  

_______________________________________________________________________________________________

This is the readme file for the smart home project source code. IT outlines the files contained
included within this current directory. All code is live at www.smartablehome.com. You are welcome
to visit this page to view the end results of our project. This file was compiled on 5/9/2016 and
reflects the current state of this software at that time.

Created by Brody Bruns, Thomas Murray and Caleb Ogbonaya.

i. Changelog.txt
This file contains all of the commits from the git for our project. Each commit contains the
date of the commit, the person who made the commit and the comment that was made with the commit.

ii. index.php
This file is the landing page of our web based interface. It contains the first essential include 
of shell.php and performs authentication actions. It also displays menus based on the viewers
authenticated status.

iii. shell.php
This file contains the background encapsulating 'shell' of our project. It takes care of including
essential files and displaying js scripts and css tags. In case of an ajax call, this file is called,
however the ajax session variable prevents any extra script tags from being displayed.

iv. php directory
The php directory contains all of our php object class files. Each class contains the naming convention
of mainClass.class.php. Where mainClass is the name of the class contained within the file.

v. js directory
The js directory contains all of our external javascript files. Most of these files are included within
shell.php.

vi. css directory
The css directory contains all of our external cascading style sheets for this project. Most of them are
included within the shell.php file.

vii. ajax directory
The ajax directory contains all of our php files that we are using for ajax pages. Each file contains the
naming convention of pageName.ajax.php. Most of these files are reference from within js/ajax.js.

viii. images directory
The image directory contains all of the image content that is contained within our website.

ix. php/deconz
The deconz directory contains all of the php files that interact with the deconz RESTful web api. Each on of
these files are also a php class, so they contain the naming convention of className.class.php.

x. php/authentication.class.php
The authentication class contains all methods necessary for authenticating a user object.

xi. php/database.class.php
The database class contains methods useful for accessing the smart home database including inserting,
updating and loading objects from tables. It is extended by several database classes.

xii. php/group_relationships.class.php
The group_relationships class contains methods for interacting with the group relationships table in the 
database. It extends the database class.

xiii. php/lightGroup.class.php
The lightGroup class contains methods necessary to interact with the lightGroup table in the database.
It extends the database class. It also has methods for displaying and interacting with the light control
menu on the user interface.

xiv. php/lights.class.php
The lights class contains methods for interacting with the lights table in the database. It extends the
database class.

xv. php/management.class.php
The management class contains methods for creating and displaying the smart home management menu on 
the user interface. 

xvi. php/navigation_menu.class.php
The navigation menu class contains methods necessary for displaying and interacting with the normal
nav menu and the 'mobile' sliding nav menu.

xvii. php/schedule.class.php
The schedule class contains all of the methods for interacting with the schedules table in the database.
It also contains methods for displaying and interacting with the schedules menu in the user interface. It
extends database.class.php.

xviii. php/user.class.php
The user class contains methods for interacting with the user table in the smart home database. This class is
used to create a user object that can then be authenticated. It extends the database class.

ixx. php/deconz/config_request.class.php
The config request class contains methods for interacting with the config endpoint section of the 
deconz api using cURL. It extends deconz_api.class.php. The methods within this class are mostly used for
opening the network for new devices.

xx. php/deconz/deconz_api.class.php
The deconz api class contains methods for interacting with the deconz rest api using curl. It is 
extended by several other api classes, which use the curlRequest method to send requests to the api.

xxi. php/deconz/groups_request.class.php
The groups_request class contains methods for interacting with the groups endpoint section of the deconz
rest api. It extends the deconz_api class. The methods in this class can be used to create new deconz groups
or edit them as need be.

xxii. php/deconz/lights_request.class.php
The lights_request class contains methods for interacting with the lights endpoint section of the deconz
rest api. It extends the deconz_api class. the methods in theis class can be used to pull or change the
states of lights.

xxiii. php/deconz/schedule_request.class.php
The schedule_request class contains methods for interacting with the schedules endpoint section of the
deconz api. It extends the deconz_api class.

xxiv. php/deconz/touchlink_request.class.php
The touchlink_request class contains methods for interacting with the touchlink section of the deconz rest
api. It extends the deconz_api class. The request methods in this class are largely unused in part due
to the touchlink part of the api malfunctioning.

xxv. ajax/addLightGroup.ajax.php
The addLightGroup php page is used to process the addLightGroup form and add a light group to the database
and deconz. It is referenced from an ajax call within ajax.js.

xxvi. ajax/addUser.ajax.php
The addUser php page is used to process the addUser form and add a user to the database. It is referenced
from an ajax call in ajax.js.

xxvii. ajax/changeColor.ajax.php
The changeColor php page is used to process the changeColor form and change the color of a lightbulb.
It is unused due to malfunctions with our one testable color changing light bulb.

xxviii. ajax/createSchedule.ajax.php
The createSchedule ajax page is used to process the createSchedule form and create a Schedule within the
database and deconz. It is referneced from an ajax call in ajax.js.

xxix. ajax/deleteLight.ajax.php
The deleteLight ajax page is used to process the deleteLight form and delete a light from the database.
It is referenced from an ajax call in ajax.js.

xxx. ajax/deleteSchedule.ajax.php
The deleteSchedule ajax page is used to process the deleteSchedule form and delete a schedule from the 
database and deconz. It is referenced from an ajax call within ajax.js.

xxxi. ajax/dimLight.ajax.php
The dimLight ajax page is used to process the dimLight slider input and dim a lightbulb. It is referenced
from an ajax call in ajax.js.

xxxii. ajax/lightbulb.ajax.php
The lightbulb page is used to process the toggle lightbulb form on the light group control page. It will
toggle a light bulb on or off. It is referenced from an ajax call in ajax.js.

xxxiii ajax/menuHandler.ajax.php
The menuHandler ajax page is used to process selections on the smart home management menu and update the
page as the selected menu. It is refenced from an ajax call within ajax.js.

xxxix. ajax/syncLights.ajax.php
The syncLights page is used to sync the light control menu in the background and reload it if there are
any changes. The page is currently not in use due to complexities in updating the lights page.

xL. ajax/updateName.ajax.php
The updateName page is used to process the update group name form and update a group name in the 
database and in deconz. It is refenced from an ajax call within ajax.js.

xLi. ajax/updateSchedule.ajax.php
The updateSchedule ajax page is used to process the update schedule form on the schedule management menu.
It updates a schedule in the database and in deconz. It is currenlty not implemented.

xLii. js/ajax.js
The ajax javascript file is used to perform ajax requests to several ajax files within our site. It is used
to do several actions such as turn a light bulb on or off, add a light group, change to a sub menu and many
more features. It is included using a script tag within shell.php.

xLiii. js/jquery-2.1.4.min.js
The jquery javascript file contains the basic jquery library. It is not currently in use as we are loading
the jquery library using google's api link to speed up page load time. We just never removed the local 
copy of jquery.

xLiv. js/mobile.js
The mobile javascript file contains functions to perform operations on our 'mobile' version of the nav menu
such as sliding it in and out of view.

xLv. css/homePage.css
The homePage external style sheet contains styles for the initial landing page that the user sees after
authenticating.

xLvi. css/index.css
The index external style sheet contains styles that are in use throughout the web application. Namely things
such as the size of the text or font style.

xLvii. css/management.css
The management external style sheet contains styles that are in use on the smart home management menu such as
menu buttons.

xLviii. css/navBar.css
The navBar external style sheet contains styles that pertain to the navigation bar. This includes the mobile
'sliding' nav bar as well as the one that appears on the home page.

xLix License
The license file contains information concerning the state of our software and its useage rights.

This website may be found at www.smartablehome.com.