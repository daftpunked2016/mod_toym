<h2 style="color:blue;">NOMINEE’S INFORMATION SHEET</h2>

<b>Last Name: </br> <?= $nominee->lastname; ?>
<br /><br />
<b>First Name: </br> <?= $nominee->firstname; ?>
<br /><br />
<b>Middle Name: </br> <?= $nominee->middlename; ?>
<br /><br />
<b>Title: </br> <?= $nominee->title; ?>
<br /><br />
<b>Name To Appear On Trophy: </br> <?= $nominee->name_on_trophy; ?>
<br /><br />
<b>Phonetic Pronunciation: </br> <?= $nominee->phonetic_pronunciation; ?>
<br /><br />
<b>Email: </br> <?= $nominee->email; ?>
<br /><br />
<b>Profession: </br> <?= $nominee->profession; ?>
<br /><br />
<b>Position: </br> <?= $nominee->position; ?>
<br /><br />
<b>Citizenship: </br> <?= $nominee_info->citizenship; ?>
<br /><br />
<b>Civil Status: </br> <?= $nominee_info->getCivilStatus(); ?>
<br /><br /> 
<b>Gender: </br> <?= $nominee_info->getGender(); ?>
<br /><br />
<b>Date of Birth: </br> <?= date('F d, Y' ,strtotime($nominee_info->birthdate)); ?>
<br /><br />
<b>Place of Birth: </br> <?= $nominee_info->birthplace; ?>
<br /><br />
<b>Home Address: </br> <?= $nominee_info->home_address; ?>
<br /><br />
<b>Province: </br> <?= $nominee_info->province; ?>
<br /><br />
<b>City: </br> <?= $nominee_info->city; ?>
<br /><br />
<b>Country: </br> <?= $nominee_info->country; ?>
<br /><br /> 
<b>Home Telephone: </br> <?= $nominee_info->home_telephone; ?>
<br /><br />
<b>Mobile No: </br> <?= $nominee_info->mobile_no; ?>
<br /><br />
<b>Spouse Name: </br> <?= $nominee_info->spouse_name; ?>
<br /><br />
<b>Children Name: </br> <?= str_replace(',',', ', $nominee_info->children_name); ?>
<br /><br /> 
