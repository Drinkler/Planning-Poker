<?php
session_start();

// TODO: Überprüfen ob User angemeldet ist, falls nicht -> Location index.php

$cardSets = [
    // 1, 3, 5, 8
    ['1', '2', '3', '5', '8'],
    // Standard fibonaci like series of values
    ['1', '2', '3', '5', '8', '13', '20', '40', '100'],
    // Special card set with '?' for unclear stories
    ['1', '2', '3', '5', '8', '13', '20', '40', '?'],
    // Powers of two used by other teams
    ['0' ,'1', '2', '4', '8', '16', '32', '64'],
    // Card set used to estimate hours as different fractions and multiples of a working day
    ['1', '2', '4', '8', '12', '16', '24', '32', '40'],
    // Demonstration of the coffee cup card
    ['&#9749;', '1', '2', '3', '5', '8', '13', '20', '?'],
    // T-shirt Size
    ['XXS','XS', 'S', 'M', 'L', 'XL', 'XXL', '?'],
    // Fibonacci number
    ['1', '2', '3', '5', '8', '13', '21', '34', '55', '89', '144', '&#9749;', '?'],
    // Fibonaci series including 0.5
    ['0.5', '1', '2', '3', '5', '8', '13', '20', '40', '100'],
    // Canadian Cash format
    ['1', '2', '5', '10', '20', '50', '100'],
    // Standard fibonacci with shrug
    ['1', '2', '3', '5', '8', '13', '&#F937;'],
    //Salesforce Estimates
    ['0.5','1','3','5','8']
];

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Planning-Poker</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Features-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Footer-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Login-Form-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Navigation-with-Button.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Registration-Form-with-Photo.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Social-Icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Testimonials.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="script/script.js"></script>
</head>

<body>
    <?php
    include_once("templates/navbar.php");
    ?>

    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Erstelle eine Sitzung</h4>
                    <p class="card-text"> Gib deiner Sitzung einen Namen und wähle die Karte aus, welche du benutzen möchtest. Teile anschließend die erhaltene ID deinen Teilnehmern mit.</p>
                    <!-- TODO: Lobby per click erzeugen -->
                    <form action="">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Sitzungs Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Meine Session">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Karten:</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <?php
                                    foreach ($cardSets as $key=>$cardSet) {
                                        echo "<option value=$key>" . json_encode($cardSet) . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-secondary">Erstellen</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tritt einer Sitzung bei</h4>
                    <p class="card-text"> Du hast eine Sitzungs-ID? Gib sie hier ein um der Sitzung beizutreten</p>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Sitzungs-ID:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="z.B. 123456789">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Dein Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $_SESSION["username"]?>">
                        </div>
                        <br>
                        <button type="button" class="btn btn-secondary">Beitreten</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    include_once("templates/footer.php");
    ?>
</body>

</html>