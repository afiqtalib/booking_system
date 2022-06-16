<?php
    ob_start();
    session_start();

    //Page Title
    $pageTitle = 'Profile | Barber';

    //Includes
    include 'connect.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';

    //Extra JS FILES
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

    //Check If user is already logged in
    if(isset($_SESSION['username_barber']) && isset($_SESSION['password_barber']))
    {
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
    
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>
            <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Barber</h6>
                    </div>
                    <div class="card-body">

                        <!-- Barber TABLE -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $barber_un = $_SESSION['username_barber'];
                                    $sql = "SELECT * FROM barbers WHERE barber_un='$barber_un'";
                                    $result = mysqli_query($conn, $sql);
                                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        foreach($rows as $barber)
                                        {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $barber['barber_id'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $barber['barber_name'];
                                                echo "</td>";
                                                echo "<td style = 'width:20%'>";
                                                    echo $barber['barber_phonenum'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $barber['barber_email'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $barber['barber_un'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $barber['barber_password'];
                                                echo "</td>";
                                                echo "<td>";?>
                                                <ul class="list-inline m-0">

                                                    <!-- EDIT BUTTON -->
                                                    <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                                        <button class="btn btn-success btn-sm rounded-0">
                                                            <a href="profile-update.php?barber_id=<?php echo $barber['barber_id']; ?>" style="color: white;">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </button>
                                                    </li>
                                                </ul>
                                                <?php echo "</td>";
                                            echo "</tr>"; }?>   
                            </tbody>
                        </table>
                    </div>
                </div>
                
        </div>
  
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