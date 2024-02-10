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

echo findMax([3, 5, 1, 0, 4, 3, 5, 6, 1])."<br>";
echo findMax([0, 0, 0, 0, 0, 0, 0, 0])."<br>";
echo findMax([1, 1, 1, 1, 1, 1, 0])."<br>";
echo findMax([10, 9, 8, 7, 6, 5, 4, 3, 2, 1])."<br>";
echo findMax([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])."<br>";
?>