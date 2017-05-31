<h4>Hi <?= $nominee->title; ?> <?= $nominee->getFullName(); ?>, </h4>
<p>
	You have been nominated by <b><?= $nominee->nominator->getFullName(); ?></b> for the JCI Philippines TOYM . 
	We'll send you another e-mail notification together with your Nominee Log-in Credentials if your nomination has been approved successfully. 
	<br />
	Thank you and good luck!
</p>