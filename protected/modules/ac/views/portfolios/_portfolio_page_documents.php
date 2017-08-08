<h2 style="color:blue;">RELATED DOCUMENTS</h2>
<br /><br /> 

<?php if($portfolio->photograph_upload_id != ""): ?>
<b>Photograph (Head & Shoulder)</b>
<br /><br />
	<div style="text-align: center">
		<img src="<?= ToymFileUploads::getFilePath($portfolio->photograph_upload_id); ?>" height="550px" style="margin: auto;"></img>
	</div>
<?php endif; ?>
<?php if($portfolio->id_birth_cert_upload_id != ""):?>
<?php $file = ToymFileUploads::model()->findByPk($portfolio->id_birth_cert_upload_id); ?>
<br /><br /> 
<b>ID/Birth Certificate -> <i> <?= (strtolower($file->file_extension) == "pdf") ? "(This PDF file must be downloaded separately in the Portfolios Listing page)" : "Next Page" ?> </i></b>
<?php endif; ?>
<?php if($portfolio->nbi_clearance_upload_id != ""): ?>
<?php $file = ToymFileUploads::model()->findByPk($portfolio->nbi_clearance_upload_id); ?>
<br /><br /> 
<b>NBI Clearance -> <i><?= (strtolower($file->file_extension) == "pdf") ? "(This PDF File must be downloaded separately in the Portfolios Listing page)" : "(Next Page)" ?></i></b>
<?php endif; ?>
