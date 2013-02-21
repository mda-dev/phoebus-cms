<?php 
	if(!defined("PH_VER")){ die(); }
	global $ph;

	$subView = $ph->url->viewRequest(4);

	//Blog Items
	$blogItems = $ph->database->getTable("blog");
?>

<?php if($subView): ?>
	<?php 

		$item = $ph->database->getRow("blog", $subView);
		if($item){
			$ph->admin->loadSubView("blog/manage-post", $item);
		}else{
			$ph->admin->loadSubView("404");
		}
	 ?>

<?php else: ?>

<div id="manage-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Manage posts<small>Overview of all existing blog posts.</small></h1>
				</div>
				<div>
					<table id="manage" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#id</th>
								<th>title</th>
								<th colspan="2" class="action">action</th>
							</tr>
						</thead>
						<tbody>
						<!-- if blog items found in database -->
						<?php if($blogItems): ?>

							<!-- loop trough the blog items -->
							<?php foreach ($blogItems as $item): ?>
								<tr>
									<td class="span1">
										<?php echo $item["id"];?>
									</td>
									<td>
										<?php echo $item["title"];?>
									</td>
									<td class="span1">
										<a href="<?php $ph->admin->href("blog/posts/" . $item["id"]); ?>" class="btn btn-success btn-small">edit</a>
									</td>
									<td class="span1">
										<form method="post" action="">
											<button name="delete_post" type="submit" class="btn btn-danger btn-small" value="<?php echo $item["title"] ?>">delete</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							<!-- end loop -->

						<!-- if no blog items found return this -->
						<?php else: ?>
								<tr class="info">
									<td colspan="4">
										There are currently no blog posts !
									</td>
								</tr>
						<?php endif; ?>

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>



<?php endif; ?>

