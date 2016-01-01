<?php
/**from https://github.com/panique/php-long-polling/blob/master/server/server.php
 * Server-side file.
 * This file is an infinitive loop. Seriously.
 * It gets the file data.txt's last-changed timestamp, checks if this is larger than the timestamp of the
 * AJAX-submitted timestamp (time of last ajax request), and if so, it sends back a JSON with the data from
 * data.txt (and a timestamp). If not, it waits for one seconds and then start the next while step.
 *
 * Note: This returns a JSON, containing the content of data.txt and the timestamp of the last data.txt change.
 * This timestamp is used by the client's JavaScript for the next request, so THIS server-side script here only
 * serves new content after the last file change. Sounds weird, but try it out, you'll get into it really fast!
 */
 
// set php runtime to unlimited
	set_time_limit(0);
// where does the data come from ? In real world this would be a SQL query or something
	$data_source_file = 'data.txt';
// main loop
	$sleepTime=200000;
	//~ while (true) { // this would make it spin forever!
	//big issue here is that the time resolution of this is 1s
		// if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
		$last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;
		// PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
		clearstatcache();
		// get timestamp of when file has been changed the last time
		$timestamp = filemtime($data_source_file); 
		// if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
		if ($last_ajax_call == null || $timestamp > $last_ajax_call) {
			// get content of data.txt
			$data = file_get_contents($data_source_file);
			// put data.txt's content and timestamp of last data.txt change into array
			$exploded = explode(' ', trim($data));
			// echo "COUNT: "+count($exploded);
			if(count($exploded)!==3){ //failure
				usleep($sleepTime);
				continue;
			}
			$scene_id=trim($exploded[0]);
			$fadetime=trim($exploded[1]);
			$class=trim($exploded[2]);
			echo 'activeDiv='.$scene_id.';'.
				'fadeTime='.$fadetime.';'.
				'var activeDivClass='.$class.';'.
				'timestamp='.$timestamp.';';	
			//~ break;
		} else {
			//~ usleep( $sleepTime );
			//~ continue;
		}
	//~ }
?>
