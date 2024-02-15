<?php

// Class creation
class Car {
    public $brand;
    public $model;
    public $year;

    public function startEngine() {
        return "Engine started!<br>";
    }

    public function stopEngine() {
        return "Engine stopped!<br>";
    }
}

// Example of encapsulation
class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }
}

// Example of inheritance and Polymorphism
// Parent class
class Shape {
    public function calculateArea() {
        return 0;
    }
}

//Child classes
class Circle extends Shape {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }
    
    public function calculateArea()
    {
        return pi() * $this->radius * $this->radius;
    }
}

class Rectangle extends Shape {
    private $width;
    private $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }


    public function calculateArea()
    {
        return $this->width * $this->height;
    }
}


// Creating objects
$myCar = new Car();
$person = new Person("John", 30);
$circle = new Circle(5);
$rectangle = new Rectangle(4, 6,);

$myCar->brand = 'Toyota';
$myCar->model = 'Camry';
$myCar->year = 2020;

echo "My car is a {$myCar->brand} {$myCar->model} from {$myCar->year}.<br>";
echo $myCar->startEngine();

echo "Name: ".$person->getName()."<br>";
echo "Age: ".$person->getAge()."<br>";

$person->setName("Alice");
$person->setAge(25);

echo "Modified name: ".$person->getName()."<br>";
echo "Modified age: ".$person->getAge()."<br>";

echo "Area of circle: ".$circle->calculateArea()."<br>";
echo "Area of rectangle: ".$rectangle->calculateArea()."<br>";

?>