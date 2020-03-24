<?php
use PHPUnit\Framework\TestCase;
use PolicyReporter\FiniteStateMachine;

final class FiniteStateMachineTest extends TestCase
{
    /**
     * Tests FiniteStateMachine::setCurrentState() and FiniteStateMachine::getCurrentState()
     * @dataProvider providerListStates
     * @param int $state
     */
    public function testSetterAndGetter(int $state)
    {
        $testFiniteStateMachine = new FiniteStateMachine();

        $testFiniteStateMachine->setCurrentState($state);
        $receivedState = $testFiniteStateMachine->getCurrentState();

        $this->assertInternalType('int', $receivedState);
        $this->assertLessThan(3, $receivedState);
        $this->assertGreaterThan(-1, $receivedState);
        $this->assertTrue($receivedState == $state);
    }

    /**
     * Tests FiniteStateMachine::checkValue() function with valid inputs
     * @dataProvider providerValidFSM
     * @param int $value
     * @param int $expectedState
     */
    public function testValidCheckValue(int $value, int $expectedState)
    {
        $testFiniteStateMachine = new FiniteStateMachine();

        $testCharacterArray = str_split($value);
        $state = $testFiniteStateMachine::STATE_0;

        foreach ($testCharacterArray as $testCharacter) {
            try {
                $state = $testFiniteStateMachine->checkValue($testCharacter);
            } catch (\Exception $e) {
                $this->fail("Should not receive exception");
            }
        }

        $this->assertInternalType('int', $state);
        $this->assertLessThan(3, $state);
        $this->assertGreaterThan(-1, $state);
        $this->assertTrue($state == $expectedState);
    }

    /**
     * Tests FiniteStateMachine::checkValue() function with invalid inputs
     * @dataProvider providerInvalidFSM
     * @expectedException \Exception
     * @param int $value
     * @param int $expectedState
     */
    public function testInvalidCheckValue(int $value, int $expectedState)
    {
        $testFiniteStateMachine = new FiniteStateMachine();

        $testCharacterArray = str_split($value);

        foreach ($testCharacterArray as $testCharacter) {
            $state = $testFiniteStateMachine->checkValue($testCharacter);
        }

        $this->fail("Should have received exception.");
    }

    /**
     * Provides valid values for testing FiniteStateMachine::checkValues() function
     * @return array
     */
    public function providerValidFSM()
    {
        return [
                ['110', FiniteStateMachine::STATE_0],
                ['1010', FiniteStateMachine::STATE_1]
        ];
    }

    /**
     * Provides invalid values for testing FiniteStateMachine::checkValues() function
     * @return array
     */
    public function providerInvalidFSM()
    {
        return [
            ['123', FiniteStateMachine::STATE_0],
            ['1010103', FiniteStateMachine::STATE_1],
            ['567', FiniteStateMachine::STATE_2]
        ];
    }

    /**
     * Provides a list of available states for testing setters and getters
     * @return array
     */
    public function providerListStates()
    {
        return [
            [FiniteStateMachine::STATE_0],
            [FiniteStateMachine::STATE_1],
            [FiniteStateMachine::STATE_2]
        ];
    }
}