<?php
error_reporting(E_ERROR | E_PARSE);
$file = fopen("./data/cantons.csv", "r");
$data = array();
while (!feof($file)) {
    $row = fgetcsv($file);
    $data[$row[1]] = $row[0];
}
fclose($file);
$footer = "footer";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CH-Reg</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body data-bs-theme="dark">
    <div class="container mt-4">
        <h2>CH-Reg <img src="./img/favicon.png" alt="logo" width="42"></img></h2>
        <form class="d-flex mt-3 mb-4" role="search" method="POST">
            <input class="form-control me-2" type="search" name="canton" placeholder="Canton code" aria-label="Canton code">
            <button class="btn btn-outline-danger" type="submit">Search</button>
        </form>
        <?php
        if ($_POST) {
            $canton = strtoupper(trim($_POST["canton"]));
            $result = array_search($canton, $data);
        }
        ?>
        <?php if ($canton == ""): ?>
            <ul class="fs-5 fw-normal">
                <?php foreach ($data as $key => $value): ?>
                    <li><span class="font-monospace fw-bold text-danger"><?= $value ?></span> &rarr; <span class="fst-italic"><?= $key ?></span></li>
                <?php endforeach; ?>
            </ul>
            <?php $footer = ""; ?>
        <?php elseif (!$result): ?>
            <div class="alert alert-danger" role="alert">
                Canton not found in database.
            </div>
        <?php else: ?>
            <h5 class="fs-4"><?= $result ?></h5>
            <img class="w-25 mt-2 shadow" src="./img/cantons/<?= $canton ?>.svg" alt="Flag of <?= $result ?>">
        <?php endif; ?>
    </div>
    <div class="text-center fw-lighter my-3 <?= $footer ?>"><a href="https://github.com/Fonta22" target="_blank">Fonta22</a> &copy; 2024</div>
    <script src="mobile.js"></script>
</body>
</html>
