<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">
<head>
	<title><?php print $head_title ?></title>
	<meta name="author" content="Arizona Student Unions Marketing" />
    <style type="text/css" media="all">@import "/intra/themes/ua_banner1/blue.css";</style>	<?php print $head ?>
	<?php print $styles ?>
	<?php print $scripts ?>
	<script type="text/javascript"> <!-- FOUC Fix ( not needed if loading ie-hack.css --> </script>
</head>

<body>
<div id="header_blue"><a href="http://arizona.edu"><img src="<?php print $base_path 
?>/themes/ua_banner1/images/banner-lblue.gif" alt="The 
University of Arizona" /></a></div>


        <?php if ($logo): ?>
        <div id="dept_banner">
          <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" 
class="dept_logo" />
          </a>
       </div> 
       <?php endif; ?>
	<div id="page" class="<?php if ($sidebar_left || $sidebar_right) { print "one-sidebar"; } if ($sidebar_right && $sidebar_left) { print " two-sidebars"; }?>">		

		<div id="container" class="<?php if ($sidebar_left) { print "withleft"; } if ($sidebar_right) { print " withright"; }?> clear-block">
			<div id="main-wrapper">
				
				
				<div id="main" class="clear-block">
				
				
					<?php print $breadcrumb ?>
					<?php if ($mission): ?><div id="mission"><?php print $mission ?></div><?php endif; ?>
					<?php if ($content_top):?><div id="content-top"><?php print $content_top ?></div><?php endif; ?>
					<?php if ($title): ?><h1 class="title"><?php print $title ?></h1><?php endif; ?>
					<?php if ($tabs): ?><div class="tabs"><?php print $tabs ?></div><?php endif; ?>
					<?php print $help ?>
					<?php print $messages ?>
					<?php print $content ?>
					<?php if ($content_bottom): ?><div id="content-bottom"><?php print $content_bottom ?></div><?php endif; ?>
				
			
				</div>
			</div>
			

			<?php if ($sidebar_left): ?>
				<div id="left" class="sidebar">
					<?php print $sidebar_left ?>
				</div>
			<?php endif; ?>  

			<?php if ($sidebar_right): ?>
				<div id="right" class="sidebar">
					<?php print $sidebar_right ?>
				</div>
			<?php endif; ?>
</div>			
</div>
<!--
</div>
</div> -->
	
			<?php if ($secondary_links): ?>
		<div id="secondary" class="clear-block">
					<?php print theme('links', $secondary_links) ?>
		<?php endif; ?>


<div id="footer">
<h4 class="footer_logo"><a
href="http://www.arizona.edu/"> <img
src="<?php print base_path(); ?>/themes/ua_banner1/images/footer_link.gif" alt="The
University of Arizona" /></a></h4>
<br />
<p>
<?php print $footer_message ?>
</p>
</div>
		<?php print $closure ?>
<!--</div>-->
</body>
</html>
