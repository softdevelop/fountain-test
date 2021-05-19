<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="content">
	<h1>List tables</h1>
	<hr>
	<?php if(count($this->tables)) { ?>
		<ol>
		<?php foreach($this->tables as $table) { ?>
			<li><a href="<?php echo html_helpers::url(['ctl'=>'tables', 'act'=>'getfields', 'params'=>['table'=>$table]]); ?>"><?php echo $table ?></a></li>
		<?php } ?>
		</ol>
	<?php } else {?>
		<p> There are no table added, please <a href="<?php echo html_helpers::url(['ctl'=>'tables', 'act'=>'create']); ?>">click here</a> to add 2 tables <strong>users</strong> & <strong>user_activity</strong> </p>
	<?php } ?>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
