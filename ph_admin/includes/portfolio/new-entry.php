<?php 
	if(!defined("PH_VER")){die();}
	$portfolioCategories = $ph->database->getTable("portfolio_categories");
	$portfolioMetas = $ph->database->getTable("portfolio_metas");
?>
<div id="new-entry-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>New entry<small>Create a new portfolio entry</small></h1>
				</div>
				<form class="form-horizontal" method="POST" action="">
					<div class="control-group">
						<label class="control-label" for="entry_title">Title</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-align-right"></i></span>
								<input id="entry_title" name="entry_title" class="span4" type="text"  placeholder="Entry title...">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label  class="control-label" for="entry_slug">Slug</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-tag"></i></span>
								<input id="entry_slug" name="entry_slug" class="span4" type="text" placeholder="Entry slug...">
							</div>
						</div>
					</div>

					<?php if($portfolioMetas):?>
					<div class="control-group">
						<label  class="control-label">Meta fileds</label>
						<div class="controls">
							<ul class="unstyled">
							<?php foreach ($portfolioMetas as $meta): ?>
									<li class="control-group">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-list"></i></span>
											<input id="entry_meta" name="entry_meta[][<?php echo $meta['id']?>]" class="span4" type="text" placeholder="<?php echo $meta["title"]?>...">
										</div>
									</li>
							<?php endforeach;?>
							</ul>
						</div>
					</div>
					<?php endif?>

					<div class="control-group">
						<label class="control-label" >Category</label>
						<div class="controls">
							<div class="">
								<ul id="cat-list" class="unstyled inline span6">
								<?php if($portfolioCategories): ?>

									<?php foreach ($portfolioCategories as $key => $category): ?>
										<li>
												<label class="btn">
													<input value="<?php echo $category["id"]; ?>" name="entry_category[][id]" type="checkbox"> <?php echo $category["title"]?>
												</label>
										</li>
									<?php endforeach; ?>

								<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label" for="entry_gallery">Gallery</label>
						<div class="controls">
							<select id="entry_gallery" name="entry_gallery" class="span4">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
					</div>


					<div class="control-group">
						<label  class="control-label" for="entry_content">Content</label>
						<div class="controls">
							<textarea id="entry_content" name="entry_content" class="span5" rows="10" placeholder="Entry content Goes in gere"></textarea>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label"></label>
						<div class="controls">

							<button class="btn btn-ph" type="submit" name="new_entry" value="save" >create entry</button>

						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>