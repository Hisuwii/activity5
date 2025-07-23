<?php

class CarRental{
    public $renter;
    public $zip;
    public $carSize;
    public $dailyRental;
    public $duration;
    public $totalFee;

    public function __construct($renter, $zip, $carSize, $duration){
        $this->renter = $renter;
        $this->zip = $zip;
        $this->carSize = $carSize;
        $this->duration = $duration;

        if ($this->carSize == "economy"){
            $this->dailyRental = 29.99;
        }else if($this->carSize == "midsize"){
            $this->dailyRental = 38.99;
        }else if($this->carSize == "fullsize"){
            $this->dailyRental = 43.50;
        }
    }

    public function display(){
        echo $this->renter;
        echo $this->zip;
        echo $this->carSize;
        echo $this->duration;
        echo $this->totalFee = $this->carSize * $this->duration;
    }

}

class LuxuryCarRental extends CarRental{
    public $chauffeur;

    public function __construct($renter, $zip, $carSize, $duration, $chauffeur){
        $this->renter = $renter;
        $this->zip = $zip;
        $this->carSize = $carSize;
        $this->duration = $duration;
        $this->chauffeur = $chauffeur;

        if ($this->carSize == "economy"){
            $this->dailyRental = 29.99;
        }else if($this->carSize == "midsize"){
            $this->dailyRental = 38.99;
        }else if($this->carSize == "fullsize"){
            $this->dailyRental = 43.50;
        }else if($this->carSize == "luxury"){
            $this->dailyRental = 79.99;
        }

        if($this->chauffeur == "yes"){
            $this->chauffeur = 200;
        }else{
            $this->chauffeur = 0;
        }
    }

    public function display(){
        echo $this->renter."<br>";
        echo $this->zip."<br>";
        echo $this->carSize."<br>";
        echo $this->duration."<br>";
        echo $this->totalFee = ($this->dailyRental * $this->duration) + $this->chauffeur."<br>";
        echo $this->chauffeur;
    }
}


if(isset($_POST['submit'])){
    $rent = new LuxuryCarRental($_POST['renter'], $_POST['zip'], $_POST['carSize'], $_POST['duration'],$_POST['chauffeur']);
    $rent->display();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']?>">

    <input type="text" name="renter" placeholder="Enter Renter Name"></input><br><br>
    <input type="number" name="zip" placeholder="Enter Zip Code"></input><br><br>
    <select name="carSize">
        <option>Select Option</option>
        <option value="economy">Economy</option>
        <option value="midsize">Mid Size</option>
        <option value="fullsize">Full Size</option>
        <option value="luxury">Luxury</option>
    </select><br><br>
    <input type="number" name="duration" placeholder="Enter Duration Day"></input><br><br>
    <select name="chauffeur">
        <option>Select Option</option>
        <option value="yes">Include</option>
        <option value="no">Don't Include</option>
    </select><br><br>
    <button type="submit" name="submit">Submit </button>
    </form>
</body>
</html>