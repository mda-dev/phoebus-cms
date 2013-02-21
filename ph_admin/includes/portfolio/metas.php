<?php 
	if(!defined("PH_VER")){ die(); }
	global $ph;

	$subView = $ph->url->viewRequest(4);

	//portfolio Metas
	$portfolioMetas = $ph->database->getTable("portfolio_metas");
?>

<?php if($subView): ?>
	<?php 

		$item = $ph->database->getRow("portfolio_metas", $subView);
		if($item){
			$ph->admin->loadSubView("portfolio/manage-meta", $item);
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
					<h1>Manage metas<small>Overview of all existing portfolio metas.</small></h1>
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
						<?php if($portfolioMetas): ?>

							<!-- loop trough the portfolio items -->
							<?php foreach ($portfolioMetas as $item): ?>
								<tr>
									<td class="span1">
										<?php echo $item["id"];?>
									</td>
									<td>
										<?php echo $item["title"];?>
									</td>
									<td class="span1">
										<a href="<?php $ph->admin->href("portfolio/metas/" . $item["id"]); ?>" class="btn btn-success btn-small">edit</a>
									</td>
									<td class="span1">
										<form method="POST" action="">
											<button name="delete_meta" type="submit" class="btn btn-danger btn-small" value="<?php echo $item["title"] ?>">delete</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							<!-- end loop -->

						<!-- if no portfolio items found return this -->
						<?php else: ?>
								<tr class="info">
									<td colspan="4">
										There are currently no portfolio metas!
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

