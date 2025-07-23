<?php

class RoomReservation {
    public $guest_name;
    public $room_type;
    public $nights;
    public $season;

    public function __construct($guest_name, $room_type, $nights, $season){
        $this->guest_name = $guest_name;
        $this->room_type = $room_type;
        $this->nights = $nights;
        $this->season = $season;

        if($this->room_type == "Standard"){
            $this->fee = 100;
        }elseif ($this->room_type == "Deluxe"){
            $this->fee = 150;
        }elseif ($this->room_type == "Suite"){
            $this->fee = 250;
        }

        if($this->season == "Peak"){
            $this->tax = $this->fee * 0.20;
            $this->totalFee = $this->fee + $this->tax;
        }else{
            $this->totalFee = $this->fee;
        }

        if($this->nights < 1){
            echo "Enter Valid Number of night";
        }
    }

    public function display(){
        echo "Guest Name: ".$this->guest_name."<br>";
        echo "Room Type: ".$this->room_type."<br>";
        echo "Nights: ".$this->nights."<br>";
        echo "Season: ".$this->season."<br>";
        echo "Total: ".$this->totalFee."<br>";
    }
}

class VIPReservation extends RoomReservation{
    public $vip;

    public function __construct($guest_name, $room_type, $nights, $season, $vip){
        parent::__construct($guest_name, $room_type, $nights, $season);
        $this->vip = $vip;


        if($this->vip == "VIP"){
            echo "VIP Rerveration Perks: Free breakfast and airport pickup <br>";
        }else{
            echo "Regular Rerveration Perks: None <br>";
        }

        if($this->nights > 3){
            $this->discount = $this->totalFee * 0.15;
            $this->discountedPrice = $this->totalFee - $this->discount;
        }else{
            $this->discountedPrice = "No Discount";
        }
    }

    public function display(){
         parent::display();
        echo "Type of Reservation: ".$this->vip. "<br>";
        echo "Discounted Price: ".$this->discountedPrice. "<br>";
    }

}

if(isset($_POST['submit'])){
    $rent = new VIPReservation($_POST['guest_name'], $_POST['room_type'], $_POST['nights'], $_POST['season'], $_POST['vip']);
    $rent->display();
    if($rent == $_POST['room_type'] = "Standard"  && $_POST['season'] = "Peak"){
        echo"Upgrade required for VIP during peak";
    }
    // else{
    //     $rent->display();
    // }
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
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="text" name="guest_name" placeholder="Enter Guest Name"><br><br>
    <select name="room_type">
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Suite">Suite</option>
    </select><br><br>
    <input type="number" name="nights" placeholder="Enter How Many Nights"><br><br>
    <select name="season">
        <option value="Peak">Peak</option>
        <option value="Off-Peak">Off-Peak</option>
    </select><br><br>
    <label>Type of Reservation:</label>
    <select name="vip">
        <option value="VIP">VIP Reservation</option>
        <option value="Regular" selected>Regular Reservation</option>
    </select><br><br>
    <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>