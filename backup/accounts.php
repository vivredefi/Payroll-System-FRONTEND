<?php
require_once "config.php";
//require_once "session_checker.php";
$sql = "SELECT * FROM tblaccounts";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="general.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary text-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card m-5">
        <div class="search p-3">
            <div class="d-flex justify-content-start align-items-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm rounded-pill me-5" data-bs-toggle="modal"
                    data-bs-target="#addModal">Add Account
                </button>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-100">
                    <div class="input-group">
                        <input type="text" name="txtsearch" placeholder="Search" class="form-control rounded-pill">
                        <button type="submit" name="btnsearch" class="btn btn-primary rounded-pill ms-1">Search</button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
</body>

</html>