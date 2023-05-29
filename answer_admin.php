

<?php


require_once('functions.php');





if (isset($_POST["Envoyer"])) {






    $bdd = connect();
    $sql = "SELECT id FROM users  ";
    $sth = $bdd->prepare($sql);
    if (!$sth) {
        die("Error during prepare: " . $bdd->errorInfo()[2]);
    }
    $sth->execute();
    $users = $sth->fetchAll(PDO::FETCH_ASSOC);



    $bdd = connect();
    

    $sql = "INSERT INTO message (`sujet`, `msg`,`email`) VALUES (:sujet, :msg ,:email);";
    


    

    $sth = $bdd->prepare($sql);
    


    $success = $sth->execute([
        'sujet'     => $_POST['sujet'],


        'msg'     => $_POST['msg'],

        'email'     => $_POST['email']
       
    ]);
   
}
?>















<!DOCTYPE html>
<html>
<head>
    <title>Messagerie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f1f1f1;
        }

        h2 {
            margin-top: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Envoyer un message à l'administrateur</h2>
    <form method="post" action="">


    <label for="sujet">Sujet :</label>
        <input type="text" id="sujet" name="sujet" required><br><br>


        <label for="message">Message :</label><br>
        <textarea id="msg" name="msg" required></textarea><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        

        <input type="submit" name="Envoyer" value="create"  >
    </form>
</body>
</html>


