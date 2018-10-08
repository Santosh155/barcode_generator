<?php
$connect = mysqli_connect("localhost", "root", "root", "new");

require "vendor/autoload.php";

// if(!$_POST['text']){
//     header('location:index.php');
//     die();
// // }
// $bar = new Picqer\Barcode\BarcodeGeneratorHTML();
// $code = $bar -> getBarcode($_POST['text'], $bar::TYPE_CODE_128);
// echo $code;
?>


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
        <div id="qrbox">

            <?php echo $code ?>

        </div>
        <hr>
        <a href="index.php">generate again</a>
        </div>
    </div>

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
                foreach($dbh->query('SELECT CONCAT_WS(",",product_id,product_name,product_price,product_name) as output
                FROM  daily_product') as $row)
                {
                    echo "<tr>";
                    echo "<td>" . $row['output'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>

</body>
</html>