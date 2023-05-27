



<?php

 require_once('functions.php');



$bdd = connect();
$sql = "SELECT * FROM produit"
;
$sth = $bdd->prepare($sql);
if (!$sth) {
    die("Error during prepare: " . $bdd->errorInfo()[2]);
}
$sth->execute();
$prod = $sth->fetchAll(PDO::FETCH_ASSOC);


?>




<?php require_once('_header.php'); ?>
<div class="container1">
    
    <div class="container">
    <h1>Notifications</h1>

    <?php foreach ($prod as $produit): ?>
        <div class="notification">
            <p class="email">Email: <?php echo $produit['picture']; ?></p>
            
           
        </div>
        <hr>
    <?php endforeach; ?>
</div>


</body>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .notification {
            margin-bottom: 20px;
            padding: 10px;
            background-color:beige;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .notification p {
            margin: 0;
        }

        .notification p.email {
            font-weight: bold;
        }

        .notification form {
            margin-top: 10px;
        }

        .notification input[type="submit"] {
            padding: 5px 10px;
            border-radius: 3px;
            border: none;
            color: #fff;
            background-color: #4CAF50;
            cursor: pointer;
        }

        .notification input[type="submit"]:hover {
            background-color: #45a049;
        }

        .notification hr {
            margin-top: 20px;
        }
    </style>
</head>

    

</html>