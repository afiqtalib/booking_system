<?php
    ob_start();
    session_start();

    //Page Title
    $pageTitle = 'Update Slot | Twin & Dad Barbershop';

    //Includes
    include 'connect.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';

    //Extra JS FILES
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

    //Check If user is already logged in
    if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
    {
?>

<?php 

    // $errorMessage = "error inserted";
    // $successMessage = "successfully inseertt data";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_new_slot'])) {
        $timeslot = $_POST["time_slot"];
        $slotstatus = $_POST["slot_status"];
        $barber = $_POST["slot_barber"];

        
        // QUERY FOR ADD NEW SERVICE TO DATABASE
        $query=mysqli_query($conn, "INSERT INTO slots (time_slot, slot_status, barber_id) VALUE ('$timeslot', '$slotstatus', '$barber')");
        if ($query){
            echo "<script>alert('You have successfully inserted the new slot time');</script>";
            echo "<script type='text/javascript'> document.location ='slot.php'; </script>";
        }
        else
        {
          echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
?>
<?php
    // $service_name = "";
    // $service_duration = "";
    // $service_price = "";
    // $service_desc ="";

if (isset($_POST['edit_slot'])) {

    $slot_id = $_GET["slot_id"];
    //Getting Post Values
    $timeslot = $_POST["time_slot"];
    $slotstatus = $_POST["slot_status"];
    $barber = $_POST["slot_barber"];

    $query=mysqli_query($conn, "UPDATE slots SET time_slot='$timeslot', slot_status='$slotstatus' barber_id='$barber' WHERE slot_id='$slot_id'"); {
        if ($query){
            echo "<script>alert('You have successfully updated the data');</script>";
            echo "<script type='text/javascript'> document.location ='slots.php'; </script>";
        }
        else
        {
          echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slot</title>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">
    
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Timeslots</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Generate Report
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Slot</h6>
            </div>
            <div class="card-body">
                
                <!-- FORM ADD NEW SERVICE -->
                <form method="POST">
                <?php
                        $slot_id = $_GET["slot_id"];
                        $ret=mysqli_query($conn,"SELECT * FROM slots WHERE slot_id='$slot_id'");
                        while ($row=mysqli_fetch_array($ret)) {
                    ?>
                   <input type="hidden" value="<?php echo $slot_id?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barber_name">Time Slot</label>
                                <input type="time" class="form-control"  placeholder="" value="<?php echo $row['time_slot']; ?>" name="time_slot" min="12:00" max="9:00" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barber_un">Slot Status</label>
                                <select class="custom-select" name="slot_status" value="<?php echo $row['slot_status']; ?>">
                                    <option value="available">Available</option>
                                    <option value="unavailable">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barber_name">Barber</label>
                                <select class="custom-select" name="slot_barber">
                                    <option value="">--</option>
                                    <?php 
                                        $sql = "SELECT * FROM barbers";
                                        $result = $conn->query($sql);                            
                                        if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) 
                                        {
                                            ?>
                                            <option value="<?php echo $row['barber_id'] ?>"><?php echo $row['barber_name'] ?></option>
                                            <?php
                                        }
                                        } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?> 
                    <!-- SUBMIT BUTTON -->

                    <button type="submit" name="add_new_slot" class="btn btn-primary">Add Slot</button>

                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
        
        //Include Footer
        include 'Includes/templates/footer.php';
    }
    else
    {
        header('Location: login.php');
        exit();
    }

?>