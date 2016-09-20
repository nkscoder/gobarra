<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CodeIgniter jQuery Powered JSON Search</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
	<script src="/js/script.js" type="text/javascript"></script>
</head>
<body>

<div id="container">

	<h1>CodeIgniter jQuery (+JSON) Search Suggestions</h1>

	<p>Harness the awesome power of CodeIgniter, JSON, &amp; jQuery to search through all US presidents!</p>

	<form method="post" action="<?php echo current_url(); ?>">
		<fieldset>
			<label for="search">Search Query:</label>
			<input type="text" name="search" id="search" />
			<input type="submit" value="Search!"/>
		</fieldset>
		<fieldset id="results">
			<?php if ( isset($results) AND count($results) ): ?>
				<ul>
					<?php foreach ($results as $result): ?>
						<li>
							<span class="name"><?php echo $result['full_name_highlighed']; ?></span> &ndash;
							<span class="bio"><?php echo $result['bio']; ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</fieldset>
	</form>
	
</div>

</body>
</html>