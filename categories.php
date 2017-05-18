
<head>
	<?php include 'include/head.php'; ?>

	<title>klasser</title>
	</head>
<body >
	<?php 	include 'include/nav.php'; ?>
	<div style="margin-top: 80px">
	<h1>klasser</h1>
	   <!-- --------------- Drop down list for valg av klasse ------------- -->
	<form action="#" method="post">
		<select name="klasser_klasseID">     				 <!-- utvalg (dropdown liste)  "klasser_klasseID -->
			<option value="">velg en klasse</option>    <!-- innhold i utvalg (dropdown lista) -->
			<option value="1">3dea</option>                 <!-- innhold i utvalg (dropdown lista) -->
			<option value="2">3deb</option>			 <!-- innhold i utvalg (dropdown lista) -->
			</select>							         <!-- utvalg (dropdown liste)  slutter -->
		<input type="submit" name="velgKlasse" value="Vis klasser" />   <!-- knapp type velgerknapp id="velgKlasse" -->
		</form>
</div>
		<style media="screen">

			table{
				width: 100%;
				border-collapse: collapse;
			}
			table, td, th{
				border: 1px solid black;
				padding: 5px;
			}
			th {text-align: left;}

		</style>
	<?php
		if(isset($_POST['velgKlasse']))          //-------------hvis knappen 'submit' er trykket
			{
				$klasser_klasseID = $_POST['klasser_klasseID'];  // ----------- lagre den valgte verdien i en variabel

				//-------------- oppsett for å oppkobling til databasen på mySQL server --------
	include 'dbconnect.php';

				// ---------- kontroler forbindelsen ----------------------
				if ($conn->connect_error)
					{
						die("Connection failed: " . $conn->connect_error);
					}

				//-----------kjør en spørre setning (SQL)-----------
				$sql = "SELECT forNavn, epost, klasser_klasseID, telefon FROM elever WHERE klasser_klasseID = ".$klasser_klasseID."";

				//------------Lagre spørre resultatet i en variabel som en array-------
				$result = $conn->query($sql);

				//---- hvis det er mer en ingen varer i gruppa vis resultat -----
				if ($result->num_rows > 0)
					{
						echo "<h3>valgte varer er</h3>";
						// ---------------- skriver ut alle varer i valgt gruppe -------------
						echo "<table>
						<tr>
						<th>forNavn</th>
						<th>epost</th>
						<th>klasser_klasseID</th>
						<th>telefon</th>
						</tr>";



						while($row = $result->fetch_assoc())
							{
								echo "<tr>";
								echo "<td>" .  $row["forNavn"]."</td>";
								echo "<td>" .  $row["epost"]. "</td>";
								echo "<td>" .  $row["klasser_klasseID"]. "</td>";
								echo "<td>" .  $row["telefon"]. "</td>";
								echo "</tr>";
							}
							echo "</table>";
					}
				//----------hvis det ikke er noen varer i gruppa vis teksten "ingen produkter"------
				 else
					{
						echo "<br>", "ingen elever";
					}

				//---------------------lukk forbindelsen til databasen------------
				$conn->close();
			}

	else                                //-------------hvis knappen 'submit' IKKE er trykket
			{
				echo "Du må velge en av klassene";
			}
	?>
	</body>
</html>
