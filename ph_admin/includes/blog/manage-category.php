<?php 
	if(!defined("PH_VER")){die();}
?>

<div id="manage-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Edit category: <?php echo $title ?><small>Update specific blog gategory</small></h1>
				</div>
				<div>
					<form class="form-horizontal" method="post" action="">
						<div class="control-group">
							<label class="control-label" for="category_title">Title</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-align-right"></i></span>
									<input id="category_title" name="category_title" class="span4" type="text"  placeholder="Category title..." value="<?php echo $title ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category_slug">Slug</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-tag"></i></span>
									<input id="category_slug" name="category_slug" class="span4" type="text"  placeholder="Category slug..." value="<?php echo $slug?>">
								</div>
							</div>
						</div>

						<div class="control-group">
							<label  class="control-label"></label>
							<div class="controls">
								<button class="btn btn-ph" type="submit" name="edit_category" value="<?php echo $id ?>" >save changes</button>
							</div>
						</div>
					</form>
				</div>
				<hr class="soft">
			</div>
		</div>
	</div>
</div>