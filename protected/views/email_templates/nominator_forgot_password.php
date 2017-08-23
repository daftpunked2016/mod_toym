<h4>Hi <?= $nominator->getFullName(); ?>, </h4>
<p>
	This message contains the link for your Nominator Account Password Reset request. 
	<b>Please contact the JCI Headquarters or Administrator Team if you did not request for a Password Reset.</b>
	Click this link to reset and change your password : <a href='http://jci.org.ph/2017TOYMmod/nominator/default/rstpwd?vc=<?= $hashedVlCode; ?>&ai=<?= $nominator->id; ?>'>TOYM Nominator Account Password Reset</a> <br /><br />
	Please always check your e-mail and keep yourself updated. Thank you!<br /><br />
	JCI Philippines
</p>