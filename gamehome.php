<!DOCTYPE html>
<html>
<head>
<style>
body{
	background-image:url("sudoku1.jpg");
	background-size: cover;
}

form{
    position: absolute;
    top: 50%;
    left: 50%;
}

input{
	width: 200px;
    height: 60px;
    background-color: coral;
    border-radius: 50px;
    border: none;
    color: white;
    font-size: 30px;
    opacity: 0.9;
}

input:hover{
	opacity:1;
	width:220px;
	height: 65px;
	transition:2s;
}
</style>
</head>
<body>
<form method="post" action="test.html">
<input type="submit" value="Play">
</form>
</body>
</html>
