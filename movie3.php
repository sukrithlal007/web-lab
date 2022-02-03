<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = mysqli_connect('localhost', 'root', '', 'mydb5');


$create_table_qry = 'CREATE TABLE IF NOT EXISTS `movie3` (
    `ticket_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `movie_name` varchar(20) NOT NULL,
    `seat_no` varchar(10) NOT NULL,
    `no_of_seats` int(15) NOT NULL,
    `date_of_booking` date NOT NULL,
    `booking_time` time NOT NULL
  )';

$create_table = mysqli_query($db, $create_table_qry);

$err_msg = $succ_msg = '';



if (isset($_POST['book_ticket'])) {
    $movie_name = $_POST['movie_name'];
    $seat_no = $_POST['seat_no'];
    $no_of_seats = $_POST['no_of_seats'];
    $date_of_booking = $_POST['date_of_booking'];
    $booking_time = $_POST['booking_time'];

    $err_msg .= (empty($movie_name)) ? '<p>Please enter  movie name</p>' : '';
    $err_msg .= (empty($seat_no)) ? '<p>Please enter  seat no</p>' : '';
    $err_msg .= (empty($no_of_seats)) ? '<p>Please enter no of seat</p>' : '';
    $err_msg .= (empty($date_of_booking)) ? '<p>Please enter date of booking</p>' : '';
    $err_msg .= (empty($booking_time)) ? '<p>Please enter  booking time</p>' : '';

    if (strlen($err_msg) == 0) {
        $insert_ticket = "INSERT INTO movie3 (movie_name,seat_no,no_of_seats ,date_of_booking,booking_time) VALUES ('$movie_name','$seat_no',$no_of_seats,'$date_of_booking','$booking_time')";
        $insert_result = mysqli_query($db, $insert_ticket);

        if ($insert_result)
            $succ_msg = "<p>Successfully booked movie ticket</p>";
        else
            $err_msg = "<p>Could not book ticket</p>";
    }
}



$tickets_qry = 'SELECT * from movie3';
$tickets_records = mysqli_query($db, $tickets_qry);



?>

<title>movie ticket booking</title>

<body>

<center><h3><B>MOVIE TICKET BOOKING</B></h3></center>

    <div class="container">

        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>movie Name</th>
                        <th>seat No</th>
                        <th>no of seat</th>
                        <th>show time</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($tickets = mysqli_fetch_array($tickets_records)) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $tickets['movie_name'] ?></td>
                            <td><?= $tickets['seat_no'] ?></td>
                            <td><?= $tickets['no_of_seats'] ?></td>
                            <td><?= $tickets['booking_time'] ?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <div>


        <?php if (strlen($err_msg > 0)) : ?>


<div class="alert alert-error">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?= $err_msg ?>
</div>


<?php endif; ?>

<?php if (strlen($succ_msg > 0)) : ?>


<div class="alert alert-success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?= $succ_msg ?>
</div>



<?php endif; ?>

            


            <form method="post">
                <label for="fname">movie Name</label>
                <input type="text" id="movie_name" name="movie_name" placeholder="movie name.." required>

                <label for="lname">seat No</label>
                <input type="text" id="seat_no" name="seat_no" placeholder="seat no" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">


                <label for="lname">no of seat</label>
                <input type="text" id="no_of_seats" name="no_of_seats" placeholder="no of seat.." required>


                <label for="lname">Date of booking</label>
                <input type="date" id="date_of_booking" name="date_of_booking" placeholder="Date of booking" required>


                <label for="lname">show time</label>
                <input type="time" id="booking_time" name="booking_time" placeholder="show Time  .." required>



                <input type="submit" name="book_ticket" value="Book ticket">
                
            </form>
        </div>



    </div>
</body>
<style>

table {
  font-family:  sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 2px solid #ddd;
  padding: 6px;
}


table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
input[type=submit] {
        width: 20%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 15px;
        
    }


</style>
