<header style="margin:20px;">
	<!-- Build Crumbs -->
	<?php foreach($crumbs as $crumb):?>
	  <a href='?controller=folder&action=show&id=<?= $crumb->id; ?>'><?= $crumb->name; ?></a> > 
  <?php endforeach;?>
  <!-- Current Folder -->
  <a href='?controller=folder&action=show&id=<?= $data['current']->id;?>'><?= $data['current']->name;?></a>
</header>

<table border="1px" cellpadding="5px">
	<tr>
		<th>Name</th>
		<th>Created</th>
		<th>Directory</th>
	</tr>
	<tr>
		<td>
			<a href='?controller=folder&action=show&id=<?php echo $data['current']->id; ?>'>
	    	.
	    </a>
		</td>
		<td>
			<?php echo $data['current']->created; ?>
		</td>
		<td>
			<input type="checkbox" checked>
		</td>
	</tr>
	<?php if($data['current']->parent_id):?>
	<tr>
		<td>
			<a href='?controller=folder&action=show&id=<?php echo $data['current']->parent_id; ?>'>
	    	..
	    </a>
		</td>
		<td>
			<?php echo $data['current']->created; ?>
		</td>
		<td>
			<input type="checkbox" checked>
		</td>
	</tr>
	<?php endif;?>
	<?php foreach($data['folders'] as $folder): ?>
		<tr>
			<td>
				<a href='?controller=folder&action=show&id=<?php echo $folder->id; ?>'>
		    	<?php echo $folder->name; ?>
		    </a>
			</td>
			<td>
				<?php echo $folder->created; ?>
			</td>
			<td>
				<input type="checkbox" checked>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php foreach($data['files'] as $file): ?>
		<tr>
			<td>
		    <?php echo $file->name; ?>
			</td>
			<td>
				<?php echo $file->created; ?>
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
	<?php endforeach; ?>
</table>

