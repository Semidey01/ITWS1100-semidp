# Lab 8

### In this lab I had to use JSON as a databse, where all my labs and its information are stored. This JSON file is then ran through a JavaScript file that displays these labs.

#### Lab Landing page: http://semidprpi.eastus.cloudapp.azure.com/iit/Lab3/html/labs.html

#### Website Landing Page: http://semidprpi.eastus.cloudapp.azure.com/iit

## Summary

1. I deleted all my labs from labs.html and added a div with the id "menu".

2. In a new JSON file, I added a new collection called "menuItem", where all my labs were stored. Inside this collection, each bracket is a lab, where they are all primarily distinguished by name, and then the components of the lab.

3. In a new JavaScript file, I create a script that triggers when the page is loaded. The script uses AJAX and gets the information from the JSON file. I created an unordered list where every new lab is an item in the list. The way I organized my labs is the following: I added a class called dropdown which I had in my original labs.html. Then, I add the name of the lab, and after, I create a new class called dropdown content. Now, the script iterates through each remaining item in the JS bracket and adds it as a section of that lab in the drop down content. This way, All the labs are shown, and when you hover over a lab, the dropdown content is shown.

