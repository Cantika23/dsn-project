<!DOCTYPE html>
<html>
<head>
    <title>Server Time Zone</title>
</head>
<body>

<?php
$serverTimeZone = date_default_timezone_get();
echo "Server Time Zone: " . $serverTimeZone;
?>

<script>
    var browserTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.write("Browser Time Zone: " + browserTimeZone);
</script>

</body>
</html>