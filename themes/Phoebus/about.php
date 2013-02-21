<?php 
	// deny any direct access to the file
    if(!defined("PH_VER")){ die(); }
?>

<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
        	<h1>About Page <small>Subtext for header</small></h1>
        </div>

    </div>
</div>

<div class="container after-hero">
	<div class="row">
		<aside class="span3">
			<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li class="nav-header">Usefull links</li>
						<li><a href="<?php $ph->href("portfolio/")?>">View Portfolio</a></li>
						<li><a href="<?php $ph->href("resume/")?>">View Resume</a></li>
					</ul>
			</div>
		</aside>

		<div class="span9">
            <div class="well stack">
            	<h3>Hello,</h3>
            <img id="about-image" class="img-polaroid" src="http://placekitten.com/192/192?image=1" alt="">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vestibulum augue vel tellus mollis blandit. Vestibulum adipiscing varius sem ac posuere. Curabitur commodo nisl at orci porta ornare. Aenean molestie sapien varius neque ultricies a fermentum libero viverra. Nunc porttitor quam in augue elementum euismod. Pellentesque accumsan dictum malesuada. Aliquam erat volutpat. Donec convallis mattis mollis. Aenean elementum orci eu dolor volutpat dapibus. Integer lacinia porta lacus ac pellentesque. Fusce hendrerit laoreet gravida. Nam tincidunt, ipsum sed lacinia euismod, nisi felis molestie erat, in condimentum nisl lacus ut nisi. Cras ultricies, tellus sed placerat aliquam, nisl tortor rhoncus orci, ut bibendum massa lacus ut urna.</p>
                        
            <p>Proin tortor nibh, aliquet ac dictum dictum, bibendum vel arcu. Suspendisse accumsan porta ipsum a interdum. Suspendisse condimentum blandit mattis. Vivamus sed erat id nulla gravida aliquam eget a ligula. In a odio vel lectus convallis consectetur et id libero. Nunc et dictum nunc. Nunc a congue massa. Ut a lectus mi, vel imperdiet tellus.</p>
                        
            <p>Donec varius luctus pellentesque. In porta nisl in eros feugiat imperdiet. Nulla purus est, viverra cursus pharetra et, consequat lacinia leo. Morbi sit amet consectetur leo. Integer sodales, urna nec blandit scelerisque, leo purus pretium lacus, ut ultricies justo nibh sed eros. Donec ut justo sed magna suscipit ultrices a sed sapien. Proin eros purus, bibendum at viverra vitae, dictum ut massa. Aliquam tellus libero, bibendum non dignissim quis, faucibus et mauris. Quisque id erat mi. Nunc nec pharetra neque.</p>
            </div>
		</div>

		

	</div>

	<div id="about-skillset" class="row">
		<div class="page-header span12">
        	<h1>Skillset <small>Subtext for header</small></h1>
        </div>

		<div class="span4">
			<div class="well block">	
				<h3>
					<img src="http://placekitten.com/65/65" alt="#" class="img-polaroid">
					Skill 3
				</h3>
				<hr>
				<div>
					<p>
						<span class="highlight">Etiam et lorem eget lorem tristique </span>luctus a non augue. Donec posuere, enim sit amet auctor consectetur,
					lorem magna eleifend massa, sit amet cursus nunc lectus id urna. Donec sit amet purus eu metus pharetra vulputate.
					</p>
				</div>
			</div>
			
		</div>
		<div class="span4">
			<div class="well block">
				<h3>
					<img src="http://placekitten.com/65/65" alt="#" class="img-polaroid">
					Skill 3
				</h3>
				<hr>
				<div>
					<p>Etiam et lorem eget lorem tristique luctus a non augue. Donec posuere, enim sit amet auctor consectetur,
					lorem magna eleifend massa, sit amet cursus nunc lectus id urna. Donec sit amet purus eu metus pharetra vulputate.
					</p>
				</div>
			</div>
			
		</div>
		<div class="span4">
			<div class="well block">
				<h3>
					<img src="http://placekitten.com/65/65" alt="#" class="img-polaroid">
					Skill 3
				</h3>
				<hr>
				<div>
					<p>Etiam et lorem eget lorem tristique luctus a non augue. Donec posuere, enim sit amet auctor consectetur,
					lorem magna eleifend massa, sit amet cursus nunc lectus id urna. Donec sit amet purus eu metus pharetra vulputate.
					</p>
				</div>
			</div>
						
		</div>
	</div>
</div>