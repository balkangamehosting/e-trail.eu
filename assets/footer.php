		</div> <!-- wrapper END -->
		<footer>
				<div class="footer">
					<table style="width: 100%; vertical-align: top; border-spacing: 0px;">
						<tr>
							<th width="170px"></th>
							<th width="160px"></th>
							<th width="160px"></th>
							<th width="275px"></th>
							<th></th>
						</tr>
						<tr>
							<td style="border-left: none">
							<img src="./assets/<?php echo $_SESSION['style']; ?>/img/logo2.png" />
							</td>
							<td>
								<div id="footerhdr" style="margin-left: 34px; margin-bottom: 0;"><?php echo $jezik['text187']; ?></div>
								<div id="footerlinks">
									<ul>
										<li>Forum</li>
										<li>Panel</li>
										<li>Kontakt</li>
										<li>Game hosting</li>
									</ul>
								</div>
							</td>
							<td>
								<div id="footerhdr" style="margin-left: 34px; margin-bottom: 0;"><?php echo $jezik['text187']; ?></div>
								<div id="footerlinks">
									<ul>
										<li>Web hosting</li>
										<li>Naruci server</li>
										<li>Pocetna</li>
										<li>Upload</li>
									</ul>
								</div>
							</td>
							<td>
								<div id="footerhdr" style="margin-left: 34px; margin-top: -20px;">Facebook</div>
								<div>
									<div class="fb-like-box" data-href="https://www.facebook.com/morenjahost" data-width="230" data-height="40" data-colorscheme="dark" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
								</div>
							</td>
							<td style="border-right: none">
								<div id="footerhdr" style="margin-left: 34px; margin-bottom: 0;"><?php echo $jezik['text188']; ?></div>
								<div id="footerlinks" class="test2">
									<ul>
										<li style="margin-left: -5px;"><div id="footerik2"></div><a href="mailto:support@morenja.info">Email - support@morenja.info</a></li>
										<li style="margin-left: -5px;"><div id="footerik3"></div><a href="https://www.facebook.com/morenjahost">Facebook Stranica</a></li>

									</ul>
								</div>
							</td>
						</tr>
					</table>
<?php
	$pageload = number_format((microtime(true) - $load), 2);
	$verzija = query_fetch_assoc("SELECT `value` FROM `config` WHERE `setting` = 'verzija'");
?>					
					<div id="copy">
						<p>
						<span style="float: left; text-align: left; width: 70%;">?? Morenja HOSTING SOLUTION All rights reserved. / Designed and coded by <a href="#">Filip Veli??kovi??</a>. </span> <span style="float: left; width: 29%; text-align: right;">Stranica u??itana za: <a><?php echo $pageload; ?>s</a> | Verzija: <?php echo $verzija['value']; ?></a></span>
						</p>
					</div>
				</div>   	
		</footer>
		<br /><br />		
	</div> <!-- pattern END -->	
	<div class="modal">
		<form action="process.php" method="POST" class="modal-contact" id="modal-contact">				
			<input type="hidden" name="task" value="contact" />
			<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> Kontakt</p>
			</div>  
			<table style="width: 100%;">
				<tr>
					<th width="50%"></th>
					<th width="50%"></th>
				</tr>
				<tr style="vertical-align: top;">
					<td>
						<input style="margin-top:0;" name="naslov" type="text" class="input" id="ki" placeholder="Naslov" /><br />
						<label id="titlex">
						* Naslov
						</label>
					</td>
					<td>					
						<input style="margin-top:0;" name="email" type="text" class="input" id="ki" placeholder="primer@primer.com" /><br />
						<label id="titlex">
						* Va??a e-mail adresa
						</label>                          	
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea rows="1" name="text" id="bugrep"></textarea><br />
						<label id="titlex">
						*<?php echo $jezik['text262']; ?>
						</label> 
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 0;"> 				
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text263']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</td>
				</tr>
			</table> 
		</form>

