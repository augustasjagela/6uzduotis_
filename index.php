<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagrindinis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">


        <?php if(isset($_SESSION["zinute"])) { ?>
            <div class="alert <?php echo $_SESSION["zinutes_stilius"]; ?>">
                <p><?php echo $_SESSION["zinute"]; ?></p>
            </div>
            <?php 
            unset($_SESSION["zinute"]); 
            unset($_SESSION["zinutes_stilius"]);
            ?>
        <?php } ?>
        <!-- if jeigu sausainis egzistuoja - forma paslepta, jei ne - forma matoma -->
        <?php 
            if($_SESSION["arPrisijunges"] == 1 || isset($_COOKIE["hideForm"])) {
            echo "Forma paslepta";
        } else { ?>
        
        <form method="post" action="index.php">
            <input class="form-control" name="vardas" type="text" placeholder="Vardas">
            <input class="form-control" type="password" name="slaptazodis" placeholder="Slaptazodis">
            <button class="btn btn-primary" type="submit" name="prisijungti">Prisijungti</button>
        </form> <?php } ?>   
        
    </div>
   

    <?php 
    if(isset($_POST["prisijungti"])) {
        $vardas = $_POST["vardas"];
        $slaptazodis = $_POST["slaptazodis"];

        $gVardas = "admin";
        $gSlaptazodis = "123";


        if($vardas == $gVardas && $slaptazodis == $gSlaptazodis) {
            $_SESSION["arPrisijunges"] = 1;
            $_SESSION["skaitiklis"] = 0;
            $_SESSION["vardas"] = $vardas;
            header("Location: manopaskyra.php");
        }else {
            //zinute turi buti raudona
            //ir kitoks tekstas
            //Sesijos skaitiklis
            // Sesijos skaitiklis $_SESSION["skaitiklis"]++
            //$_SESSION["skaitiklis"] == 3
            //susikurti sausainiukas kuris galiotu 60sec
            $_SESSION["skaitiklis"]++;
            $_SESSION["zinute"] = "Neteisingi prisijungimo duomenys";
            $_SESSION["zinutes_stilius"] = "alert-danger";
            header("Location: index.php");
        } 
        if($_SESSION["skaitiklis"] = 3) {
            setcookie("hideForm", time() + 60);
        }
    }
    
    ?>

</body>
</html>