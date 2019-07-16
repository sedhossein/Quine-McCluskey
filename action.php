<html>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style>
        * {
            box-sizing: border-box;
        }
    
        body {
            background-color: #f1f1f1;
        }
    
        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            font-family: Arial;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }
    
        h1 {
            text-align: center;
        }
    
        button {
            background-color: darkslategray;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }
    
        button:hover {
            opacity: 0.8;
        }
    
        #prevBtn {
            background-color: #bbbbbb;
        }
    
        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }
    
        .step.active {
            opacity: 1;
        }
    
        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #4CAF50;
        }
    </style>
    
    
    <body>
    
    
    <div id="regForm">
        <h1>online Quine–McCluskey</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <hr>
            <p style="font-family: Arial">
                Number Of Variable is :
                <?php
                $number_of_variables = $_POST["variable"];
                echo $number_of_variables;
                ?>
                <br>
                Your Minterms is:
                <?php
                $minterms = $_POST["minterms"];
                echo $minterms
                ?>
            </p>
            <hr>
            <?php
            $array_of_minterms = [];
            $invalid_minterm = false;
            $array_of_minterms = explode(",", $minterms);
            $all_numeric = true;
            foreach ($array_of_minterms as $key) {
                if (!(is_numeric($key))) { // check the type of minterms
                    $all_numeric = false;
                    break;
                }
            }
            foreach ($array_of_minterms as $key) { //check the range of minterms
                if ($key >= pow(2, $number_of_variables)) {
                    $invalid_minterm = true;
                    break;
                }
            }
            if (ctype_digit($number_of_variables) && $number_of_variables <= 8 && $number_of_variables >= 0
                && $all_numeric && !$invalid_minterm) { //check the validate of inputs
                ?>
                <p>
    
                    <?php
                    @include 'main.php';
                    ?>
    
    
                </p>
            <?php } else { ?>
                <p> your inputs are invalid !</p>
            <?php } ?>
        </div>
        <hr>
    
        <div style="overflow:auto;">
            <div style="float:right;">
                <a href="index.php" type="button" id="nextBtn" class="btn btn-success">home</a>
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
        </div>
    </div>
    
    
    </body>
</html>
