<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.border-table {
			border: 1px solid black; 
			padding: 4px;
			width:100%;
		}
		.container {
			width:99%;
		}

		.table1, .table2, .table3 {
			width:100%;
			border-collapse: collapse;
			border: 1px solid black;
		}

		th, td {
			padding: 5px;
			text-align: left;
			text-align: center;
			border: 1px solid black;
		}

		.table2 th {
			font-size: 30px
		}

	</style>
	<style type="text/css" media="print">
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
</head>
<body>

		<div class='container'>
			<div>
				<p style="float:left; margin-top:-10px"><img src="../dsnp.png" alt="" width='80'></p>						
				<p style='text-align:center; font-size: 25px; margin-top:40px;'><b>PT DHARMA SATYA NUSANTARA Tbk.</b></p>
				<div style="clear:both"></div>
			</div>

		<?php 
			
			$server = "localhost";
			$username ="zaenal";
			$password = "181299Sinta!";
			$database ="gs_prod";

			$connect = mysqli_connect($server,$username,$password,$database);
			$parameter1 = $_GET['param1'];
			$no = 1;

			$sql = mysqli_query($koneksi,"SELECT a.no_box, b.nama AS 'nama_perusahaan', b.nama_lengkap AS 'nama_lengkap_perusahaan', c.nama AS 'nama_departemen', a.lokasi, a.tahun_pembuatan_dokumen, a.deskripsi
			FROM filing_dokumen a
			JOIN m_kode_pt b ON a.kode_pt = b.id 
			JOIN m_kode_department c ON a.kode_department = c.id
			WHERE a.id = $parameter1");

			while($data = mysqli_fetch_array($sql)){
			?>
				<?php $deskripsi = explode(",",$data['deskripsi']);?>

				<div class='border-table'>      
					
					<div style='float:left; width:49%;'>
						<table class='table1'>
						<thead>
							<tr style='height:50px'>
								<th>NAMA PERUSAHAAN</th>
								<th><?php echo $data['nama_lengkap_perusahaan']; ?></th>
							</tr>
						</thead>
						</table>
					</div>

					<div style='float:right; width:49%;'>
						<table class='table1'>
						<thead>
							<tr style='height:50px'>
								<th>TAHUN DOKUMEN</th>
								<th style='font-size: 30px'><?php echo $data['tahun_pembuatan_dokumen']; ?></th>
							</tr>
						</thead>
						</table>
					</div>

					<div style='clear:both'></div>
					<br>
					<table class='table2'>
					<thead>
						<tr>
							<th><?php echo $data['no_box']; ?></th>
							<th><?php echo $data['nama_perusahaan']; ?></th>
							<th><?php echo $data['nama_departemen']; ?></th>
							<th><?php echo $data['lokasi']; ?></th>
							<th><?php echo substr($data['tahun_pembuatan_dokumen'],2); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>NO</td>
							<td colspan='4' align='center'>DESKRIPSI DOKUMEN</td>
						</tr>
						<?php for($i=0; $i<count($deskripsi); $i++):?>
						<tr>
							<td><?php echo $no;?></td>
							<td colspan='4'><?php echo $deskripsi[$i]?></td>
						</tr>
						<?php $no++; endfor;?>	
					</tbody>
					</table>
				
				</div>
				
			<?php 
			}
		?>

		
		</div>

	<script>
		window.print();
	</script>

</body>
</html>