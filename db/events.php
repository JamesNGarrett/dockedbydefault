<?php
defined('MOODLE_INTERNAL') || die();

/*	The following observer is recorded in the db upon install/upgrade.
 *	To refresh this you need to increment the version.php version.
 *
 *	The event below is obvious, the callback is a static func in the classes dir
 */

$observers = array(
    array(
        'eventname'   => '\core\event\user_loggedin',
        'callback'    => 'local_dockedbydefault_observer::setprefs'
    )
);