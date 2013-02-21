<?php 
	if(!defined("PH_VER")){ die(); }	
	$portfolioCategories = $ph->database->getTable("portfolio_categories");
	$subView = $ph->url->viewRequest(4);
?>

<?php if($subView): ?>
	<?php 

		$item = $ph->database->getRow("portfolio_categories", $subView);
		if($item){
			$ph->admin->loadSubView("portfolio/manage-category", $item);
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
					<h1>Manage categories<small>Overview of all existing portfolio categories.</small></h1>
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
						<!-- if portfolio items found in database -->
						<?php if($portfolioCategories): ?>

							<!-- loop trough the portfolio items -->
							<?php foreach ($portfolioCategories as $category): ?>
								<tr>
									<td class="span1">
										<?php echo $category["id"];?>
									</td>
									<td>
										<?php echo $category["title"];?>
									</td>
									<td class="span1">
										<a href="<?php $ph->admin->href("portfolio/categories/" . $category["id"]); ?>" class="btn btn-success btn-small">edit</a>
									</td>
									<td class="span1">
										<form method="post" action="">
											<button name="delete_category" type="submit" class="btn btn-danger btn-small" value="<?php echo $category["title"] ?>">delete</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							<!-- end loop -->

						<!-- if no portfolio items found return this -->
						<?php else: ?>
								<tr class="info">
									<td colspan="4">
										There are currently no portfolio categories!
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
