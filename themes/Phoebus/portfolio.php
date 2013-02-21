<?php
    // deny any direct access to the file
    if(!defined("PH_VER")){ die(); }

    $subView = $ph->url->viewRequest(2);

if($subView):

        $item = $ph->database->getRow("portfolio", $subView);

    if($item){
        $ph->template->loadSubView("portfolio-single", $item);
    }else{
        $ph->template->loadView("404");
    } 

    else:
    $portfolioItems  = $ph->database->getTable("portfolio");
    $portfolioCategs = $ph->database->getTable("portfolio_categories");
    $mediaGalleries = $ph->database->getTable("galleries");
    //var_dump($mediaGalleries);

     


    function itemCategories($allCategories, $categoryRel){
        $categNames = array();
        foreach ($allCategories as $categ) {
           foreach ($categoryRel as $key => $v) {
                if($v["id"] == $categ["id"]){
                    array_push($categNames, $categ["title"]);
                }
           }
        }

        return implode(", ", $categNames);
    }
?>



<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
            <h1>Portfolio Page <small>Get yourself up to date with my work</small></h1>
        </div>

    </div>
</div>


<!-- start .ajax-container -->
<div id="ajax-container" class="">
    <div class="container">
        <div id="ajax-main" class="row" style="">

            <div id="ajax-hidden" class="span12 backdrop" style="">
                <!-- start first-row -->

                <div class="row" style="postion:relative">
                    <!-- start .ajax-sidebar -->
                    <div class="span4">
                        <div id="ajax-sidebar" class="ajax-padding">
                            <a id="ajax-close" class="close pull-left" href="#">&times;</a>
                            <div>


                            </div>
                            <!-- ajax-sidebar content here -->

                        </div>
                    </div><!-- #end ajax-sidebar -->


                    <!-- start ajax-carousel -->
                    <div class="span8">
                        <div id="ajax-slider-container" class="ajax-padding">
                            <!-- ajax-slider goes in here -->
                        </div>
                    </div><!-- #end ajax-arousel -->

                    <div class="span12">
                        <div id="ajax-content" class="ajax-padding">
                            <!--
                            ajax-content goes in here
                        -->
                    </div>
                </div>

            </div><!-- #end first-row -->
        </div>
    </div>
</div>
</div>


<!-- START PORTFOLIO CONTAINER -->
<div id="portfolio-container">

    <!-- filter container -->
    <div class="container">
        <div id="filter-wrapper" class="row hidden">
            <div id="filter-lable" class="span1">
                <h4>Filter:</h4>
            </div>
            <div class="span11">
                <ul id="filter-menu" class="breadcrumb">
                    <li class="active">
                        <a data-filter="*" href="#">All</a> <span class="divider">/</span>
                    </li>
                    <?php if($portfolioCategs):?>
                        <?php foreach ($portfolioCategs as $key => $category):?>
                        <li>
                            <a data-filter=".i<?php echo $category["id"]?>" href="#"><?php echo $category["title"] ?></a>
                            <?php 

                            if( $key !== (count($portfolioCategs)-1) ){
                                echo "<span class='divider'>/</span>";
                            }  
                            ?>
                        </li>
                        <?php endforeach?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- content container -->
    <div class="container">
        <div class="row">
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

                                <a class="slide-up-box" href="<?php $ph->href("portfolio/" . $item["slug"]) ?>/">
                                    <h3>more</h3>
                                    <div class="cealfix">
                                        <h4><?php echo $item["title"] ?> <small>view project &raquo;</small></h4>
                                        <p class="view-proj">
                                            <?php 
                                                echo itemCategories($portfolioCategs, $categs);
                                            ?> 
                                        </p>
                                    </div>               
                                </a>
                            </div>
                         </li>
                        <?php endforeach; ?>
                    <?php endif;?>
                </ul>
            </div>
        </div>        
    </div>
</div>

<?php endif; ?>