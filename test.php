<?php
class CarRental {
    public $renter;
    public $zip;
    public $sizeCar;
    public $dailyRental;
    public $duration;
    public $totalFee;

    public function __construct($renter, $zip, $sizeCar, $duration) {
        $this->renter = $renter;
        $this->zip = $zip;
        $this->sizeCar = $sizeCar;
        $this->duration = $duration;

        if ($this->sizeCar == "economy") {
            $this->dailyRental = 29.99;
        } elseif ($this->sizeCar == "midsize") {
            $this->dailyRental = 38.99;
        } elseif ($this->sizeCar == "fullsize") {
            $this->dailyRental = 43.50;
        } else {
            $this->dailyRental = 0;
        }

        $this->totalFee = $this->dailyRental * $this->duration;
    }

    function get_info() {
        echo "Renter Name: {$this->renter}<br>";
        echo "Zip Code: {$this->zip}<br>";
        echo "Car Size: {$this->sizeCar}<br>";
        echo "Daily Rental: \${$this->dailyRental}<br>";
        echo "Days: {$this->duration}<br>";
        echo "Total Rental Fee: \$" . number_format($this->totalFee, 2) . "<br>";
    }
}

class LuxuryCarRental extends CarRental {
    public $chauffeurFee = 0;

    public function __construct($renter, $zip, $duration, $chauffeur) {
        parent::__construct($renter, $zip, 'luxury', $duration);
        $this->dailyRental = 79.99;

        if ($chauffeur == "yes") {
            $this->chauffeurFee = 200 * $this->duration;
        }

        $this->totalFee = ($this->dailyRental * $this->duration) + $this->chauffeurFee;
    }

    function get_info() {
        echo "Renter Name: {$this->renter}<br>";
        echo "Zip Code: {$this->zip}<br>";
        echo "Car Size: Luxury<br>";
        echo "Daily Rental: \${$this->dailyRental}<br>";
        echo "Days: {$this->duration}<br>";
        echo "Chauffeur Fee: \$" . number_format($this->chauffeurFee, 2) . "<br>";
        echo "Total Rental Fee: \$" . number_format($this->totalFee, 2) . "<br>";
    }
}

if (isset($_POST['submit'])) {
    $renter = $_POST['renter'];
    $zip = $_POST['zip'];
    $duration = $_POST['days'];
    $sizeCar = $_POST['sizeCar'];
    $chauffeur = $_POST['chauffeur'];

    if ($sizeCar == "luxury") {
        $rent = new LuxuryCarRental($renter, $zip, $duration, $chauffeur);
    } else {
        $rent = new CarRental($renter, $zip, $sizeCar, $duration);
    }

    $rent->get_info();
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

<form method="POST" action="">
    <input type="text" name="renter" placeholder="Enter Renter Name"><br><br>
    <input type="number" name="zip" placeholder="Enter Zip Code"><br><br>
    <input type="number" name="days" placeholder="Enter Days to Rent"><br><br>

    <label>Size of the Car:</label>
    <select name="sizeCar">
        <option value="economy">Economy</option>
        <option value="midsize">Mid Size</option>
        <option value="fullsize">Full Size</option>
        <option value="luxury">Luxury</option>
    </select><br><br>

    <label>Include Chauffeur (only for luxury)?</label>
    <select name="chauffeur">
        <option value="no">No</option>
        <option value="yes">Yes</option>
    </select><br><br>

    <button type="submit" name="submit">Submit</button>
</form>

</body>
</html>