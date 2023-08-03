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
            background-color: #9e9e9e78;
            font-family: "Work Sans", sans-serif;
        }

        .container {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .card {
            width: 250px;
            max-width: 300px;
            background-color: white;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
        }

        .card .card-image {
            background-image: url("images/portfolio-1.jpg");
            background-size: cover;
            height: 200px;
            border-radius: 5px;
        }

        .card .card-image h2,
        .card .card-image p {
            color: burlywood;
        }

        .div-form {
            padding: 15px;
        }

        .div-form .input {
            padding: 5px;
        }

        .div-form .input #name {
            border: none;
            border-bottom: 1px solid #293ca8;
            height: 25px;
            /* border-radius: 5px; */
            margin-bottom: 15px;
            color: #293ca8;
            outline: none;
        }

        .div-form .input #name:focus {
            border-bottom: 1px solid rgb(170, 106, 22);
            color: rgb(170, 106, 22);
        }

        #easy,
        #medium,
        #hard {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .div-form .submit {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;

        }

        .div-form .submit input {
            padding: 15px;
            background-color: #3f51b5;
            border: none;
            border-radius: 5px;
            color: white;
            width: 100%;

        }

        .div-form .submit input:hover {
            background-color: #293ca8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-image">
                <h2>Get Started</h2>
                <p><small>Let us create your puzzel</small></p>
            </div>
            <div class="div-form">
                <form method="get" action="<?php echo htmlspecialchars('game.php');?>">
                    <div class="input">
                        <!-- <label for="PlayerName">Player Name</label> -->
                        <input id="name" type="text" name="PlayerName" placeholder="Full name">
                    </div>
                    <label>Puzzel Level : </label>
                    <div class="input">
                        <input type="radio" id="easy" name="level" value="easy">
                        <label for="easy">Easy</label>
                    </div>
                    <div class="input">
                        <input type="radio" id="medium" name="level" value="medium">
                        <label for="medium">Medium</label>
                    </div>
                    <div class="input">
                        <input type="radio" id="hard" name="level" value="hard">
                        <label for="hard">Hard</label>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Get Started">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>