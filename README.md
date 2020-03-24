# Policy Reporter Code Test
## Matthew Cameron

LinkedIn: https://www.linkedin.com/in/matthewcameron2007/

## Instructions
Run `composer install`

Navigate to index.php in a browser. eg `http://localhost/PolicyReporter/index.php` 

To change the value being tested, update `index.php` on line 10

## Assumptions
I assumed that the state machine would only handle 1 value at a time, and the calling code would handle iterating
through the entire string of ones and zeros. It would not be difficult to update the FiniteStateMachine class to handle
storing the entire string and parsing through it.

## Tests
After running `composer install` you should be able to run the tests with `./vendor/bin/phpunit` to execute the tests.

Unfortunately, my main work machine died on me, and I had to build and test this on Windows. The command that I used
for testing is `php phpunit-6.2.4.phar tests/FiniteStateMachineTest.php`. I have included this file in the repo for the
event that there is an issue running the PHPUnit tests with the command above.
