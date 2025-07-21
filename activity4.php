<?php
class CarRental{
    public $renter;
    public $zip;
    public $sizeCar;
    public $dailyRental;
    public $duration;
    public $totalFee;

    public function __construct($renter, $zip, $sizeCar, $duration){
        $this->renter = $renter;
        $this->zip = $zip;
        $this->sizeCar = $sizeCar;
        $this->duration = $duration;
        

        if($this->sizeCar == "economy"){
            $this->dailyRental = 29.99;
        }elseif($this->sizeCar == "midsize"){
            $this->dailyRental = 38.99;
        }elseif($this->sizeCar == "fullsize"){
            $this->dailyRental = 43.50;
        }
    }

    public function calculate(){
        $this->totalFee = $this->dailyRental * $this->duration;
        echo "Total Fee is $".$this->totalFee;
    }

    function get_info(){
        echo "Renter Name is: ". $this->renter."<br>";
        echo "Renter Car Size is: ". $this->sizeCar."<br>";
        echo "Renter Zip Code is: ". $this->zip."<br>";
        echo "Renter Daily Rental is: $". $this->dailyRental."<br>";
        echo "Renter Duration Days: ". $this->duration."<br>";
    }
}

class LuxuryCarRental extends CarRental{
    public $chauffeur;

    public function __construct($renter, $zip, $sizeCar, $duration, $chauffeur){
        parent::__construct($renter, $zip, $sizeCar, $duration);
        $this->chauffeur = $chauffeur;

         if($this->sizeCar == "economy"){
            $this->dailyRental = 29.99;
        }elseif($this->sizeCar == "midsize"){
            $this->dailyRental = 38.99;
        }elseif($this->sizeCar == "fullsize"){
            $this->dailyRental = 43.50;
        }elseif($this->sizeCar == "luxury"){
            $this->dailyRental = 79.99;
        }

        if($this->chauffeur == "yes"){
            $this->chauffeur = 200;
        }else{
            $this->chauffeur = 0;
        }
    }

      public function calculate(){
        $this->totalFee = $this->dailyRental * $this->duration + $this->chauffeur;
        echo "Total Fee is $".$this->totalFee;
    }

    function get_info(){
        echo "Renter Name is: ". $this->renter."<br>";
        echo "Renter Car Size is: ". $this->sizeCar."<br>";
        echo "Renter Zip Code is: ". $this->zip."<br>";
        echo "Renter Daily Rental is: $". $this->dailyRental."<br>";
        echo "Renter Duration Days: ". $this->duration."<br>";
        echo "Included Chauffeur? ". $this->chauffeur."<br>";
    }

}

if(isset($_POST['submit'])){
    $rent = new LuxuryCarRental($_POST['renter'], $_POST['zip'], $_POST['sizeCar'], $_POST['days'], $_POST['chauffeur']);
    $rent->get_info();
    $rent->calculate();

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

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label>Renter Name:</label>
    <input type="text" name="renter" placeholder="Enter Renter Name"><br><br>
    <label>Zip Code</label>
    <input type="number" name="zip" placeholder="Enter Zip Code"><br><br>
    <label>Size of the Car:</label>
    <select name="sizeCar">
        <option value="economy">Economy</option>
        <option value="midsize">Mid Size</option>
        <option value="fullsize">Full Size</option>
        <option value="luxury">Luxury Car</option>
    </select><br><br>
    <label>Rent Duration</label>
    <input type="number" name="days" placeholder="Enter Days to Rent"><br><br>
    <label>Include Chaufeur?</label>
    <select name="chauffeur">
        <option>Select Option</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select><br><br>
    <button type="submit" name="submit">Submit</submit>
</form>
</body>
</html>