<?php

namespace Shmeeps\SimpleTimer;

class SimpleTimer {

    private static $totalTime = array();
    private static $currentTime = array();

    public static function start($category, $reset = false) {

        // Reset the total time if $reset is true, or create the storage container if it doesn't exist
        if ( ! array_key_exists($category, self::$totalTime) || $reset === true ) {
            self::$totalTime[$category] = array(
                'time' => 0,
                'count' => 0
            );
        }

        // Set currentTime to the current timestamp, and indicate that this category was called another time
        self::$currentTime[$category] = microtime(true);
        self::$totalTime[$category]['count'] += 1;
    }

    public static function stop($category) {

        // Calculate the time since start was called and add that to the total time for that category.
        self::$totalTime[$category]['time'] += (microtime(true) - self::$currentTime[$category]);
    }

    public static function getTotalTime($category) {
		
		// Return the total time for the given category
		return self::$totalTime[$category]['time'];
    }
	
	public static function getAverageTime($category) {
		
		// Return the total time divided by the amount of times the category was recorded
		return self::$totalTime[$category]['time'] / self::$totalTime[$category]['count'];
	}
	
	public static function getRawTime($category) {
		return self::$totalTime[$category];
	}
	
	public static function getTotalTimes() {
		
		// Temporary storage
		$times = array();
		
		// Loop through each category and record the total time
		foreach (self::$totalTime as $category => $rec) {
			$times[$category] = $rec['time'];
		}
		
		// Return the result
		return $times;
	}
	
	public static function getAverageTimes() {

		// Temporary storage
		$times = array();
		
		// Loop through each category and record the average time
		foreach (self::$totalTime as $category => $rec) {
			$times[$category] = $rec['time'] / $rec['count'];
		}
		
		// Return the result
		return $times;
	}
	
	public static function getRawTimes() {
		return self::$totalTime;
	}
}