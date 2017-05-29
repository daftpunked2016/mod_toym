<h4>Hi <?= $nominee->title; ?> <?= $nominee->getFullName(); ?>, </h4>
<p>
	Your nomination has been approved by your Area Chair and the National Chair. 
	You can now proceed and log-in your account to update your Profile Information and start building your Portfolio.
</p>
<p>
	Please use the following credentials for your Nominee Account Log-in: 
	<br />
	<b>TOYM Nominee Log-in URL:</b> <i><a href="<?= Yii::app()->baseUrl; ?>/<?= Yii::app()->createUrl("nominee/default/login"); ?>"><?= Yii::app()->createUrl("nominee/default/login"); ?></a></i> <br />
	<b>Username:</b> <i><?= $nominee->email; ?></i><br />
	<b>Password:</b> <i><?= $nominee->temp_password; ?></i><br />
</p>
<br />
<p>
	<i>
		<b>NOTE:</b> After you have logged-in your account, you must change the temporary password immediately.
		To do this, click your <b>Name</b> in the top right side of the page and click the <b>Change Password</b> link in the dropdown menu that have appeared.
	</i>
</p>