<?php

namespace Mitral2022\DSN2;

// Page object
$Landing = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
  // Simulasi PHP untuk memuat data jika diperlukan
  $pageTitle = "DSN GROUP";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/dsn_group_logo.png" type="image/png">
    <title>DSN Group Landing Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
            text-align: center;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .container {
            padding: 100px 20px 50px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }

        p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 30px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button {
            padding: 15px 40px;
            font-size: 1rem;
            color: #fff;
            background-color: #6c63ff;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .button:hover {
            /* background-color: #574bcb; */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.4);
            color: white;
        }

        footer {
            margin-top: 50px;
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="navbar">
        <img src="images/dsn_group_logo.png" alt="DSN Group Logo" style="height: 60px; width: auto;">
    </div>
    
    <div class="container" style="margin-top:100px">
        <h1 style="color:#6c757d">Welcome to Software Filling</h1>
        <p>Choose the location you want to explore</p>

        <div class="button-container">
            <a href="https://gs.dsngroup.co.id/login?menu=head_office" class="button">Head Office</a>
            <a href="https://gs.dsngroup.co.id/login?menu=kalimantan" class="button">Kalimantan</a>
        </div>
    </div>

    <footer>
        &copy; 2025 Software Filling. All Rights Reserved.
    </footer>

</body>
</html>


<?= GetDebugMessage() ?>

