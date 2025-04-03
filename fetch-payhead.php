<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["payhead_id"])) {
    $payhead_id = mysqli_real_escape_string($link, $_POST["payhead_id"]);

    $query = "SELECT payhead_desc, payhead_type FROM tblpayheads WHERE payhead_id = '$payhead_id'";
    $result = mysqli_query($link, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            "success" => true,
            "description" => $row["payhead_desc"],
            "type" => $row["payhead_type"]
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>