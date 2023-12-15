<html>
 <head>
     <title>Login MySQL</title>
     <style>
         body{
         }
         table,td {
             border: 1px solid black;
             border-spacing: 0px;
         }
     </style>
 </head>
 
 <body>
     <?php
    if (isset($_POST['nom']) && isset($_POST['contrasenya'])) {
        #try {
            $hostname = "localhost";
            $dbname = "world";
            $username = "root";
            $pw = "Kecuwa53";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        #} catch (PDDException $e) {
            #echo "Failed";
            #exit;
        #}
        $usuari = $_POST['nom'];
        $contrasenya = $_POST['contrasenya'];

        $querystr = "SELECT * FROM users WHERE nom='$usuari' AND contrasenya=SHA2('$contrasenya',512);";
        $consulta = $pdo->prepare($querystr);

        echo "<br>$qstr<br>";

        $consulta->execute();

        if( $consulta->errorInfo()[1] ) {
            echo "<p>ERROR: ".$consulta->errorInfo()[2]."</p>\n";
            die;
        }

        if( $consulta->rowCount() >= 1 )
            # hi ha 1 resultat o més d'usuaris amb nom i password
            foreach( $consulta as $user ) {
                echo "<div class='user'>Hola ".$user["nom"]."</div>";
            }
        else
            echo "<div class='user'>No hi ha cap usuari amb aquest nom o contrasenya.</div>";
    }
    ?>
    <h1>Login MySQL</h1>
    <form method="post">
        User: <input type="text" name="nom" required><br>
        Pass: <input type="password" name="contrasenya" ><br>
        <input type="submit" value="cerca">
    </form>
 </body>
</html>