<?php

class Calculator {
    private $operators;
    private $precedence;

    public function __construct() {
        $this->operators = ['+', '-', '*', '/'];
        $this->precedence = ['+' => 1, '-' => 1, '*' => 2, '/' => 2];
    }

    public function evaluate($expression) {
        $expression = str_replace(' ', '', $expression);
        $tokens = $this->tokenize($expression);
        $postfix = $this->toPostfix($tokens);
        return $this->evaluatePostfix($postfix);
    }

    private function tokenize($expression) {
        $tokens = [];
        $buffer = '';
        foreach (str_split($expression) as $char) {
            if (in_array($char, $this->operators)) {
                if (!empty($buffer)) {
                    $tokens[] = $buffer;
                    $buffer = '';
                }
                $tokens[] = $char;
            } else {
                $buffer .= $char;
            }
        }
        if (!empty($buffer)) {
            $tokens[] = $buffer;
        }
        return $tokens;
    }

    private function toPostfix($tokens) {
        $output = [];
        $stack = [];
        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                $output[] = $token;
            } elseif (in_array($token, $this->operators)) {
                while (!empty($stack) && $this->precedence[end($stack)] >= $this->precedence[$token]) {
                    $output[] = array_pop($stack);
                }
                $stack[] = $token;
            }
        }
        while (!empty($stack)) {
            $output[] = array_pop($stack);
        }
        return $output;
    }

    private function evaluatePostfix($postfix) {
        $stack = [];
        foreach ($postfix as $token) {
            if (is_numeric($token)) {
                $stack[] = $token;
            } elseif (in_array($token, $this->operators)) {
                $b = array_pop($stack);
                $a = array_pop($stack);
                switch ($token) {
                    case '+':
                        $stack[] = $a + $b;
                        break;
                    case '-':
                        $stack[] = $a - $b;
                        break;
                    case '*':
                        $stack[] = $a * $b;
                        break;
                    case '/':
                        if ($b == 0) {
                            throw new InvalidArgumentException('Division by zero');
                        }
                        $stack[] = $a / $b;
                        break;
                }
            }
        }
        if (count($stack) != 1) {
            throw new InvalidArgumentException('Invalid expression');
        }
        return $stack[0];
    }
}

$calc = new Calculator();

echo $calc->evaluate("7 + 1"); // 8
echo "\n";
echo $calc->evaluate("6 / 2 * 2"); // 6
echo "\n";
echo $calc->evaluate("9 - 9"); // 0
echo "\n";
echo $calc->evaluate("8 / 2 / 2"); // 2
echo "\n";
echo $calc->evaluate("2 * 2 * 0"); // 0
echo "\n";
