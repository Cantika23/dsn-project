<?php
// Create database connection using config file
include_once("config.php");
include("controller/logCourierController.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Courier (GS System)</title>
    <link rel="shortcut icon" href="dsnp.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        table.table {
            font-size: 12px;
        }

        th,
        td {
            padding: 4px;
            font-size: 12px;
            white-space: nowrap;
            /* Prevent text from wrapping */
            overflow: hidden;
            /* Hide overflowing content */
            text-overflow: ellipsis;
            /* Display ellipsis (...) for the overflowed content */
        }

        .expanded-content {
            white-space: pre-line;
            /* Preserve line breaks for multiline content */
        }
    </style>
</head>

<body>
    <nav style="position: sticky; top: 0" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><img width="100px" src="/images/dsnp.PNG" alt="" class="brand-image ew-brand-image"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
                    </li>
                </ul>
                <!--<form class="d-flex" role="search" method="get">-->
                <!--    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">-->
                <!--    <button class="btn btn-outline-success" type="submit">Search</button>-->
                <!--</form>-->
                <form class="d-flex" role="search" method="get">
                    <select class="form-select me-2" name="filter">
                        <option value="" <?php echo ($filter === '' ? 'selected':'') ?> >-- Select Filter --</option>
                        <option value="awb" <?php echo ($filter === 'awb' ? 'selected':'') ?> >AWB</option>
                        <option value="datetime" <?php echo ($filter === 'datetime' ? 'selected':'') ?>>Datetime</option>
                    </select>
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Table Log Courier -->
    <div class="container-fluid mt-5">
        <table class="table table-striped">

            <tr class="text-center">
                <th>No.</th>
                <th>AWB</th>
                <th>Kurir</th>
                <th>Datetime</th>
                <th>Req Type</th>
                <th>Parameter</th>
                <th>Response</th>
                <th>Content</th>
                <th>Text Query</th>
            </tr>
            <?php
            if ($result != null && mysqli_num_rows($result) > 0) {
                while ($log_courier_data = mysqli_fetch_array($result)) {
                    
                    echo "<tr>";
                    echo "<td>" . $id . "</td>";
                    echo "<td class=\"text-break\">" . ellipsis($log_courier_data['awb']) . "</td>";
                    echo "<td class=\"text-break\">" . $log_courier_data['kurir'] . "</td>";
                    echo "<td class=\"text-break\">" . $log_courier_data['datetime'] . "</td>";
                    echo "<td class=\"text-break\">" . $log_courier_data['req_type'] . "</td>";
                    echo "<td class=\"text-break\">" . ellipsis($log_courier_data['parameter']) . "</td>";
                    echo "<td class=\"text-break\">" . ellipsis($log_courier_data['response']) . "</td>";
                    echo "<td class=\"text-break\">" . ellipsis($log_courier_data['content']) . "</td>";
                    echo "<td class=\"text-break\">" . ellipsis($log_courier_data['text_query']) . "</td>";
                    echo "</tr>";
                    $id += 1;
                }
            } else {
                echo "<tr>";
                echo "<td colspan=\"9\"> No record yet </td>";
                echo "</tr>";
            }

            function ellipsis($content, $maxLength = 50)
            {
                if (strlen($content) > $maxLength) {
                    return substr($content, 0, $maxLength - 3) . '...';
                }
                return $content;
            }
            ?>
        </table>

        <!-- Add navigation links for pagination -->
        <?php if ($result != null && mysqli_num_rows($result) > 0  && $totalSearchResults > $recordsPerPage) { ?>
        <div class="container-fluid mt-5 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    // Display Previous link if current page is not the first page
                    if ($currentPage > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '&search=' . $searchTerm . '">Previous</a></li>';
                    }
        
                    // Display pagination links based on total pages
                    $maxPagesToShow = 10;
                    $halfMaxPages = floor($maxPagesToShow / 2);
                    $startPage = max(1, $currentPage - $halfMaxPages);
                    $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
        
                    // Add ellipsis before the links if needed
                    if ($startPage > 1) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
        
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&search=' . $searchTerm . '">' . $i . '</a></li>';
                    }
        
                    // Add ellipsis after the links if needed
                    if ($endPage < $totalPages) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
        
                    // Display Next link if current page is not the last page
                    if ($currentPage < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '&search=' . $searchTerm . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <?php } ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
