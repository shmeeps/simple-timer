Simple Timer
=======

A simple timer used to track the execution time of PHP scripts

Usage
-----

```php
<?php

use Shmeeps\SimpleTimer\SimpleTimer;

class Foo
{
    public function doSomething()
    {
		// ---- Single tracking
	
		// Start the timer
        SimpleTimer::start("formatLoop");
		
		// Execute code
		foreach ($this->objects as $object) {
			$object->format();
		}
		
		// Stop the timer
		SimpleTimer::stop("formatLoop");
		
		// Output the total time spent in the loop
		var_dump(SimpleTimer::getTotalTime("formatLoop"));
		
		// ---- Multiple tracking
		
		// Execute code
		foreach ($this->objects as $object) {
		
			SimpleTimer::start("fetchData");
			$object->fetch();
			SimpleTimer::stop("fetchData");
			
			SimpleTimer::start("prepData");
			$object->prep();
			SimpleTimer::stop("prepData");
			
			SimpleTimer::start("formatData");
			$object->format();
			SimpleTimer::stop("formatData");
		}
		
		// Output the total time fetching, the average time prepping, and both for formatting
		var_dump(SimpleTimer::getTotalTime("fetchData"));
		var_dump(SimpleTimer::getAverageTime("preData"));
		var_dump(SimpleTimer::getRawTime("formatData"));
    }
}
```