<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        .border-table {
            border: 3px solid black;
            padding: 5px;
        }
    </style>
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>

    <table class='border-table'>
        <?php
        $server = "localhost";
        $username ="zaenal";
        $password = "181299Sinta!";
        $database ="gs_prod";

        $connect = mysqli_connect($server,$username,$password,$database);
        $parameter1 = $_GET['param1'];
        $no = 1;
        $sql = mysqli_query($koneksi, "SELECT * from penerimaan_paket_keluar WHERE id = $parameter1");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <?php $tujuan_penerima = explode(",", $data['tujuan_penerima']); ?>
            <tr>
                <td><b><u>Kepada Yth.</td>

            </tr>
            <?php for ($i = 0; $i < count($tujuan_penerima); $i++) : ?>
                <tr>
                    <td><?php echo $tujuan_penerima[$i] ?></td>
                </tr>
            <?php endfor; ?>
            </tr>
        <?php
        }
        ?>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>