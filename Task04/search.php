<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 10px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function (){
            let tooltip = $('[data-toggle="tooltip"]').tooltip;

        });
    </script>
</head>

<?php
require_once 'config.php';
$sql = "SELECT * FROM patientlist";
if ($result = mysqli_query($link,$sql)){
    if (mysqli_num_rows($result)>0){

        echo "<tr>";
        echo "<td>";
        echo  " <h3 align='center'>Danh sach nhung nguoi bi covid19</h3>";
        echo"</td>";
        echo"</tr>";

        echo "<table class='table table-bordered tacle-striped'>";
        echo "<thead>";
        echo"<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Address</th>";
        echo "<th>Telephone</th>";
        echo "<th>F</th>";
        echo "<th>Location</th>";
        echo "<th>Date</th>";
        echo "<th>Exit_Date</th>";
        echo "</tr>";
        echo "</thead>";
        echo "</tbody>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "</td><td align='center'>";
            echo $row["id"];
            echo "</td><td>";
            echo $row["name"];
            echo "</td><td>";
            echo $row["address"];
            echo "</td><td>";
            echo $row["telephone"];
            echo "</td><td>";
            echo $row["f"];
            echo "</td><td>";
            echo $row["location"];
            echo "</td><td>";
            echo $row["start_date"];
            echo "</td><td>";
            echo $row["end_date"];
            echo "</td>";
            echo "</tr>";

        }
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Enter your name: <input type="text" name="name"/>
    <input type="submit" value="Search"/>
</form>

<p><a href="index.php" class="btn btn-primary">back</a></p>
</body>
</html>