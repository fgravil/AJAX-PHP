<?php
class Config{
	/** Function to actually get the db info from init.php
	 *	The $path is the path of the field needed in $GLOBALS['config'] array
	 */
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			// Sets the path as an array of values that's been separated by '/' 
			$path = explode('/',$path);

			/** If the path matches the values from the $GLOBALS['config'] array,
			 *	the config variable gets the needed fields.
			 */
			foreach ($path as $bit) {
				if(isset($config[$bit])){
					$config = $config[$bit];
				}
			}

			// Returns the requested field from the $GLOBALS['config'] array, i.e. '127.0.0.1' or 'root'
			return $config;
		}
		return false;
	}
}