<?php
defined('MOODLE_INTERNAL') || die();

class local_dockedbydefault_observer {
	
	public static function setprefs(\core\event\user_loggedin $event)
	{		
		// Preflight - Dock Block Script May 2016
		// set Navigation 962 and Administration 963 to dock
		// by adding a docked_block_instance to the user_preferences table		
		 
		// block instances ids are visible in the html - check these.
		//$blocks_to_set = [962,963];
		$blocks_to_set = [833,834];
		
		global $DB;
		
		// for getting and updating see:
		// https://docs.moodle.org/dev/Data_manipulation_API
		
		$prefs = $DB->get_records('user_preferences', array('userid'=>$event->userid));
		
		// construct prefs with the names as the keys for use below
		$userprefs = [];
		foreach($prefs as $pref){	
			$userprefs[$pref->name] = $pref->value;	
		}
				
		foreach($blocks_to_set as $blockid){
			if (isset($userprefs['docked_block_instance_'.$blockid]) && $userprefs['docked_block_instance_'.$blockid] == 0){
				$user_preferences = new stdClass();
				$user_preferences->name = 'docked_block_instance_'.$blockid;
				$user_preferences->value = 1; 
				$user_preferences->userid = $event->userid;
			
				$query = 'select id from mdl_user_preferences where userid='.$event->userid.' and name=\''.$user_preferences->name.'\';';
			
				$result = $DB->get_record_sql($query);
				$user_preferences->id = $result->id;
				$DB->update_record('user_preferences', $user_preferences, $bulk=false);
			
			} elseif (!isset($userprefs['docked_block_instance_'.$blockid])){
				$user_preferences = new stdClass();		
				$user_preferences->name = 'docked_block_instance_'.$blockid;
				$user_preferences->value = 1; 
				$user_preferences->userid = $event->userid;
				$DB->insert_record('user_preferences', $user_preferences);
			}
		}		
    }
}
