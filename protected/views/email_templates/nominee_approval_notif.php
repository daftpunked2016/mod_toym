<p>
	Thank you <b><?= $nominee->nominator->getFullName();?></b> for completing the Nomination Form.
</p>
<p> 
	We’re happy to inform you that your nomination for <b><?= $nominee->getFullName(); ?></b> has been confirmed.
</p>
<p>
	You may access your TOYM Panel to complete the other requirements.
</p>
<br />
<p>
For Nominator:<br />
Web Address: <a href="http://toym.jci.org.ph/nominator">toym.jci.org.ph/nominator/</a><br />
Username: <i><b><?= $nominee->nominator->email; ?></b></i><br />
Password: <i>< use the password you indicated ></i>
</p>
<?php if($nominee->nominator->is_jci_member == 1): ?>
<p>
	For username and password, use your myjcip login credentials
</p>
<?php endif; ?>
<br />
<p>
For Nominee:
Web Address: <a href="http://toym.jci.org.ph/nominee">toym.jci.org.ph/nominee/</a><br />
Username: <i><b><?= $nominee->email; ?></i></b><br />
Password: <i><b><?= $nominee->temp_password; ?></i></b>
</p>
<br />
<p>
Both nominator and nominee can access the nomination record. Complete the necessary details:<br/>
- Information Sheet<br />
- Portfolio Building (Pages 1 - 3)<br />
</p>
<p>
Deadline of submission will be on <b>August 30, 2017 </b>
</p> 
<p>
For more information, please contact:<br />
Ms. Nancy Faith De Jesus<br />
TOYM Secretariat<br />
(02)-3744138<br />
(0919)-9315182.<br />
</p>
<br />
<b>2017 TOYM TEAM</b>