# Palette-Picker

# Purpose
The purpose of the palette picker is to assist in giving the user 
multiple color options for their personal or professional projects

# Build Status
This is a beta version. There a few bugs that need to be addressed, and some
additional features that need to be implemented. 
- First bug is that if the user selects the color on the edge of the banner in the 
whitespace, it will set the color and the text of the palette square to white 
and make it seem invisible.
- Issue with Palette_screen.html. To be released at a later date.
- We do not yet have a SSL license, so uploading an image through a web browser
is not supported. We have provided examples to show how the functionality works.
- Saving Palettes to db is bugged. This will be fixed soon
- Switching from homePageLoggedIn.php to search.php, and then back to home will
 log out the user

# Technology involved
- PHP 7.4
- Apache2
- MySQL 8
- HTML/CSS
- JavaScript

# Current Features
- Create a Palette Manually
- Create Account
- Login to Account
- Pull a Palette from image(Image must be on server unless running locally)
- Search/View Saved Palettes

# How to use
Upload files to apache server(more feature if done locally in current version).
Create a database from our sql script. create a systemdata.php file to connect 
database. 

# Credits
- Eric Brewer
- Simon Stockton
- Lily Thompson
- Victoria Senn