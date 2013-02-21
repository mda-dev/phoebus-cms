<?php 
    // deny any direct access to the file
    if(!defined("PH_VER")){ die(); }
    $blogPosts      = null ;//$ph->database->getTable("blog", "DESC");
    $portfolioItems = $ph->database->getTable("portfolio", "DESC");
    $mediaGalleries = $ph->database->getTable("galleries");
?>

<div id="hero-container" class="full">
    <div class="container">

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit">
            <h1>Phoebus</h1>
            <p>Sleek, intuitive, and powerful front-end framework for faster and easier web development.</p>
            <p>
                <a href="#" class="btn btn-ph btn-large">Download Phoebus</a>
            </p>

            <ul class="hero-links unstyled inline">
                <li>
                    <a href="#" >GitHub project</a>
                </li>
                <li>
                    <a href="#" >Examples</a>
                </li>
                <li>
                    <a href="#" >Extend</a>
                </li>
                <li>
                    Version 1.0
                </li>
            </ul>
        </div>

    </div>
</div>

<div class="social-container full">
    <div class="container">

                <ul id="social-links" class="unstyled inline">
                    <li>
                        <a href="#" title="Subscribe to or RSS feed!">
                            <span class="icon icon-rss-cube"></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" title="Digg us!">
                            <span class="icon icon-digg-square"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Like us on Facebook!">
                            <span class="icon icon-facebook-logo-square"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Follow us on Twitter!">
                            <span class="icon icon-twitter-logo-square"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Subscribe to us on YouTube">
                            <span class="icon icon-youtube"></span>
                        </a>
                    </li>
                </ul>

    </div>

</div>

<div id="blog-container">
    <div class="container">
        <?php if($blogPosts): ?>
        <?php $blogCount = count($blogPosts);
            $spanType = "span4";
            if($blogCount < 3){
                $spanType = "span" . (12 / $blogCount); 
            }?>
           
            <div class="row">
                <div class="span12 page-header">
                    <h1>Latest Blog Posts</h1>
                </div>
                <?php foreach ($blogPosts as $key => $post):?>
                    <?php if($key == 6){ break;} ?>
                    <div class="<?php echo $spanType ?>">
                        <div class="thumbnail stack">
                            <a href="http://placekitten.com/750/350?image=<?php echo rand(0,2) ?>" data-type="colorbox" target="_blank">
                                <img src="http://placekitten.com/750/350?image=<?php echo rand(0,2) ?>" alt="<?php echo $post["title"] ?>">
                            </a>
                            <div class="caption">
                                <h3><?php echo $post["title"]?></h3>
                                <div>
                                    <?php echo $ph->justExerp($post["content"]) ?>
                                </div>
                                <p>
                                    <a href="<?php echo $ph->href("blog/". $post["slug"]) ?>/" class="btn">View Post &raquo;</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>      
        <?php endif;?>
    </div> <!-- /container -->
</div>

<div id="portfolio-container">
    <div class="container">
        <div class="row">
            <?php if($portfolioItems):?>
            <?php $portfolioCount = count($portfolioItems);
                $spanType = "span4";
                if($portfolioCount < 3){
                    $spanType = "span" . (12 / $blogCount); 
                } ?>
                <div class="span12 page-header">
                    <h1>Latest Projects</h1>
                </div> 

                <div id="portfolio-content" class="span12">    
                    <ul class="thumbnails portfolio-grid clearfix slide-up-boxes">
                        <?php if($portfolioItems): ?>
                            <?php foreach($portfolioItems as $item): ?>

                            <?php 
                                $image = $ph->template->firstImage($item["gallery_rel"], $mediaGalleries);
                                $categs = unserialize($item["categ_rel"]);
                                $class = "";
                                if($categs){
                                 foreach ($categs as $value) {
                                    $class .= "i" . $value["id"] . " ";
                                 }
                             }
                            ?>

                             <li class="p-item <?php echo $class ?>">
                                <div class="thumbnail block">
                                    <a data-type="colorbox" target="_blank" href="<?php $ph->media->imageHref($image) ?>">
                                        <img src="<?php $ph->media->thumbHref($image) ?>">
                                        <span class="zoom"></span>
                                    </a>

                                    <a class="slide-up-box no-ajax" href="<?php $ph->href("portfolio/". $item["slug"]) ?>">
                                        <h3>more</h3>
                                        <div class="cealfix">
                                            <h4><?php echo $item["title"] ?> <small>view project &raquo;</small></h4>
                                            <p class="view-proj">
                                                                     
                                            </p>
                                        </div>               
                                    </a>
                                </div>
                             </li>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>