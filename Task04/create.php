<?php

require_once 'config.php';

$name = $telephone = $address  = $f =$location=$start_date=$end_date="";
$name_err = $telephone_err = $address_err = $f_err = $location_err = $start_date_err = $end_date_err ="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["name"]);

    if (empty($input_name)){
        $name_err = "Please enter a name.";
    }elseif (!filter_var(trim($_POST["name"]),FILTER_VALIDATE_REGEXP,
        array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s]+$/")))){
        $name_err = 'Please enter a valid name.';
    }else{
        $name =$input_name;
    }

    $input_telephone = trim($_POST["telephone"]);
    if(empty($input_telephone)){
        $number_err = 'Please enter an telephone.';
    }else{
        $number = $input_telephone;
    }

    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = 'Please enter an address.';
    }else{
        $address = $input_address;
    }

    $input_f = trim($_POST["f"]);
    if(empty($input_f)){
        $f_err = 'Please enter an F.';
    }else{
        $f = $input_f;
    }

    $input_location = trim($_POST["location"]);
    if(empty($input_location)){
        $location_err = 'Please enter an Location.';
    }else{
        $location = $input_location;
    }

    $input_start_date = trim($_POST["start_date"]);
    if(empty($input_start_date)){
        $start_date_err = 'Please enter an Start_date.';
    }else{
        $start_date = $input_start_date;
    }

    $input_end_date = trim($_POST["end_date"]);
    if(empty($input_end_date)){
        $end_date_err = 'Please enter an End_date.';
    }else{
        $end_date = $input_end_date;
    }



    if(empty($name_err)&& empty($number_err)&& empty($address_err)&& empty($f_err)&& empty($location_err)&& empty($start_date_err)&& empty($end_date_err)){
        $sql = "INSERT INTO patientlist (name, address, telephone,f, location,start_date,end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"sssssss",$param_name,$param_address,$param_telephone,$param_f,$param_location,$param_start_date,$param_end_date);

            //Set parameters
            $param_name =$name;
            $param_telephone =$telephone;
            $param_address =$address;
            $param_f =$f;
            $param_location = $location;
            $param_start_date =$start_date;
            $param_end_date = $end_date;




            if(mysqli_stmt_execute($stmt)){
                header("Location: index.php");
                exit();
            }else{
                echo "something went wrong.Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
                    <h2>Create Record</h2>
                </div>
                <p>Please fill this from and submit to add employee record to the database.</p>
                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">

                    <div class="form-group <?php echo (!empty($name_err)) ?'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($number_err)) ?'has-error' : ''; ?>">
                        <label>Number</label>
                        <input name="number" class="form-control" value="">
                        <span class="help-block"><?php echo $number_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($address_err)) ?'has-error':''; ?>">
                        <label>Address</label>
                        <textarea  name="address" class="form-control" ></textarea>
                        <span class="help-block"><?php echo $address_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($f_err)) ?'has-error':''; ?>">
                        <label>F</label>
                        <input type="text" name="f" class="form-control" value="">
                        <span class="help-block"><?php echo $f_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($location_err)) ?'has-error':''; ?>">
                        <label>Location</label>
                        <textarea  name="location" class="form-control" ></textarea>
                        <span class="help-block"><?php echo $location_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($start_date_err)) ?'has-error':''; ?>">
                        <label>Start_date</label>
                        <input type="date" name="start_date" class="form-control" value="">
                        <span class="help-block"><?php echo $start_date_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($end_date_err)) ?'has-error':''; ?>">
                        <label>End_date</label>
                        <input type="date" name="end_date" class="form-control" value="">
                        <span class="help-block"><?php echo $end_date_err;?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>