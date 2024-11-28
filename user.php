<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'data.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Hoa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .flower-item {
            margin-bottom: 20px;
        }
        .flower-item img {
            max-width: 100%;
            height: auto;
            transition: transform 0.2s;
        }
        .flower-item img:hover {
            transform: scale(1.05);
        }
        .card {
            transition: box-shadow 0.2s;
        }
        .card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            color: #2c3e50;
        }
        .card-text {
            color: #7f8c8d;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Các loài hoa không được đẹp lắm mà cũng không thơm lắm</h1>
        <div class="row" id="flower-list">
            <?php
            foreach ($flowers as $flower) {
                echo '<div class="col-md-4 flower-item">';
                echo '<div class="card shadow-lg rounded-lg overflow-hidden">';
                echo '<a href="' . $flower['image'] . '" data-lightbox="flower-gallery" data-title="' . $flower['name'] . '">';
                echo '<img class="card-img-top" src="' . $flower['image'] . '" alt="' . $flower['name'] . '">';
                echo '</a>';
                echo '<div class="card-body p-4">';
                echo '<h5 class="card-title text-xl font-bold">' . $flower['name'] . '</h5>';
                echo '<p class="card-text">' . $flower['description'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>