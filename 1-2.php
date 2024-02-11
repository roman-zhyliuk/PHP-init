<?php
$age = 15;

if ($age > 20) {
    print "You are allowed to buy alcohol. Enjoy!";
} elseif ($age == 21) {
    echo "Congratulations! You are allowed to buy alcohol at US!";
} else {
    echo "Sorry, but you are too young :(";
}

echo "</br>";

$day = "Lundi";

switch($day) {
    case "Monday":
        echo "I hate brits...";
        break;
    case "Lundi":
        echo "Bienvenue mon ami!";
        break;
    default:
        echo "On a rien a dire, Vous êtes pas francois";
}

echo "<br>";

for($i = 1; $i<=10; $i++) {
    echo ($i % 2 == 0? $i." is even" : $i." is odd");
    echo "<br>";
}

function calculateSum($num) {
    return $num[0] + $num[1];
}

echo calculateSum([5, 10])."<br>";
echo calculateSum([7, calculateSum([2, 4])])."<br>";

function findMax($arr) {
    $max = $arr[0];
    for($j = 0; $j<sizeof($arr); $j++) {
        if($arr[$j] > $max) {
            $max = $arr[$j];
        }
    }
    return $max;
}

function Fibonacci($n) {
    $arr = [0, 1];
    if($n <= 1) {
        return [0];
    } else {
        while(sizeof($arr) != $n) {
            array_push($arr, (end($arr) + prev($arr)));

        }
        return $arr;
    }
}

function isPrime($num)
{
    if($num > 1 && is_integer($num)) {
        for($i = 2; $i<$num; $i++) {
            if($num % $i == 0) {
                return "false";
            } else {
                continue;
            }
        }
        return "true";
    } else {
        return "false";
    }
}

function reverseString($str)
{
    $new_str = "";
    $str = str_split($str);
    for($i = sizeof($str)-1; $i >= 0; $i--) {
        $new_str = $new_str .= strval($str[$i]);
    }
    return $new_str;
}

function factorial($n)
{
    $fct = 1;
    for($i = 1; $i <= $n; $i++) {
        $fct *= $i;
    }
    return $fct;
}

echo findMax([3, 5, 1, 0, 4, 3, 5, 6, 1])."<br>";
echo findMax([0, 0, 0, 0, 0, 0, 0, 0])."<br>";
echo findMax([1, 1, 1, 1, 1, 1, 0])."<br>";
echo findMax([10, 9, 8, 7, 6, 5, 4, 3, 2, 1])."<br>";
echo findMax([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])."<br>";

print_r(array_values(Fibonacci(8)));
echo "</br>";
print_r(array_values(Fibonacci(15)));
echo "</br>";
print_r(array_values(Fibonacci(0)));
echo "</br>";

echo isPrime(5)."<br>";
echo isPrime(6)."<br>";
echo isPrime(-10)."<br>";

echo reverseString('hello')."<br>";
echo reverseString('g')."<br>";
echo reverseString('Hello WorLd')."<br>";
echo reverseString(3434)."<br>";

echo factorial(5)."<br>";
echo factorial(1)."<br>";
echo factorial(10)."<br>";

?>