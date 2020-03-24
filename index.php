<?php

if (!file_exists('vendor/autoload.php')) {
    echo "Unable to find the autoload file. Are you sure you ran composer install? Please see the attached README.md.";
    die();
}
require_once ('vendor/autoload.php');

$stateMachine = new PolicyReporter\FiniteStateMachine();

/***************************/
/* CHANGE INPUT VALUE HERE */
/***************************/
$testString = '101001';
/***************************/

$testCharacterArray = str_split($testString);

$state = $stateMachine::STATE_0;
foreach ($testCharacterArray as $testCharacter) {
    try {
        $state = $stateMachine->checkValue($testCharacter);
    } catch (Exception $e) {
        echo $e->getMessage();
        break;
    }
}

echo sprintf("The test string is '%s'\n\n", $testString);
echo '<br />';
echo sprintf("The final state is %s", $state);