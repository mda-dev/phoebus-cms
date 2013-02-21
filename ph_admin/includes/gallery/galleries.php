<?php 
	if(!defined("PH_VER")){ die(); }	
	$mediaGalleries = $ph->database->getTable("galleries");
	$subView = $ph->url->viewRequest(4);
?>

<?php if($subView): ?>
	<?php 

		$item = $ph->database->getRow("galleries", $subView);
		if($item){
			$ph->admin->loadSubView("gallery/manage-gallery", $item);
		}else{
			$ph->admin->loadSubView("404");
		}
		//
	 ?>

<?php else: ?>


<div id="manage-categories-container">
	<div class="container">
		<div class="row">
			<div class="span12">

				<div class="page-header">
					<h1>Manage galleries<small>Overview of all existing media galleries.</small></h1>
				</div>
				<div>

					<table id="manage" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="span1">#id</th>
								<th>title</th>
								<th class="span1">items</th>
								<th class="span1" colspan="2" class="action">action</th>
							</tr>
						</thead>
						<tbody>
						<!-- if portfolio items found in database -->
						<?php if($mediaGalleries): ?>

							<!-- loop trough the portfolio items -->
							<?php foreach ($mediaGalleries as $gallery): ?>
								<tr>
									<td class="span1">
										<?php echo $gallery["id"];?>
									</td>
									<td>
										<?php echo $gallery["title"];?>
									</td>
									<td clasS="span1">
										<?php $count = sprintf("%02s", count(unserialize($gallery["items"]))); echo $count ?>
									</td>
									<td class="span1">
										<a href="<?php $ph->admin->href("gallery/galleries/" . $gallery["id"]); ?>" class="btn btn-success btn-small">edit</a>
									</td>
									<td class="span1">
										<form method="post" action="">
											<button name="delete_gallery" type="submit" class="btn btn-danger btn-small" value="<?php echo $gallery["title"] ?>">delete</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
							<!-- end loop -->

						<!-- if no portfolio items found return this -->
						<?php else: ?>
								<tr class="info">
									<td colspan="4">
										There are currently no media galleries!
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
