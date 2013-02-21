<?php 
	if(!defined("PH_VER")){ die(); }	
	$blogCategories = $ph->database->getTable("blog_categories");
	$subView = $ph->url->viewRequest(4);
?>

<?php if($subView): ?>
	<?php 

		$item = $ph->database->getRow("blog_categories", $subView);
		if($item){
			$ph->admin->loadSubView("blog/manage-category", $item);
		}else{
			$ph->admin->loadSubView("404");
		}
	 ?>

<?php else: ?>


<div id="manage-categories-container">
	<div class="container">
		<div class="row">
			<div class="span12">

				<div class="page-header">
					<h1>Manage categories<small>Overview of all existing blog categories.</small></h1>
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
						<?php if($blogCategories): ?>

							<!-- loop trough the blog items -->
							<?php foreach ($blogCategories as $category): ?>
								<tr>
									<td class="span1">
										<?php echo $category["id"];?>
									</td>
									<td>
										<?php echo $category["title"];?>
									</td>
									<td class="span1">
										<a href="<?php $ph->admin->href("blog/categories/" . $category["id"]); ?>" class="btn btn-success btn-small">edit</a>
									</td>
									<td class="span1">
										<form method="post" action="">
											<button name="delete_category" type="submit" class="btn btn-danger btn-small" value="<?php echo $category["title"] ?>">delete</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							<!-- end loop -->

						<!-- if no blog items found return this -->
						<?php else: ?>
								<tr class="info">
									<td colspan="4">
										There are currently no blog categories!
									</td>
								</tr>
						<?php endif; ?>

						</tbody>
					</table>
					<hr class="soft">
				</div>
			</div>
		</div>
	</div>
</div>


<?php endif; ?>