<?php	if (klijentUlogovan() == FALSE){	?>

		<form action="login_process.php" method="POST" class="modal-resetpw" id="modal-resetpw">				
			<input type="hidden" name="task" value="resetpw" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text606']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="username" type="text" class="input" placeholder="<?php echo $jezik['text388']; ?>" id="ki" /><br />
				<label id="titlex">
				 * <?php echo $jezik['text3']; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text224']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>

		<form action="test.php" method="post" class="modal-reginfo" id="modal-reginfo">			
			<div class="hdr">
				<p class="naslov"><i class="icon-ok"></i> <?php echo $jezik['text189']; ?></p>
			</div>  
			<div style="padding: 10px; font-size: 13px; font-weight: 500;">
				<?php echo $jezik['text190']; ?>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-exchange"></i> <?php echo $jezik['text191']; ?></button>				
			</div>
		</form>	
		
		<form action="regprocess.php" method="POST" class="modal-register" id="modal-register">				
			<input type="hidden" name="task" value="registracija" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text0']; ?></p>
			</div>  
			<table style="width: 100%;">
				<tr>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>
						<input style="margin-top:0;" name="username" type="text" class="input" id="ki" placeholder="Your username" autocomplete="off" /><br />
						<label id="titlex">
						*<?php echo $jezik['text192']; ?>
						</label>
					</td>
					<td>
						<input style="margin-top:0;" name="ime" type="text" class="input" id="ki" placeholder="Your full name (Name Lastname)" autocomplete="off" /><br />
						<label id="titlex">
						*<?php echo $jezik['text193']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td>
						<input name="email" type="text" class="input" id="email" placeholder="email@email.com" autocomplete="off" /><br />
						<label id="titlex">
						*<?php echo $jezik['text194']; ?>
						</label>
					</td>
					<td>
						<select name="zemlja" rel="zem" style="max-width: 252px;">
							<option value="srb">Srbija</option>
							<option value="cg">Crna gora</option>
							<option value="bih">Bosna i Hercegovina</option>
							<option value="hr">Hrvatska</option>
							<option value="mk">Makedonija</option>
							<option value="cg"><?php echo $jezik['text198']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text195']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td>
						<input name="sifra" type="password" class="input" id="age" placeholder="<?php echo $jezik['text269']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text196']; ?>
						</label>
					</td>
					<td>
						<?php include("./includes/func.captcha.inc.php"); ?>
						<input name="captcha" type="text" class="input" id="captcha" rel="tip" placeholder="<?php echo $jezik['text175']; ?>" title="<?php echo $_SESSION['captcha']; ?>" autocomplete="off" /><br />
						<label id="titlex">
						*<?php echo $jezik['text197']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 0;"><br /><br />
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text0']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</td>
				</tr>
			</table> 
		</form>  		
<?php	} else {
		
		if(isset($_GET['tip']))
		{
		$klijent = query_fetch_assoc("SELECT * FROM `klijenti` WHERE `klijentid` = '{$_SESSION['klijentid']}'");
?>		
		<form class="modal-uplata" id="modal-uplata">
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text200']; ?></p>
			</div> 
			<div style="padding: 7px;" id="hpromeni">
				<?php echo $jezik['text173']; ?> <z><?php echo $klijent['ime'] . ' ' . $klijent['prezime']; ?></z>, <?php echo $jezik['text201']; ?>
				
				<div style="max-width: 285px;">
				<select id="naruci-drzava" name="zemlja" rel="zem" style="max-width: 285px;">
					<option value="0" disabled selected><?php echo $jezik['text202']; ?></option>
					<option value="1">Srbija</option>
					<option value="2">Crna gora</option>
					<option value="3">Bosna i Hercegovina</option>
					<option value="4">Hrvatska</option>
					<option value="2"><?php echo $jezik['text198']; ?></option>
				</select><br /><br /><br />
				</div>
				<div id="narsrb" style="display: none;">
					<b>Ovo su informacije za <z>Srbiju:</b><br />
					<table width="100%">
						<tr style="vertical-align: top;">
							<td>
								Uplatilac: <z><?php echo $klijent['ime'] . ' ' . $klijent['prezime'] . ', ' . $klijent['email']; ?></z><br />
								Svrha uplate: <z>Morenja Hosting</z><br />
								Primalac: <z>Elmir Morenjackic</z><br />
							</td>
							<td>
								Iznos: <z>Bilo koj iznos u dinarima</z><br />
								Ra??un primaoca: <z>161-30000562365-81</z><br />
							</td>
						</tr>
					</table>	
					<a href="ucp-uplatnica.php?drzava=srb" target="_blank">
						<img width="475" height="210" src="ucp-uplatnica.php?drzava=srb" />
					</a>
					<br />
					* Kliknite na sliku za veci primerak.<br /><br />
					<z>UPUSTVA:</z><br />
					Da bi zakupili server prvo morate imati novca na morenja ra??unu. To radite tako ??to <br />uplatite sumu koju ??elite ( prvo pogledati cene servera kojeg ho??ete uplatiti pa onda <br />uplatite toliko novca, a mo??ete i vi??e ). Kada uplatite u po??ti ili banci, slikajte uplatnicu <br />sa pe??atom koju ??ete dobiti nakon uplate ( pe??at i popunjene podatke moraju da se <br />vide dobro ) prebaciti na kompjuter i uploadujte na nekom image upload sajtu. Nakon <br />toga mo??ete nastaviti ove korake i ??im administracija prihvati va??u uplatu, novac se <br />prebacuje na va??em nalogu i vi mo??ete zakupiti server.
				</div>
				<div id="narcg" style="display: none;">

					<b>Ovo su informacije za <z>Crnu Goru</z>:</b>
					<table width="100%">
						<tr style="vertical-align: top;">
							<td>
								Uplatilac: <z><?php echo $klijent['ime'] . ' ' . $klijent['prezime'] . ', ' . $klijent['email']; ?></z><br />
								Svrha uplate: <z>Morenja Hosting</z><br />
								Primalac: <z>Elmir Morenjackic</z><br />
							</td>
							<td>
								Iznos: <z>Bilo koj iznos u evrima</z><br />
								Ra??un primaoca: <z>1613000056236581</z><br />
							</td>
						</tr>
					</table>	
					<a href="ucp-uplatnica.php?drzava=cg" target="_blank">
						<img width="475" height="210" src="ucp-uplatnica.php?drzava=cg" />
					</a>
					<br />
					* Kliknite na sliku za veci primerak.<br /><br />
					<z>UPUSTVA:</z><br />
					Da bi zakupili server prvo morate imati novca na morenja ra??unu. <br />To radite tako ??to uplatite sumu koju ??elite ( prvo pogledati cene servera kojeg ho??ete uplatiti pa onda uplatite toliko novca, a mo??ete i vi??e ). Kada uplatite u po??ti ili banci, slikajte uplatnicu sa pe??atom koju ??ete dobiti nakon uplate ( pe??at i popunjene podatke moraju da se vide dobro ) prebaciti na kompjuter i uploadujte na nekom image upload sajtu. <br />Nakon toga mo??ete nastaviti ove korake i ??im administracija prihvati va??u uplatu, novac se prebacuje na va??em nalogu i vi mo??ete zakupiti server.

				</div>
				<div id="narhr" style="display: none;">
				<b>Ovo su informacije za <z>Hrvatsku</z>:</b>
					<table width="100%">
						<tr style="vertical-align: top;">
							<td>
								Platitelj: <z><?php echo $klijent['ime'] . ' ' . $klijent['prezime'] . '<br />Vasa adresa<br />' . $klijent['email']; ?></z><br />
								Opis placanja: <z>Internet usluga</z><br />
								Primatelj: <z>Elmir Morenjackic<br />
							</td>
							<td>
								Iznos: <z>Bilo koj iznos u kunama</z><br />
								Broj ra??una: <z>161300-0056236581</z><br />
								Poziv na odobrenja: <z>Vas OIB</z>
							</td>
						</tr>
					</table>	
					<a href="ucp-uplatnica.php?drzava=hr" target="_blank">
						<img width="475" height="210" src="ucp-uplatnica.php?drzava=hr" />
					</a>
					<br />
					* Kliknite na sliku za veci primerak.<br /><br />
					<z>UPUSTVA:</z><br />
					Da bi zakupili server prvo morate imati novca na morenja ra??unu. To radite tako ??to <br />uplatite sumu koju ??elite ( prvo pogledati cene servera kojeg ho??ete uplatiti pa onda <br />uplatite toliko novca, a mo??ete i vi??e ). Kada uplatite u po??ti ili banci, slikajte uplatnicu <br />sa pe??atom koju ??ete dobiti nakon uplate ( pe??at i popunjene podatke moraju da se <br />vide dobro ) prebaciti na kompjuter i uploadujte na nekom image upload sajtu. Nakon <br />toga mo??ete nastaviti ove korake i ??im administracija prihvati va??u uplatu, novac se <br />prebacuje na va??em nalogu i vi mo??ete zakupiti server.
				</div>
				<div id="narbih" style="display: none;">
					<b>Ovo su informacije za <z>Bosnu i Hercegovinu</z>:</b>
					<table width="100%">
						<tr style="vertical-align: top;">
							<td>
								Uplatilac: <z><?php echo $klijent['ime'] . ' ' . $klijent['prezime'] . ', ' . $klijent['email']; ?></z><br />
								Svrha doznake: <z>Internet usluga<br />
								Primalac: <z>Elmir Morenjackic</z><br />
							</td>
							<td>
								Iznos: <z>Bilo koj iznos u km</z><br />
								Ra??un primaoca: <z>1613000056236581</z><br />
							</td>
						</tr>
					</table>	
					<a href="ucp-uplatnica.php?drzava=bih" target="_blank">
						<img width="475" height="210" src="ucp-uplatnica.php?drzava=bih" />
					</a>
					<br />
					<br />
					* Kliknite na sliku za veci primerak.<br /><br />
					<z>UPUSTVA:</z><br />
					Da bi zakupili server prvo morate imati novca na morenja ra??unu. To radite tako ??to <br />uplatite sumu koju ??elite ( prvo pogledati cene servera kojeg ho??ete uplatiti pa onda <br />uplatite toliko novca, a mo??ete i vi??e ). Kada uplatite u po??ti ili banci, slikajte uplatnicu <br />sa pe??atom koju ??ete dobiti nakon uplate ( pe??at i popunjene podatke moraju da se <br />vide dobro ) prebaciti na kompjuter i uploadujte na nekom image upload sajtu. Nakon <br />toga mo??ete nastaviti ove korake i ??im administracija prihvati va??u uplatu, novac se <br />prebacuje na va??em nalogu i vi mo??ete zakupiti server.
				</div>
				<div id="narmk" style="display: none;">
			Uskoro </div><br />		
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-exchange"></i> <?php echo $jezik['text191']; ?></button>	
				<br />		
			</div>
		</form>
<?php	}	
		if($fajl == "naruci")
		{
?>
		<form class="modal-naruciinfo" id="modal-naruciinfo">			
			<div class="hdr">
				<p class="naslov"><i class="icon-ok"></i> <?php echo $jezik['text200']; ?></p>
			</div>  
			<div style="padding: 10px; font-size: 13px; font-weight: 500;">
				<?php echo $jezik['text203']; ?>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-exchange"></i> <?php echo $jezik['text191']; ?></button>				
			</div>
		</form>	
<?php
}
		if(isset($gps))
		{
			if($gps == "gp-server")
			{
?>
		<form action="serverprocess.php" method="POST" class="modal-srvime" id="modal-srvime">				
			<input type="hidden" name="task" value="server-ime" />
<?php
		unset($klijent);

			if(isset($_GET['id'])) {
				$srvid = mysql_real_escape_string($_GET['id']);
?>
			<input type="hidden" name="serverid" value="<?php echo $srvid; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text204']; ?></p>
			</div> 
			<div style="padding: 7px;">
<?php
			if(isset($server['name'])) {
?>				
				<input style="margin-top:0;" name="ime" type="text" class="input" id="ki" value="<?php echo $server['name']; ?>" /><br />
<?php
			}
?>				
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text205']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>  
		
		<form action="serverprocess.php" method="POST" class="modal-srvmapa" id="modal-srvmapa">				
			<input type="hidden" name="task" value="server-mapa" />
<?php
			if(isset($_GET['id'])) {
				$srvid = mysql_real_escape_string($_GET['id']);
?>
			<input type="hidden" name="serverid" value="<?php echo $srvid; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text206']; ?></p>
			</div> 
			<div style="padding: 7px;">
<?php
			if(isset($server['map'])) {
?>		
				<input style="margin-top:0;" name="ime" type="text" class="input" id="ki" value="<?php echo $server['map']; ?>" /><br />
<?php
			}
?>
				<label id="titlex">
					<?php echo $jezik['text207']; ?>
				</label>				
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text205']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>  		
<?php
			}
		}
?>
		<form action="process.php" method="POST" class="modal-sigkod" id="modal-sigkod">				
			<input type="hidden" name="task" value="sigurnosni-kod" />
			<input type="hidden" name="klijentid" value="<?php echo $_SESSION['klijentid']; ?>" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text175']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="kod" type="password" class="input" placeholder="<?php echo $jezik['text175']; ?>" id="ki" /><br />
				<label id="titlex">
				 * <?php echo $jezik['text208']; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text205']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>
		
		<form action="process.php" method="POST" class="modal-sigkod2" id="modal-sigkod2">				
			<input type="hidden" name="task" value="sigurnosni-kod" />
			<input type="hidden" name="klijentid" value="<?php echo $_SESSION['klijentid']; ?>" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text175']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="kod" type="password" class="input" placeholder="<?php echo $jezik['text175']; ?>" id="ki" /><br />
				<label id="titlex">
				 * <?php echo $jezik['text208']; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text205']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>
<?php
		if(isset($gps))
		{
			if($gps == "gp-webftp")
			{
?>
		<form action="process.php" method="POST" class="modal-folderadd" id="modal-folderadd">				
			<input type="hidden" name="task" value="folderadd" />
<?php
			if(isset($_GET['id'])) {
?>
			<input type="hidden" name="serverid" value="<?php echo $_GET['id']; ?>" />
<?php
			}
			if(isset($_GET['path'])) {
?>
			<input type="hidden" name="lokacija" value="<?php echo $_GET['path']; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text210']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="folder" type="text" class="input" placeholder="<?php echo $jezik['text209']; ?>" id="ki" /><br />
				<label id="titlex">
				 * <?php echo $jezik['text211']; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text212']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>
		
		<form action="process.php" method="POST" class="modal-ftprename" id="modal-ftprename">				
			<input type="hidden" name="task" value="ftprename" />
<?php
			if(isset($_GET['id'])) {
?>
			<input type="hidden" name="serverid" value="<?php echo $_GET['id']; ?>" />
<?php
			}
			if(isset($_GET['path'])) {
?>
			<input type="hidden" name="lokacija" value="<?php echo $_GET['path']; ?>" />
<?php
			}
?>
			<input type="hidden" name="imeftp" id="imeftps" value="" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text213']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="imesf" type="text" class="input sah" value="" id="ki" /><br />
				<label id="titlex">
				 * <?php echo $jezik['text214']; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text215']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>		
		
		<form action="process.php" method="POST" class="modal-folderdel" id="modal-folderdel">				
			<input type="hidden" name="task" value="folderdel" />
<?php
			if(isset($_GET['id'])) {
?>
			<input type="hidden" name="serverid" value="<?php echo $_GET['id']; ?>" />
<?php
			}
			if(isset($_GET['path'])) {
?>
			<input type="hidden" name="lokacija" value="<?php echo $_GET['path']; ?>" />
<?php
			}
?>
			<input type="hidden" name="folder" id="ime_foldera" value="" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text216']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<br />
				<label id="titlex" style="font-size: 12px;">
				<?php echo $jezik['text217']; ?> <z><span id="ime-foldera"></span></z>?
				</label>
				<br /><br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text218']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text219']; ?></button>				
			</div>
		</form>	

		<form action="process.php" method="POST" class="modal-fajldel" id="modal-fajldel">				
			<input type="hidden" name="task" value="fajldel" />
<?php
			if(isset($_GET['id'])) {
?>
			<input type="hidden" name="serverid" value="<?php echo $_GET['id']; ?>" />
<?php
			}
			if(isset($_GET['path'])) {
?>
			<input type="hidden" name="lokacija" value="<?php echo $_GET['path']; ?>" />
<?php
			}
?>
			<input type="hidden" name="folder" id="ime_fajla" value="" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text220']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<br />
				<label id="titlex" style="font-size: 12px;">
				<?php echo $jezik['text221']; ?> <z><span id="ime-fajla"></span></z>?
				</label>
				<br /><br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text218']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text219']; ?></button>				
			</div>
		</form>	
<?php
			}
		}
?>

		<form action="serverprocess.php" method="POST" class="modal-reinstall" id="modal-reinstall">				
			<input type="hidden" name="task" value="server-reinstall" />
<?php
			if(isset($_GET['id'])) {
				$srvid = mysql_real_escape_string($_GET['id']);
?>
			<input type="hidden" name="serverid" value="<?php echo $srvid; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text225']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<label id="titlex">
				 * <?php echo $jezik['text226']; ?>
				</label>
				<br />
				<button onclick="$.colorbox.close(); loading('Reinstalacija servera je u toku')"class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text218']; ?></button>
				<button onclick="$.colorbox.close()" class="btn btn-small btn-danger" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>
		
		<form action="serverprocess.php" method="POST" class="modal-transfer" id="modal-transfer">				
			<input type="hidden" name="task" value="prebacisrv" />
			<input type="hidden" name="serverid" value="<?php echo mysql_real_escape_string($_GET['id']); ?>" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo "Transfer"; ?></p>
			</div> 
			<div style="padding: 7px;">
				<input style="margin-top:0;" name="email" type="text" class="input" placeholder="<?php echo "E-mail novog klijenta"; ?>" id="ki" /><br />
				<label id="titlex">
				 * <?php echo "Unesite e-mail novog klijenta"; ?>
				</label>
				<br />
				<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text205']; ?></button>
				<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form>

 
<?php
		if(isset($gps)) if($gps == "gp-server") {
?>
		<form action="serverprocess.php" method="POST" class="modal-ftppw" id="modal-ftppw">				
			<input type="hidden" name="task" value="server-ftppw" />
<?php
			if(isset($_GET['id'])) {
				$srvid = mysql_real_escape_string($_GET['id']);
?>
			<input type="hidden" name="serverid" value="<?php echo $srvid; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text227']; ?></p>
			</div> 
			<div style="padding: 7px;">
				<label id="titlex">
				 * <?php echo $jezik['text228']; ?>
				</label>
				<br />
				<button onclick="$.colorbox.close(); loading('Promena FTP ??ifre')" class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text218']; ?></button>
				<button onclick="$.colorbox.close()" class="btn btn-small btn-danger" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>				
			</div>
		</form> 
<?php
		}
?>
		<form action="process.php" method="POST" class="modal-tiketadd" id="modal-tiketadd" style="overflow: inherit;">				
			<input type="hidden" name="task" value="tiketadd" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text229']; ?></p>
			</div>  
			<table style="width: 100%;">
				<tr>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>
						<input style="margin-top:0;" name="naslov" type="text" class="input" id="ki" placeholder="<?php echo $jezik['text230']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text231']; ?>
						</label>
					</td>
					<td>
						<select name="server" rel="zem" style="max-width: 252px;">
<?php
						$klijent = query_fetch_assoc("SELECT * FROM `klijenti` WHERE `klijentid` = '".$_SESSION['klijentid']."'");
						$registrovan = strtotime($klijent['kreiran']);
						$vreme = strtotime(date("Y-m-d", time()));
						
						$serveri = mysql_query("SELECT s.id id, s.port port, s.name name, b.ip ip, s.box_id sboxid FROM serveri s, boxip b WHERE s.user_id = '".$_SESSION['klijentid']."' AND b.ipid = s.ip_id");
						
					    if (mysql_num_rows($serveri) > 0){
							
						while($row = mysql_fetch_array($serveri)) {
?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['ip'].":".$row['port']." - ".$row['name']; ?></option>
<?php
						}
						}else{
							echo "<option value=\"-1\"?>Bez servera.</option>";
						}
?>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text232']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td>
						<select name="vrsta" rel="zem" style="max-width: 252px;">
							<option value="1"><?php echo $jezik['text233']; ?></option>
							<option value="2"><?php echo $jezik['text234']; ?></option>
							<option value="3"><?php echo $jezik['text235']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text236']; ?>
						</label>
					</td>
					<td>
						<div style="width: 282px;"></div>					
						<select name="prioritet" rel="zem" style="max-width: 252px;">
							<option <?php if(($registrovan + 5184000) > time()) echo 'disabled '; ?>value="1"><?php echo $jezik['text237']; ?></option>
							<option value="2" selected="selected"><?php echo $jezik['text238']; ?></option>
							<option value="3"><?php echo $jezik['text239']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text240']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea rows="1" name="tiketodg" id="tiketnew"></textarea>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 0;">
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text241']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</td>
				</tr>
			</table> 
		</form> 
		
		<form action="serverprocess.php" method="POST" class="modal-admindd" id="modal-adminadd" style="overflow: inherit;">				
			<input type="hidden" name="task" value="adminadd" />
<?php
			if(isset($_GET['id'])) {
?>
			<input type="hidden" name="serverid" value="<?php echo $_GET['id']; ?>" />
<?php
			}
?>
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text242']; ?></p>
			</div>  
			<table style="width: 100%;">
				<tr>
					<th></th>
				</tr>
				<tr>
					<td>
						<select id="adminc" name="vrsta" rel="zem" style="max-width: 252px;">
							<option value="0" selected="selected" disabled><?php echo $jezik['text243']; ?> ...</option>
							<option value="1"><?php echo $jezik['text244']; ?></option>
							<option value="2"><?php echo $jezik['text245']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text246']; ?>
						</label>
					</td>
				</tr>	

				<tr id="steamid" style="display: none;">
					<td>
						<input style="margin-top:0;" name="steamid" type="text" class="input" id="ki" placeholder="<?php echo $jezik['text247']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text245']; ?>.
						</label>
					</td>
				</tr>
				<tr id="nicka" style="display: none;">
					<td>
						<input style="margin-top:0;" name="nick" type="text" class="input" id="ki" placeholder="<?php echo $jezik['text248']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text248']; ?>.
						</label>
					</td>
				</tr>
				<tr id="nickp" style="display: none;">
					<td>
						<input style="margin-top:0;" name="sifra" type="password" class="input" id="ki" placeholder="<?php echo $jezik['text249']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text249']; ?>.
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<select id="asdvrsta" name="vrsta_admina" rel="zem" style="max-width: 252px;">
							<option value="1"><?php echo $jezik['text250']; ?></option>
							<option value="2"><?php echo $jezik['text251']; ?></option>
							<option value="3"><?php echo $jezik['text252']; ?></option>
							<option value="4"><?php echo $jezik['text253']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text254']; ?>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<input style="margin-top:0;" name="komentar" type="text" class="input asdkoment" id="ki" placeholder="<?php echo $jezik['text255']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text255']; ?>.
						</label>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 0;">
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text256']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</td>
				</tr>
				</div>
			</table> 
		</form> 	
		
		<form action="process.php" method="POST" class="modal-bugreport" id="modal-bugreport" style="overflow: inherit;">				
			<input type="hidden" name="task" value="bugreport" />
			<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
			<div class="hdr">
				<p class="naslov"><i class="icon-user"></i> <?php echo $jezik['text257']; ?></p>
			</div>  
			<table style="width: 100%;">
				<tr>
					<th width="50%"></th>
					<th width="50%"></th>
				</tr>
				<tr style="vertical-align: top;">
					<td>
						<input style="margin-top:0;" name="naslov" type="text" class="input" id="ki" placeholder="<?php echo $jezik['text258']; ?>" /><br />
						<label id="titlex">
						*<?php echo $jezik['text258']; ?>.
						</label>
					</td>
					<td>					
						<select name="vrsta" rel="zem" style="max-width: 252px;">
							<option value="1"><?php echo $jezik['text259']; ?></option>
							<option value="2"><?php echo $jezik['text260']; ?></option>
						</select>
						<label id="titlex">
						*<?php echo $jezik['text261']; ?>
						</label>                           	
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea rows="1" name="text" id="bugrep"></textarea><br />
						<label id="titlex">
						*<?php echo $jezik['text262']; ?>
						</label> 
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 0;"> 				
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text263']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</td>
				</tr>
			</table> 
		</form> 		

		<form action="process.php" method="post" class="modal-avatar" id="modal-avatar" enctype="multipart/form-data">	
<?php		$avatar = query_fetch_assoc("SELECT `avatar` FROM `klijenti` WHERE `klijentid` = '".$_SESSION['klijentid']."'");	?>
			<input type="hidden" name="task" value="edit_avatar" />
			<div class="hdr">
				<p class="naslov"><i class="icon-exchange"></i> <?php echo $jezik['text264']; ?></p>
			</div>  
			<div id="promenaavatara">
				<div id="avatar">
					<div id="avat">
						<?php echo avatar($_SESSION['klijentid']); ?>
					</div>
				</div>				
				<div id="edit_ad">
					<input type="file" name="avatar">
					<p id="h0">* <?php echo $jezik['text265']; ?>: <z>2mb</z></p>
					<p id="h0">* <?php echo $jezik['text266']; ?>: <z>150x150</z></p>
					<p id="h0">* <?php echo $jezik['text267']; ?>: <z>50x50</z></p>
					<p id="h0">* <?php echo $jezik['text268']; ?>: <z>png</z>, <z>jpg</z>, <z>jpeg</z>, <z>gif</z>, <z>bmp</z></p>
					<div style="float: right; width: auto; height: auto; margin-top: 8px;">
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text215']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</div>								
				</div>			
			</div>
		</form> 
<?php
		if($return == "profil.php" || $return == "ucp.php") {
?>
		<form action="process.php" method="post" class="modal-cover" id="modal-cover">	
			<input type="hidden" name="task" value="edit_cover" />
			<div class="hdr">
				<p class="naslov"><i class="icon-exchange"></i> <?php echo $jezik['text264']; ?></p>
			</div>  
			<div id="coverchange">
				<div id="avatar">
					<div id="avat">
						<img src="./avatari/covers/<?php echo $cover; ?>" id="edit_avatar" alt="Image for Profile">
					</div>
				</div><br />			
				<div id="edit_ad">
					<input type="file" name="cover" id="edit_avataru">
					<p id="h0">* <?php echo $jezik['text265']; ?>: <z>4mb</z></p>
					<p id="h0">* <?php echo $jezik['text266']; ?>: <z>150x150</z></p>
					<p id="h0">* <?php echo $jezik['text267']; ?>: <z>50x50</z></p>
					<p id="h0">* <?php echo $jezik['text268']; ?>: <z>png</z>, <z>jpg</z>, <z>jpeg</z>, <z>gif</z>, <z>bmp</z></p>
					<div style="float: right; width: auto; height: auto; margin-top: 8px; margin-bottom: 5px">
						<button class="btn btn-small btn-warning" type="submit"><i class="icon-exchange"></i> <?php echo $jezik['text215']; ?></button>
						<button class="btn btn-small btn-danger" onclick="$.colorbox.close()" type="button"><i class="icon-off"></i> <?php echo $jezik['text199']; ?></button>
					</div>								
				</div>			
			</div>
		</form>  
<?php	}
		}	?>		
	</div> <!-- modal END -->


	
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
	<script src="assets/<?php echo $_SESSION['style']; ?>/min/jquery.min.js"></script>
	<script>window.jQuery || document.write("<script src='assets/<?php echo $_SESSION['style']; ?>/min/jquery.min.js'>\x3C/script>")</script>

	<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<script type="text/javascript" src="assets/<?php echo $_SESSION['style']; ?>/min/?g=js"></script>
		<script src="assets/blue/js/livesearch.js"></script>
	

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>	
</body>
</html>
