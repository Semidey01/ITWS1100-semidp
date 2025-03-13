# Lab 6 - JavaScript and jQuery

#### In this lab I had to use JQuery to make an HTML page more dynamic. 

#### landing page (lab 6): http://semidprpi.eastus.cloudapp.azure.com/iit/lab6/lab6.html

#### website page: http://semidprpi.eastus.cloudapp.azure.com/iit/

#### password: Antonio00!1074

## SUMMARY

1. Used .text and .css to change the syle of 'Your Name' When You click on it.

2. Used .fadeIn and .fadeOut to make the text appear and dissapear.

3. On part 3, I initially used a click() event, but after getting to part 5, I realized the only way to make it work was to change it into a .on() event, where when you click an item in the list, it checks of it already has the .red class. If it does, it eliminates it, and if it doesn't have it, it adds it.

4. For part 4, I simply appended a new item list to the bottom of the list using .append()

5. For part 5, the new list item did not turn red when clicked because the event listener was not attached to the new list item. To fix this, I used the .on() method to attach the event listener to the parent element of the new list item. This way, whenever an item is clicked, it triggers the event, no matter when it was added. For the second part of part 5, I simply used .toggleFade(), to make the text fade in when its not active, and fade out when its active.

