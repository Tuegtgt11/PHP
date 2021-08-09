<?php

if (isset($_POST['submit'])){
    $newFileName =$_POST['filename'];
    if (empty($newFileName)){
        $newFileName = "gallery";
    }else{
        $newFileName = strtolower(str_replace("","-",$newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];

    $file = $_FILES['file'];
    $fileName =$file['name'];
    $fileType =$file['type'];
    $fileTempName =$file['tmp_name'];
    $fileError =$file['error'];
    $fileSize =$file['size'];

    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg","jpeg","png");

    if (in_array($fileActualExt,$allowed)){
        if ($fileError === 0){
            if ($fileSize < 7000000){
                $imageFullName = $newFileName.".".uniqid("",true).".".$fileActualExt;
                $fileDestination = "../images/demo/".$imageFullName;
                echo $fileDestination;

                include_once "dbh.inc.php";

                if (empty($imageTitle) || empty($imageDesc)){
                    header("Location: ../index.php?upload=empty");
                    exit();
                }else{
                    $sql =  "SELECT * FROM demo";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL statement failed! ";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder =$rowCount+1;

                        $sql = "INSERT INTO demo (titleDemo,descDemo,imgFullNameDemo,orderDemo)VALUE (?,?,?,?);";
                        if (!mysqli_stmt_prepare($stmt,$sql)){
                            echo "SQL statement failed! ";
                        }else{
                            mysqli_stmt_bind_param($stmt,"ssss",$imageTitle,$imageDesc,$imageFullName,$setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName,$fileDestination);
                            echo $sql;
                            header("Location: ../index.php?upload=success");

                        }
                    }
                }
            }
        }
    }

}

?>
