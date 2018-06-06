<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/open-iconic/font/css/open-iconic.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col col-4">
                <img src="<?php echo base_url('assets/images/placeholder.svg'); ?>" alt="">
            </div>
            <div class="col col-8">
                <h1><?php echo $game->title; ?></h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus incidunt quos repudiandae odio, officiis facere maiores placeat obcaecati laudantium similique!</p>
                <p>Release Year : <?php echo $game->releaseDate; ?></p>
                <p>Rating : <?php echo $game->rating; ?></p>
            </div>
        </div>
    </div>
    <!-- General Javascript -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>