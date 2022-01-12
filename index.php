<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="./dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="./dist/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./main.css">
    <script src="dist/jquery.js"></script>
    <script src="main.js"></script>
    <title>Bingo</title>
</head>
<body>
    <div class="container no-print">
    <div class="row">
        <div class="col">
            <input type="number" id="amountTxt"/>
            <button class="btn btn-primary" id="createCards">Create cards</button>
        </div>
        <div class="col">
            <button class="btn btn-primary" id="printCards">Print cards</button>
        </div>
        <div class="col">
            <button class="btn btn-primary" id="generateNumber">Next number</button>
        </div>
        <div class="col">
            <button class="btn btn-primary" id="newGame">New Game</button>
        </div>
        <div class="col">
            <button class="btn btn-primary" id="showCards">Show Cards</button>
        </div>
    </div>
</div>
    <div id="table"></div>
    <div id="victors" style="margin-left:100px;margin-top: 10px;"></div>

    <div id="test" style="margin-left:100px;margin-top: 10px;"></div>
</body>
</html>