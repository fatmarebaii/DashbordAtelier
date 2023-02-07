<?php
$con = mysqli_connect("127.0.0.1", "root", "", "db_isa");
if ($con) {
    // echo "DB connected";
} else {
    echo "DB connection is failed";
    exit();
}
