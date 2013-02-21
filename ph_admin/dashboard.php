<?php 
    if(!defined("PH_VER")){ die(); }
    global $ph;
    //nide new version notice
    //check for hidden-verstion-notice
    if(isset($_COOKIE["ph_hide_new_ver_notice"])){
        if($_COOKIE["ph_hide_new_ver_notice"] == "1.1"){
            $notice_is_visible = false;
        }else{
            $notice_is_visible = true;
        }
    }else{
        $notice_is_visible = true;
    }

    $userCount         = sprintf("%02s", count($ph->database->getTable("users")));
    $blogCount         = sprintf("%02s", count($ph->database->getTable("blog")));
    $blogCatCount      = sprintf("%02s", count($ph->database->getTable("blog_categories")));
    $mediaGalCount     = sprintf("%02s", count($ph->database->getTable("galleries")));
    $portfolioCount    = sprintf("%02s", count($ph->database->getTable("portfolio")));
    $portfolioCatCount = sprintf("%02s", count($ph->database->getTable("portfolio_categories")));
    $websiteTheme      = $ph->database->getRow("settings");
    $websiteTheme      = $websiteTheme["theme"];
    

   
?>


<div id="hero-container" class="full">
    <div class="container">
        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit" style="margin:0; position:relative;">

            <h2>Welcome to Phoebus dashboard! <?php echo $_SESSION["full_name"] ?></h2>

            <?php if($notice_is_visible): ?>
            <div id="hide-version-notice">
                <p>There is a new version of Phoebus CMS available for download.</p>
                <p>
                    <a href="#" class="btn btn-ph btn-large">Update Phoebus</a>
                </p>
            </div>
            <?php endif;?>

            <ul class="hero-links unstyled inline">
                <li>
                  <a href="#">Current</a>
                </li>
                <li>
                    Version 1.0
                </li>
                <li>
                    <a href="#">Available</a>
                </li>
                <li>
                    Version 1.1
                </li>
            </ul>

            <?php if($notice_is_visible): ?>
                <a id="ph-hide-notice" href="#1.1" class="btn btn-ph badge">Close this message</a>

            <?php endif;?>

        </div>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="span12">

            <div class="page-header">
            <h1>Dashboard <small>Website Overview</small></h1>
            </div>

            <p>
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Blog Posts</td>
                    <td><?php echo $blogCount; ?></td>
                </tr>
                <tr>
                    <td>Blog Categories</td>
                    <td><?php echo $blogCatCount; ?></td>
                </tr>
                <tr>
                    <td>Portfolio Enties</td>
                    <td><?php echo $portfolioCount; ?></td>
                </tr>
                <tr>
                    <td>Portfolio Categories</td>
                    <td><?php echo $portfolioCatCount; ?></td>
                </tr>
                <tr>
                    <td>Media Galleries</td>
                    <td><?php echo $mediaGalCount; ?></td>
                </tr>
                <tr>
                    <td>Staff Members</td>
                    <td><?php echo $userCount; ?></td>
                </tr>
                <tr>
                    <td>Website Address</td>
                    <td><a href="<?php $ph->href(); ?>" target="_blank"><?php echo $ph->href(); ?></a></td>
                </tr>
                <tr>
                    <td>Website Theme</td>
                    <td><?php echo $websiteTheme; ?></td>
                </tr>

            </table>

            </p>
        </div>
    </div>

    <hr>

</div> <!-- /container -->

