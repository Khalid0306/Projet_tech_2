
<?php

    session_start();

    function dd($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        
        die();
    }

    function connect () {
        $link = new PDO(
            
            'mysql:dbname=projet_tech_musee;host=localhost', 
            'root', 
            ''
        );

        return $link;
    }
