<p>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/images/toym_portfolio.png"></img>
</p>

<p style="text-align:center; color:blue;"> 
	<h2><?= strtoupper($nominee->getFullName(true, true)); ?></h2>
</p>

<br />
<br />
<br />
<br />

<p style="text-align:center"> 
	<h2><?= strtoupper($nominee->category->catname); ?></h2>
	<h3><?= strtoupper($nominee->subcategory->catdesc); ?></h3>
</p>

<br />
<br />

<p style="text-align:center"> 
	<h4>Nominated by:</h4>
	<h3 style="color:blue;">
		<?= strtoupper($nominator->chapter->chapter.'*'); ?>
		<br />

	<?php
		$other_endorsing_chapters = ($nominator->additional_endorsing_chapter == NULL) ? [] : json_decode($nominator->additional_endorsing_chapter);
		
		foreach($other_endorsing_chapters AS $chapter) {
			echo strtoupper($chapters_indexed[$chapter])."<br />";
		} 
	?>
	</h3>
</p>