<?php if(!defined("PH_VER")){die();}?>
<?php 

if(isset($_GET["for"])){
	$searchResults = $ph->database->searchWebsite("portfolio", $_GET["for"]);

	var_dump($searchResults);
}

	
	


?>
<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
            <h1>Search the website <small>Looking for something specific? Here is the place to do it.</small></h1>
        </div>

    </div>
</div>

<div id="search-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Manage entries<small>Overview of all existing portfolio posts.</small></h1>
				</div>


				<form class="form-horizontal" method="get">
					<div class="control-group">
						<label class="control-label" for="search">What to search for?</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-search"></i></span>
								<input id="search" name="for" class="span4" type="text"  placeholder="Enter keywords..." value="">
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="search">Where to search?</label>
						<div class="controls">
							<label class="checkbox">
								<input name="portfolio" type="checkbox" value=true >
								Portfolio
							</label>
						</div>
						<div class="controls">
							<label class="checkbox">
								<input name="blog" type="checkbox" value=true >
								Blog
							</label>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" class="btn btn-ph" value="Search" >
						</div>
					</div>

				</form>

			</div>

			<div class="span12">
				
			</div>
		</div>
	</div>
</div>