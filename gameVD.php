<?php

//include "game.php";
session_start() ; 
$puzzle=$_SESSION['puzzle'];
$solved=$_SESSION['solved'];
$mode=$_SESSION['mode'];
$level=$_SESSION['level'];
$mistakes=$_SESSION['mistakes'];


//___________________________Read Bord________________________
function Read(&$mylist,&$mistakes){
	$mistakes=$_POST['mistakes'];
	$counter=1;
	for($i=0;$i<9;$i++){
		$row=array();
		for($j=0;$j<9;$j++){
			array_push($row,$_POST[$counter]);
			$counter++;
		}
		array_push($mylist,$row);
	}
}

function Fill(&$mylist, &$puzzle, &$solved, &$mistakes){
	
	$counter=1;
	for($i=0;$i<9;$i++){
		for($j=0;$j<9;$j++){
			if(($i<3 and $j <3) or ($i<9 and $i >5 and $j <9 and $j>5) or ($i<6 and $i >2 and $j <6 and $j>2) or ($i<3 and $j <9 and $j>5) or ($i<9 and $j <3 and $i>5)){
				if(empty($mylist[$i][$j])){
					echo "<input type='text' name='".$counter."' class='box-1' value='".$mylist[$i][$j]."'>";
				}else{
					if($mylist[$i][$j] != $puzzle[$i][$j]){//new input
						if($mylist[$i][$j] == $solved[$i][$j]){//true number
							echo "<input type='text' name='".$counter."' class='box-1' value='".$mylist[$i][$j]."' readonly style='color:green;'>";
							$puzzle[$i][$j]=$mylist[$i][$j];
						}else{//false number
							echo "<input type='text' name='".$counter."' class='box-1' value='".$mylist[$i][$j]."' style='color:red;'>";
							$mistakes++;
						}
					}else{// there is no new input (not empty)
						echo "<input type='text' name='".$counter."' class='box-1' value='".$mylist[$i][$j]."' readonly style='color:#eee;'>";
					}
				}
			}else{
				if(empty($mylist[$i][$j])){
					echo "<input type='text' name='".$counter."' class='box-2' value='".$mylist[$i][$j]."'>";
				}else{
					if($mylist[$i][$j] != $puzzle[$i][$j]){//new input
						if($mylist[$i][$j] == $solved[$i][$j]){//true number
							echo "<input type='text' name='".$counter."' class='box-2' value='".$mylist[$i][$j]."' readonly style='color:green;'>";
							$puzzle[$i][$j]=$mylist[$i][$j];
						}else{//false number
							echo "<input type='text' name='".$counter."' class='box-2' value='".$mylist[$i][$j]."' style='color:red;'>";
							$mistakes++;
						}
					}else{// there is no new input (not empty)
						echo "<input type='text' name='".$counter."' class='box-2' value='".$mylist[$i][$j]."' readonly style='color:#eee;'>";
					}
				}
			}	
			$counter++;
		}
	}
}

//_______________________________ get hint __________________________________
function Get_Hint(&$puzzle,&$solved){
	$temp=array();
	$temp=Find_Empty($puzzle);
	if($temp == Null){
		return True;
	}else{
		$R=$temp[0];
		$C=$temp[1];
	}				
	$puzzle[$R][$C] = $solved[$R][$C];
}						

$mylist=array();
Read($mylist,$mistakes);
//fill($mylist, $puzzle, $solved);

if($mistakes>=3){
	header('Location: Settings.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leon | Template One</title>
    <!-- Main Template CSS File -->
    <!-- <link rel="stylesheet" href="css/test.css" /> -->
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&#038;display=swap"
        rel="stylesheet" />
    <style>
        body {
            position: relative;
            background-image: linear-gradient(#141e30, #243b55);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .header {
            padding: 20px;
        }

        .container {
            height: 100%;
            padding-left: 15px;
            padding-right: 15px;
            margin-left: auto;
            margin-right: auto;
            /* display: flex; */
            justify-content: center;
            align-items: center;

            display: grid;
            /* grid-template-columns: auto 1fr auto; */
            /* gap: 2px; */

        }

        .form1 {
            display: grid;
            grid-template-columns: repeat(9, 40px);
            gap: 2px;
            /* position: absolute; */
            /* top: 50%; */
            /* left: 50%; */
            /* transform: translate(-50%, 15%); */
            /* border: 5px solid #009688b8; */
            padding: 2px;
            box-shadow: 1px 1px 20px -13px white;
        }

        input {
            height: 35px;
            color: #c5d117;
            font-weight: 500px;
            font-size: xx-large;
            text-align: center;
            border: 1px solid gray;
            outline: none;
        }

        .box-1 {
            background-color: #f443360f;
        }

        .box-2 {
            background-color: #00bcd412;
        }

        input:focus {
            background-color: darkcyan;
        }

        .info1 {
            display: flex;
            justify-content: space-between;
            color: #009688;
            font-size: 20px;
        }

        .mine-div {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="info1" style="padding: 20px;"></div>
            <div class="form">
                <form class="form1" method="post" action="<?php echo htmlspecialchars('gameVd.php');?>" autocomplete="off">
				
					<?php
						if($mode == "light"){
							echo "<style> body{background-image: none;background-color: palegoldenrod;}</style>";
						}
						Fill($mylist, $puzzle, $solved, $mistakes);						
						
						echo "<input type='text' readonly value='Mistakes:' style='font-size: x-large;grid-column: 1/span 2;color:white;background-color:#009688;height:40px;border-radius:10px;'>";
						echo "<input type='text' readonly value='".$mistakes."' name='mistakes' style='grid-column: 3/span 1;font-size: x-large;color:white;background-color:#009688;height:40px;border-radius:10px;'>";
						echo "<input type='text' readonly value='".$level."' style='grid-column: 4/span 2;color:white;font-size: x-large;background-color:#009688;height:40px;border-radius:10px;'>";
						echo "<input type='submit' value='Check It' style='grid-column: 6/span 4;color:white;background-color:#009688;height:44px;font-size: x-large;border-radius:10px;'>";
						
						
					?>
					
					
				</form>
            </div>
            <div class="info1">
                <div class="mine-div">
                    <i class="fa-solid fa-pencil"></i>
                    <p>pencil</p>
                </div>
                <div class="mine-div">
                    <i class="fa-solid fa-lightbulb"></i>
                    <p>hint </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>