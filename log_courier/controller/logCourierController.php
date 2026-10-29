<?php
// Define the number of records to display per page
$recordsPerPage = 10;

// Get the current page number from the query parameter, default to 1
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

if ($currentPage == 1) {
    $id = 1;
} else {
    $id = ($recordsPerPage * $currentPage) - ($recordsPerPage - 1);
}

// Calculate the OFFSET value based on the current page number
$offset = ($currentPage - 1) * $recordsPerPage;

// Fetch data for the current page using the modified SQL query with search term, LIMIT, and OFFSET

// Fetch data for the current page using the modified SQL query with LIMIT and OFFSET
// Get the search term from the submitted form
// if (isset($_GET['search'])) {
//     $searchTerm = $_GET['search'];
// } else {
//     $searchTerm = '';
// }

// // $query = "SELECT * FROM log_courier ORDER BY id DESC LIMIT $recordsPerPage OFFSET $offset";
// $query = "SELECT * FROM log_courier WHERE 
//             awb LIKE '%$searchTerm%' OR 
//             datetime LIKE '%$searchTerm%'
//             ORDER BY id DESC LIMIT $recordsPerPage OFFSET $offset";

// Get the search term and filter from the submitted form
$searchTerm = '';
$filter = ''; // Default filter

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
}

// $whereClause = '';
// Build the WHERE clause based on the selected filter
if ($searchTerm !== '') {
    if ($filter === 'awb') {
        $whereClause = "WHERE awb LIKE '%$searchTerm%'";
    } else if ($filter === 'datetime') {
        $whereClause = "WHERE datetime LIKE '%$searchTerm%'";
    }
}else {
    if ($filter === 'awb') {
        $whereClause = "WHERE awb = '$searchTerm'";
    } else if ($filter === 'datetime') {
        $whereClause = "WHERE datetime = '$searchTerm'";
    }
}

// Construct the SQL query
$query = "SELECT * FROM log_courier $whereClause ORDER BY id DESC LIMIT $recordsPerPage OFFSET $offset";


$result = mysqli_query($mysqli, $query);

// Count the total number of search results
$totalSearchResultsQuery = "SELECT COUNT(*) AS total FROM log_courier WHERE 
                            awb LIKE '%$searchTerm%' OR 
                            datetime LIKE '%$searchTerm%'";
$totalSearchResultsResult = mysqli_query($mysqli, $totalSearchResultsQuery);
$totalSearchResultsData = mysqli_fetch_assoc($totalSearchResultsResult);
$totalSearchResults = $totalSearchResultsData['total'];

// Calculate the total number of pages based on the total search results and records per page
$totalPages = ceil($totalSearchResults / $recordsPerPage);
?>