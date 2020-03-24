<?php

namespace PolicyReporter;

class FiniteStateMachine
{
    public const STATE_0 = 0;
    public const STATE_1 = 1;
    public const STATE_2 = 2;

    protected $allowedValues = [0, 1];
    protected $currentState;

    /**
     * FiniteStateMachine constructor.
     */
    public function __construct()
    {
        $this->currentState = self::STATE_0;
    }

    /**
     * Returns the current state of the finite state machine
     * @return int
     */
    public function getCurrentState(): int
    {
        return $this->currentState;
    }

    /**
     * Sets the current state of the finite state machine
     * @param int $currentState
     */
    public function setCurrentState(int $currentState): void
    {
        $this->currentState = $currentState;
    }

    /**
     * Tests the value (0 or 1) and returns the final state
     * Throws exception if an invalid value is received
     * @param int $value
     * @return int
     * @throws \Exception
     */
    public function checkValue(int $value): int
    {
        if (!in_array($value, $this->allowedValues)) {
            throw new \Exception("Invalid value passed. Must be 1 or 0");
        }

        switch($this->currentState) {
            case self::STATE_0:
                $this->currentState = self::STATE_1;
                if($value == 0) {
                    $this->currentState = self::STATE_0;
                }
                break;
            case self::STATE_1:
                $this->currentState = self::STATE_0;
                if($value == 0) {
                    $this->currentState = self::STATE_2;
                }
                break;
            case self::STATE_2:
                $this->currentState = self::STATE_2;
                if($value == 0) {
                    $this->currentState = self::STATE_1;
                }
                break;
        }

        return $this->currentState;
    }
}