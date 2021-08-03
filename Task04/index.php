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
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">People covid19</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add New People</a>
                    <a href="search.php" class="btn btn-success pull-right"style="margin-right: 50px">Search People</a>
                </div>
                <?php
                require_once 'config.php';
                $sql = "SELECT * FROM patientlist";
                if ($result = mysqli_query($link,$sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table table-bordered tacle-striped'>";
                        echo "<thead>";
                        echo "<tr>";
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

                            echo"<a href= 'read.php?id=".$row['id']
                                ."'title='View Record' data-toggle='tooltip'> 
                                    <span class='glyphicon glyphicon-eye-open'></span></a>";

                            echo "<a href='update.php?id=" . $row['id']
                                . "'title='Update Record' data-toggle='tooltip'> 
                                    <span class='glyphicon glyphicon-pencil'></span></a>";

                            echo "<a href='delete.php?id=" . $row['id']
                                . "'title='Delete Record' data-toggle='tooltip'>
                                        <span class='glyphicon glyphicon-trash'></span></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($result);
                    } else {
                        echo "<p class='lead'><em> No records were found.</em></p>";
                    }
                    mysqli_close($link);
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>