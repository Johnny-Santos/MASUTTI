<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" href="masutti.css" type="text/css">
  <style>

@font-face {
	font-family: "code128";
	src: local("RegencyScriptFLF-Regular"), url("../code128.ttf");
	}

* {
  margin: 0;
  padding: 0;
}


.break  { page-break-before: always; }
  </style>


    
</head>
<body  >
    <?php
    	date_default_timezone_set('America/Cuiaba');
	$date_hora = date('Y-m-d H:i');
	$date = date('d/m/Y');
	$hora = date('H:i');
		include '../a.php';
		$con = odbc_connect("A","usr_QKQQVJ","10c5s3Dxxn2") or die("Erro na conexão com o Database");
	    //$con = odbc_connect("WEB_2","","") or die("Erro na conexão com o Database");
		$c = $_POST['Codigo'];


                $tt_bloco = odbc_exec($con,"

					SELECT 
					SBZ010.BZ_COD, 
					SBZ010.BZ_LOCPAD, 
					SB1010.B1_DESC, 
					SB2010.B2_QATU, 
					SBZ010.BZ_XLOCAC
					FROM 
					SBZ010 INNER JOIN (SB2010 INNER JOIN SB1010 ON (SB2010.B2_LOCAL = SB1010.B1_LOCPAD) 
					AND (SB2010.B2_COD = SB1010.B1_COD)) ON (SBZ010.BZ_COD = SB2010.B2_COD) 
					AND (SBZ010.BZ_LOCPAD = SB2010.B2_LOCAL) 
					AND (SBZ010.BZ_FILIAL = SB2010.B2_FILIAL)
					WHERE (((
					SBZ010.BZ_FILIAL)='010101') 
					AND ((SBZ010.D_E_L_E_T_)<>'*') 
					AND ((SB2010.D_E_L_E_T_)<>'*') 
					AND ((SB1010.D_E_L_E_T_)<>'*') 
					AND ((SBZ010.BZ_LOCPAD)='22') 
					AND ((SBZ010.BZ_COD)='$c'))

                ");
                  while(odbc_fetch_row($tt_bloco)) {
                  $i= $i +1;
                  $red = odbc_result($tt_bloco,'BZ_COD');
					$desc = odbc_result($tt_bloco,'B1_DESC');
					$local = odbc_result($tt_bloco,'BZ_XLOCAC');

                  }	

	?>
	
	
		<center>
				
			<div style="height: 2cm; margin-top: 5px;">
				<table>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<td> 
							<span style=" font-weight: bolder; font-family: sans-serif; font-size: 14px;"><?php echo "Localização: $local"; ?> </span> 
						</td>
						<td style="font-size: 10px; font-family: sans-serif;">Faz. Saudades</td>
					</tr>					
					<tr>
					<td colspan="2" style=" font-size: 50px;  font-family: c39hrp36dltt;"><?php echo "*".$red."*"; ?></td>
					</tr>

					<tr>
						<td rowspan="2" style="font-weight: bold; font-family: sans-serif; font-size: 12px;"><?php echo "$desc"; ?></td>

						<td rowspan="2" >
						<img src="logo.png" width="80px" >
						</td>

					</tr>

					<tr>
						
					</tr>
				</table>
			</div>
			
			
				
		</center>
		
	
	   <script src="./style/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="./style/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="./style/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>