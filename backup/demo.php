<?php
require_once "config.php";
//require_once "session_checker.php";
$sql = "SELECT * FROM tblaccounts";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="demo.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>

<body>
    <div class="main-container d-flex">
        <div class="sidebar bg-success" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <span class="text-white fs-4">Payroll</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home"></i>
                        Dashboard</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                        Projects</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-comment"></i> Messages</span>
                        <span class="bg-dark rounded-pill text-white py-0 px-2">02</span>
                    </a>
                </li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-envelope-open-text"></i> Services</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
                        Customers</a></li>
            </ul>
            <hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bars"></i>
                        Settings</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bell"></i>
                        Notifications</a></li>
            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span
                                class="bg-dark rounded px-2 py-0 text-white">Payroll</span></a>

                    </div>

                    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                </div>
            </nav>
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card m-5">
                <div class="search p-3">
                    <div class="d-flex justify-content-start align-items-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm rounded-pill me-5" data-bs-toggle="modal"
                            data-bs-target="#addModal">Add Account
                        </button>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                            class="w-100">
                            <div class="input-group">
                                <input type="text" name="txtsearch" placeholder="Search"
                                    class="form-control rounded-pill">
                                <button type="submit" name="btnsearch"
                                    class="btn btn-primary rounded-pill ms-1">Search</button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive m-5">
                    <table class="table table-bordered text-center">
                        <tr class="bg-primary text-white">
                            <th>Username</th>
                            <th>Password</th>
                            <th>User Type</th>
                            <th>User Status</th>
                            <th>Daily Rate</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['userpass'] . "</td>";
                            echo "<td>" . $row['usertype'] . "</td>";
                            echo "<td>" . $row['userstatus'] . "</td>";
                            echo "<td>" . $row['createdby'] . "</td>";
                            echo "<td>";
                            echo "<a href ='update-account.php?username=" . $row['username'] . "'>Update</a>";
                            echo "<a href ='delete-account.php?username=" . $row['username'] . "'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".sidebar ul li").on("click", function () {
            $(".sidebar ul li.active").removeClass("active");
            $(this).addClass("active");
        });

        $(".open-btn").on("click", function () {
            $(".sidebar").addClass("active");
        });

        $(".close-btn").on("click", function () {
            $(".sidebar").removeClass("active");
        });

    </script>
</body>

</html>