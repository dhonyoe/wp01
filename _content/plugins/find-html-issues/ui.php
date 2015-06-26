<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	/*
	require_once '../find-html-issues.php';
	$curl = new cfunctions();
	$fhi->get_post_data($curl);
	*/
}

?>
<form action="admin.php?page=find-html-issues/ui.php" method="POST">
	<input type="text" name="url" placeholder="Enter URL here" />
	<br />
	<input type="submit" name="submit" />
</form>

<?php
if(isset($array)) {
	pr($array);
}
