<?php

if(isset($_GET["id"])&& !empty(trim($_GET["id"]))){

    require_once 'config.php';

    $sql = "SELECT * FROM  patientlist WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt,"i", $param_id);

        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
//            echo $result;
            if (mysqli_num_rows($result)==1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $name = $row["name"];
                $telephone = $row["telephone"];
                $address = $row["address"];
                $f = $row["f"];
                $location = $row["location"];
                $start_date = $row["start_date"];
                $end_date = $row["end_date"];
            }else{
                header("location: error.php");
                exit();
            }

        }else{
            echo "Oops! Something went wrong.Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);

    mysqli_close($link);
}else{
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="page-header">
                    <h1>View People</h1>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <p class="form-control-static"><?php echo $row["name"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <p class="form-control-static"><?php echo $row["address"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>Telephone</label>
                    <p class="form-control-static"><?php echo $row["telephone"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>F</label>
                    <p class="form-control-static"><?php echo $row["f"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <p class="form-control-static"><?php echo $row["location"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>Start_date</label>
                    <p class="form-control-static"><?php echo $row["start_date"]; ?> </p>
                </div>

                <div class="form-group">
                    <label>End_date</label>
                    <p class="form-control-static"><?php echo $row["end_date"]; ?> </p>
                </div>
                <p><a href="index.php" class="btn btn-primary">back</a></p>

            </div>
        </div>
    </div>
</div>
</body>
</html>