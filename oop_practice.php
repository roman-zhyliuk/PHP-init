<?php

class Vehicle {
    protected $make;
    protected $model;
    protected $year;

    public function __construct($make, $model, $year)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function start() {
        return 0;
    }

    public function stop() {
        return 0;
    }

    public function displayDetails() {
        return 0;
    }
}

class Car extends Vehicle {
    private $bodyStyle;

    public function __construct($make, $model, $year, $bodyStyle)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->bodyStyle = $bodyStyle;
    }

    public function start() {
        return "Car is started";
    }

    public function stop() {
        return "Car is stopped";
    }

    public function displayDetails()
    {
        echo "Car: ".$this->make." ".$this->model." from ".$this->year." and body style is ".$this->bodyStyle."<br>";
    }

    public function setProperties($make, $model, $year, $bodyStyle) {
        if (isset($make)) {
            $this->make = $make;
        }
        if (isset($model)) {
            $this->model = $model;
        }
        if (isset($year)) {
            $this->year = $year;
        }
        if (isset($bodyStyle)) {
            $this->bodyStyle = $bodyStyle;
        }
    }
}

class Motorcycle extends Vehicle {
    private $typeOfMotorcycle;

    public function __construct($make, $model, $year, $typeOfMotorcycle)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->typeOfMotorcycle = $typeOfMotorcycle;
    }

    public function start() {
        return "Motorcycle is started";
    }

    public function stop() {
        return "Motorcycle is stopped";
    }

    public function displayDetails()
    {
        echo "Motorcycle: ".$this->make." ".$this->model." from ".$this->year." and type of motorcycle is ".$this->typeOfMotorcycle."<br>";
    }

    public function setProperties($make, $model, $year, $typeOfMotorcycle) {
        if (isset($make)) {
            $this->make = $make;
        }
        if (isset($model)) {
            $this->model = $model;
        }
        if (isset($year)) {
            $this->year = $year;
        }
        if (isset($typeOfMotorcycle)) {
            $this->typeOfMotorcycle = $typeOfMotorcycle;
        }
    }
}

?>