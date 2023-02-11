<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                margin:20px 50px;
                background-color:#A9A9A9;
                color:aliceblue;          
            }
            form ,h3{
              width: auto;
              background-color: #2F4F4F;
              padding: 20px;
              margin:0px;
            } 
            nav{
              width: auto;
              background-color: #D3D3D3;
              padding: 20px;
              margin:0px;  
            }   
            #cuadro {
              margin:20px 20px;
              border: black 3px solid;
              border-radius: 1em;;
              padding: 5px;
              background-color:#696969 ;
              font-size: 20px;;               
            }                 
                             
            img {
              float: left;
              margin:20px;
              height:200px;
              width: 200px;
              
            }
            h1{
              font-family: 'Times New Roman', Times, serif;
              font-size: 30px;
              color:aliceblue;
              background-color:#696969 ; 
              padding: 30px; 
              margin: 0px;   
            }
            h2 {
                margin: 5px 220px ;
            }
            #texto{
                margin: 0 220px
                
            }
            #error{
                margin:20px 50px;
                font-size: 30px;
                color:#FAFAD2;
            }

        </style>
    </head>
    <body>
        <h1>Buscadores</h1>
        <nav>
            <ul>
                <li><a href="personajes.php">Buscador de personajes Rick and Morty</a></li>
            </ul>
        </nav>
        <h3 >Buscar personajes:</h3> 
                  
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
            <label for="id">Introduzca el id del personaje (1 - 826): </label>
            <input id="id" name="id" type="text">
            <input type="submit" value="Buscar">
        </form>
        <div class="persons">
        <?php
        $url = "";
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            if ($id > 0 && $id < 827){
                $url = "https://rickandmortyapi.com/api/character/" . $id;
                $infoPersonaje = file_get_contents($url);
                $infoPersonaje = json_decode($infoPersonaje, true);

                $imagen = $infoPersonaje["image"];
                echo "<div id = 'cuadro'>";
                echo "<img src = '" . $imagen . "' /> <br>";                               
                echo "<h2>" . $infoPersonaje["name"] . "</h2>"."<br>";
                echo "<p id = 'texto'>";
                echo "<b>"."ID: "."</b>" . $infoPersonaje["id"] . "<br>";
                echo "<b>"."Status: "."</b>" . $infoPersonaje["status"] . "<br>";
                echo "<b>"."Género: "."</b>" . $infoPersonaje["gender"] . "<br>";

                $origins = $infoPersonaje["origin"];
                if(count($origins)) {
                    echo "<b>"."Visto por primera vez: " ."</b>". "<br/>";
                    $url = "https://rickandmortyapi.com/api/location/" .$id;
                    $infoTipo = file_get_contents($url);
                    $infoTipo = json_decode($infoTipo, true);                      
                }
                echo $infoTipo["name"];
                echo "<br>";

                $locations = $infoPersonaje["location"];
                if(count($locations)) {
                    echo "<b>"."Última localización conocida: "."</b>" . "<br/>";                
                    $id1 = 2;
                    $id2 = $id + $id1;
                    $url = "https://rickandmortyapi.com/api/location/" .$id2;
                    $infoTipo = file_get_contents($url);
                    $infoTipo = json_decode($infoTipo, true);                      
                }
                echo $infoTipo["name"];
                echo "<br>";
                echo "</p>";
                echo "</div>";
            } else {
                echo "<p id='error'>"."No hay ningun personaje con ese ID"."</p>";
            }            
        }         
    ?>
        </div>
    </body>
</html>