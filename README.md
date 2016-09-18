# dockedbydefault
Moodle Plugin to set block preference to docked on login

To install place the files in the /local folder of a moodle > 2.7 site.  Hence the code is in /local/dockedbydefault/index.php etc

View the site as an admin and install the plugin as normal

There are no settings, only an array of block ids in the /classes/observer.php file.

The id of blocks can be seen in the html of the block in moodle as 'InstanceIDHere'
