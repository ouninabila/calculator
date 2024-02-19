<?php

class Calculator {
    private $result;
    private $operator;

    public function __construct($initial = null, $initialoperator = null) {
        $this->result = isset($initial) ? $initial : null;
        $this->operator = isset($initialoperator) ? $initialoperator: null;
    }

    public function one() {
        return $this->operation(1);
    }

    public function two() {
        return $this->operation(2);
    }

    public function three() {
        return $this->operation(3);
    }

    public function four() {
        return $this->operation(4);
    }

    public function five() {
        return $this->operation(5);
    }

    public function six() {
        return $this->operation(6);
    }

    public function seven() {
        return $this->operation(7);
    }

    public function eight() {
        return $this->operation(8);
    }

    public function nine() {
        return $this->operation(9);
    }

    public function zero() {
        return $this->operation(0);
    }

    public function plus() {
        return $this->operation('+');
    }

    public function minus() {
        return $this->operation('-');
    }

    public function times() {
        return $this->operation('*');
    }

    public function dividedInto() {
        return $this->operation('/');
    }

    private function operation($value) {
        if ($this->result === null) {
            $this->result = $value;
        
        } else {
            if (is_numeric($value)) {
                $this->result = $this->calculate($value);
                
                
            } else {
                if ($value !== '+' && $value !== '-' && $value !== '*' && $value !== '/') {
                    throw new InvalidArgumentException('Invalid operation');
                    
                }
                $this->operator = $value;
            }
        }

        return $this;
    }

    private function calculate( $value) {
        switch ($this->operator) {
            case '+':
                return $this->result  + $value;
            case '-':
                return $this->result - $value;
            case '*':
                return $this->result * $value;
            case '/':
                if ($value == 0) {
                    throw new InvalidArgumentException('Division by zero');
                }
                return $this->result / $value;
            default:
                throw new InvalidArgumentException('Invalid operation');
        }
        
    }

    public function __toString() {
        return (string) $this->result;
    }
}

$calc = new Calculator();
echo $calc->nine()->minus()->nine(); // 0
//echo "\n";
//echo $calc->seven()->plus()->one(); // 8

echo "\n";
//echo $calc->two()->times()->two()->times()->zero(); // 0
echo "\n";
//echo $calc->eight()->dividedInto()->two()->dividedInto()->two(); // 2
echo "\n";
//echo $calc->six()->dividedInto()->two()->times()->two(); // 6
echo "\n";