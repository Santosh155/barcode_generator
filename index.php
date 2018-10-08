
<!-- upload csv file started -->

<?php
    $connect = mysqli_connect("localhost", "root", "root", "new") or die();
    $message = '';

     $query = "SELECT * FROM  daily_product";
    $result = mysqli_query($connect, $query);

    if(isset($_POST["upload"])){
        if($_FILES['product_file']['name']){
            $filename = explode(".", $_FILES['product_file']['name']);
            if(end($filename) == "csv"){
                $handle = fopen($_FILES['product_file']['tmp_name'], "r");
                while($data = fgetcsv($handle)){
                    $query = "INSERT INTO `daily_product`(`product_id`, `product_category`, `product_name`, `product_price`)
                    VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')";
                    mysqli_query($connect, $query);

                }
                fclose($handle);
                header('location:index.php?updation=1');
            }
            else{
                $message = '<label class="text-danger">please select csv file only </label>';

            }
        }
        else{
            $message = '<label class="text-danger">please select file</label> ';
        }
    }
if(isset($_GET["updation"])){
    $message = '<label class = "text-success">updation success</label>';
}

?>
<!-- upload csv file ended -->

<!-- generate barcode started -->
<?php
// $connect = mysqli_connect("localhost", "root", "root", "new");

// require "vendor/autoload.php";

// $bar = new Picqer\Barcode\BarcodeGeneratorHTML();
// $code = $bar -> getBarcode($_GET[$row['output']], $bar::TYPE_CODE_128);
?>
<!-- generate barcode ended -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <style>
        body, html{
            height:100%;
        }
        .bg{
            /* background-image:url('max.jpg'); */
            height:100%;
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
        }
        #qrbox> div{
            margin:auto;
        }
    </style>
</head>
<body class="bg">
    <div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background: white; box-shadow:10px 10px 8px #888">
                <div class="panel-heading">
                    <h1>Genetate Bar code in pHp</h1>
                </div>
        <hr>
        <form action="generate.php" method="post">
            <input type="text" style="border-radius:8px" name="text" class="form-control" placeholder="text..." value="">
            <br>
            <button type="submit" class="btn btn-block btn-md btn-outline-success">Generate</button>
        </form>
        </div>
    </div>

    <div class="container">
        <h2 class="center">
            update csv file
        </h2>
        <br />
        <br/>
        <form method="POST"action="" enctype="multipart/form-data">
        <p>inpute csv file
        <input type="file" name="product_file" /><br>
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
        </p>
        </form>
        <br>
        <?php echo $message; ?>
      
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Category</th>
                <th>product name</th>
                <th>product price</th>
            </tr>
            <?php
                while($row=mysqli_fetch_array($result))
                {
                    echo '
                        <tr>
                            <td>'.$row["product_category"].'</td>
                            <td>'.$row["product_name"].'</td>
                            <td>'.$row["product_price"].'</td>
                        </tr>';
                }
            ?>
        </table>
        <table>
            <tr>
                <th>Author's id, name, country, home city</th>
            </tr>
            <?php
                $hostname="localhost";
                $username="root";
                $password="root";
                $db = "new";
                $dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password);
                foreach($dbh->query('SELECT product_id as output  FROM  daily_product') as $row)
                {
                    // echo "<tr>";
                    // echo "<td>" . $row['output'] . "</td>";
                    // echo "</tr>";
                    require "vendor/autoload.php";
                    $bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                    $code = $bar -> getBarcode($row['output'], $bar::TYPE_CODE_128);
                    echo $code;
                    echo "<br>";
                    echo "<br>";echo "<br>";
                }
            ?>
        </table>
        </div>
    </div>
</body>
</html>