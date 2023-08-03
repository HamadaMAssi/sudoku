<?php

session_start();

function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

if($_SERVER['REQUEST_METHOD']=="GET"){
$PlayerName=$_GET['PlayerName'];
$level=$_GET['level'];
$mode=$_GET['mode'];

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
            justify-content: space-evenly;
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
                <form class="form1" method="post" action="<?php echo htmlspecialchars('gameVD.php');?>" autocomplete="off">
					
					<?php
						$puzzle=array_fill(0,9,array_fill(0,9,""));
						$solved=array();
						
						function Sudoku_Generator(&$puzzle){
							$v=array(1,2,3,4,5,6,7,8,9);
							Shuffle($v);
							for($i=0;$i<9;$i++){
								for($j=0;$j<9;$j++){
									if($i == 0){
										$puzzle[0][$j]=$v[$j];
									}
								}
							}
						}


						function Find_Empty(&$puzzle){
							for($i=0;$i<9;$i++){
								for($j=0;$j<9;$j++){
									if(empty($puzzle[$i][$j])){
										$place=array($i,$j);
										return $place;
									}
								}
							}
							return Null;
						}

						//________________________ find  empty place in Puzzle _____________________________
						function IS_Valid(&$puzzle,$value,$mytuple){
							$num_of_row=$mytuple[0];
							$num_of_column=$mytuple[1];
							
							//________ checking rows __________
							for($i=0;$i<9;$i++){
								if($puzzle[$num_of_row][$i] == $value and $num_of_column != $i){
									return False;
								}
							}
	
							//________ checking columns __________
							for($i=0;$i<9;$i++){
								if($puzzle[$i][$num_of_column] == $value and $num_of_row != $i){
									return False;
								}
							}
							
							//________ checking box __________
							$Box_Row = (int)($num_of_row/3);
							$Box_Column = (int)($num_of_column/3);
							for($i=($Box_Row*3);$i<(($Box_Row*3)+3);$i++){
								for($j=($Box_Column*3);$j<(($Box_Column*3)+3);$j++){
									if($puzzle[$i][$j] == $value and $num_of_row != $i and $num_of_column != $j){// if we found this num in this box
										return False;
									}
								}
							}
							return True; //if the number is valid 
						}

						//____________________________ solve the Puzzle _____________________________
						function Solve_puzzle(&$puzzle){
							$temp=array();
							$temp=Find_Empty($puzzle);
							if($temp == Null){
								return True;
							}else{
								$R=$temp[0];
								$C=$temp[1];
							}
							
							for($i=1;$i<10;$i++){
								if(IS_Valid($puzzle,$i,$temp)){
									$puzzle[$R][$C]=$i;
									if(Solve_puzzle($puzzle)){
										return True;
									}
									$puzzle[$R][$C]="";
								}
							}
							return False;
						}
						
						//____________________________ Setup puzzle level ________________________________
						function Set_Level(&$puzzle, &$level){
							if($level == "easy"){
								$i=0;
								while($i<49){
									$random_row=rand(0,8);
									$random_column=rand(0,8);
									while($puzzle[$random_row][$random_column]==""){
										$random_row=rand(0,8);
										$random_column=rand(0,8);
									}
									$puzzle[$random_row][$random_column]="";
									$i++;
								}
							}elseif($level == "medium"){
								$i=0;
								while($i<61){
									$random_row=rand(0,8);
									$random_column=rand(0,8);
									while($puzzle[$random_row][$random_column]==""){
										$random_row=rand(0,8);
										$random_column=rand(0,8);
									}
									$puzzle[$random_row][$random_column]="";
									$i++;
								}
							}else{
								$i=0;
								while($i<73){
									$random_row=rand(0,8);
									$random_column=rand(0,8);
									while($puzzle[$random_row][$random_column]==""){
										$random_row=rand(0,8);
										$random_column=rand(0,8);
									}
									$puzzle[$random_row][$random_column]="";
									$i++;
								}
							}
						}

						Sudoku_Generator($puzzle);
						Solve_puzzle($puzzle);
						$solved=$puzzle;
						Set_Level($puzzle, $level);
						
						if($mode == "light"){
							echo "<style> body{background-image: none;background-color: palegoldenrod;}</style>";
						}
						$counter=1;
						for($i=0;$i<9;$i++){
							for($j=0;$j<9;$j++){
								if(($i<3 and $j <3) or ($i<9 and $i >5 and $j <9 and $j>5) or ($i<6 and $i >2 and $j <6 and $j>2) or ($i<3 and $j <9 and $j>5) or ($i<9 and $j <3 and $i>5)){
									if(empty($puzzle[$i][$j])){
										echo "<input type='text' name='".$counter."' id='C".$counter."' class='box-1' value='".$puzzle[$i][$j]."'>";
									}else{
										echo "<input type='text' name='".$counter."' id='C".$counter."' class='box-1' value='".$puzzle[$i][$j]."' readonly style='color:#eee;'>";
									}
								}else{
									if(empty($puzzle[$i][$j])){
										echo "<input type='text' name='".$counter."' id='C".$counter."' class='box-2' value='".$puzzle[$i][$j]."'>";
									}else{
										echo "<input type='text' name='".$counter."' id='C".$counter."' class='box-2' value='".$puzzle[$i][$j]."' readonly style='color:#eee;'>";
									}
								}
								
								$counter++;
							}
						}
						
						$_SESSION['puzzle'] = $puzzle;
						$_SESSION['solved'] = $solved;
						$_SESSION['mode'] = $mode;
						$_SESSION['level'] = $level;
						$x=0;
						$_SESSION['mistakes'] = $x;
						
						echo "<input type='text' readonly value='Mistakes:' style='font-size: x-large;grid-column: 1/span 2;color:white;background-color:#009688;height:40px;border-radius:10px;'>";
						echo "<input type='text' readonly value='0' name='mistakes' style='grid-column: 3/span 1;font-size: x-large;color:white;background-color:#009688;height:40px;border-radius:10px;'>";
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
