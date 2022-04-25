<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Number to Words</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container p-3">
        <form method="GET">
            Enter Number: <input type="text" name="enteredNumber"
                value="<?= isset($_GET['enteredNumber']) ? $_GET['enteredNumber']  : '' ?>">
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>


    <?php
    if (isset($_GET['enteredNumber'])) {
        $enteredNumber = $_GET['enteredNumber'];
        if (is_numeric($enteredNumber)) { // check if the entered string is numeric
            $numByThree = groupByThree(removeFirstZeros($enteredNumber));
            // print_r($numByThree);
            //  $newNumByThree = [];
            for ($x = count($numByThree); $x > 0; $x--) {
                $key = $x;
                $value = $numByThree[$x];
                //  echo $key . ' - ' . $value;
                echo toWords($value, $key) . " ";
                echo "<br>";
            }
        }
    }

    function toWords($num, $key)
    {
        $words = "";
        $words = threeNumToWords($num);
        if ($key === 1) {
            //none

        } elseif ($key === 2) {
            //thousands
            $words = $words . "Thousand";
        } elseif ($key === 3) {
            //million
            $words = $words . "Million";
        } elseif ($key === 4) {
            //billion
            $words = $words . "Billion";
        } elseif ($key === 5) {
            //billion
            $words = $words . "Trillion";
        }

        return $words;
    }

    function threeNumToWords($num)
    {

        $words = "";

        if (strlen($num) === 3) {
            // hundred

            $words = $words . digitToWord(substr($num, 0, 1));

            if ($words !== "") {
                $words = $words . " Hundred ";
            }


            if (substr($num, 0, 1) == "0") {

                if (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "0") {
                    $words = $words . " Ten ";
                } else if (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "1") {
                    $words = $words . " Eleven ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "3") {
                    $words = $words .  " Thirteen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "4") {
                    $words = $words .  " Fourteen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "5") {
                    $words = $words .  " Fifteen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "6") {
                    $words = $words .  " Sixteen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "7") {
                    $words = $words .  " Seventeen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "8") {
                    $words = $words .  " Eigteen ";
                } elseif (substr($num, 1, 1) == "1" && substr($num, 2, 1) == "9") {
                    $words = $words .  " Nineteen ";
                }
            }


            $words = $words .  twoDigitToWord(substr($num, 1, 1));






            if (!(substr($num, 0, 1) == "0" && substr($num, 1, 1) == "1")) {
                $words = $words . digitToWord(substr($num, 2, 1)) . " ";
            }
        } elseif (strlen($num) === 2) {
            $words = $words .  twoDigitToWord(substr($num, 0, 1));
            $words = $words . digitToWord(substr($num, 1, 1));
        } elseif (strlen($num) === 1) {

            $words = $words . digitToWord(substr($num, 0, 1));
        }





        return $words;
    }

    function twoDigitToWord($digit)
    {

        $words = "";

        if ($digit == "2") {
            $words = $words . " Twenty ";
        } else if ($digit == "3") {
            $words = $words . " Thirty ";
        } else if ($digit == "4") {
            $words = $words . " Fourty ";
        } else if ($digit == "5") {
            $words = $words . " Fifty ";
        } else if ($digit == "6") {
            $words = $words . " Sixty ";
        } else if ($digit == "7") {
            $words = $words . " Seventy ";
        } else if ($digit == "8") {
            $words = $words . " Eighty ";
        } else if ($digit == "9") {
            $words = $words . " Ninety ";
        }

        return $words;
    }

    function digitToWord($digit)
    {

        $words = "";
        if ($digit == "1") {
            $words = "One";
        } elseif ($digit == "2") {
            $words = "Two";
        } elseif ($digit == "3") {
            $words = "Three";
        } elseif ($digit == "4") {
            $words = "Four";
        } elseif ($digit == "5") {
            $words = "Five";
        } elseif ($digit == "6") {
            $words = "Six";
        } elseif ($digit == "7") {
            $words = "Seven";
        } elseif ($digit == "8") {
            $words = "Eight";
        } elseif ($digit == "9") {
            $words = "Nine";
        }

        return $words;
    }

    function groupByThree($enteredNumber)
    { //returns array
        $numberGroups = [];
        $groupCount = groupCount($enteredNumber);
        for ($x = $groupCount - 1; $x >= 0; $x--) {

            $start = ($x * 3) - ($groupCount * 3 - strlen($enteredNumber));

            $end = $start + 2;

            if ($start < 0) {
                $start = 0;
            }


            $numberGroups[$groupCount - $x] =  substr($enteredNumber, $start, $end - $start + 1);
        }

        return $numberGroups;
    }

    function groupCount($enteredNumber)
    {
        return ceil(strlen($enteredNumber) / 3);
    }



    function removeFirstZeros($enteredNumberString)
    {
        $newNumber = "";
        $hitFirstNonZero = false;

        for ($x = 0; $x < strlen($enteredNumberString); $x++) {
            if ($enteredNumberString[$x] !== "0") {
                $hitFirstNonZero = true;
            }
            if ($hitFirstNonZero) {
                $newNumber = $newNumber . $enteredNumberString[$x];
            }
        }

        return $newNumber;
    }


    ?>


</body>

</html>