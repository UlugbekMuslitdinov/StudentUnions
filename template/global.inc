<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 0);
?>
<?php 
function page_start($page_options=NULL){ 
	if ($page_options == null){global $page_options;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132122543-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-132122543-2');
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <title><?php echo isset($page_options['title']) ? $page_options['title'] : 'Student Union'; ?></title>

    <?php
    if (is_array($page_options))
    {
    	echo ( array_key_exists('head', $page_options) ? $page_options['head'] : '' );
    }
    ?>

	<?php if(isset($page_options['ssheets'])){
                foreach($page_options['ssheets'] as $style_sheet){?>
    <link rel="StyleSheet" href="<?php print $style_sheet ?>" type="text/css" media="screen" />
    <?php }} ?>

    <?php if(isset($page_options['styles'])){ ?>
    <style type="text/css"><?php print $page_options['styles']; ?></style>

    <?php } ?>

    <?php if(isset($page_options['script_incs'])){
                foreach($page_options['script_incs'] as $script){?>
    <script type="text/javascript" src="<?php print $script ?>"></script>
    <?php }} ?>

    <?php if(isset($page_options['scripts'])){ ?>
    <script type="text/javascript">
        <?php print $page_options['scripts']; ?>
    </script>
    <?php } ?>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/template/common/css/mdb.min.css">

</head>

	<body <?php if(isset($page_options['onload'])){ print 'onload="'.$page_options['onload'].'"';} ?>>

		<!-- Vue -->
		<script type="text/javascript" src="/node_modules/vue/dist/vue.min.js"></script>
		<?php include_once $_SERVER['DOCUMENT_ROOT'].'/template/layout/header/header.php'; ?>
		<div class="container su-main-content">
			<div class="row">
<?php } ?>

<?php
function page_banner(){

	$print = `<div class="col-12 page-img-banner"></div>`;
	echo $print;
}
?>


<?php
function left_nav($nav, $options){
?>
    <div class="col wrap-left-col">
        <div id="left-col" class="wrap-left-col-menu">
            <ul>
                <?php

                foreach($nav as $key => $value){
                    $class = '';
                    if ( isset($options['page']) && ($options['page'] == $key) ) { $class = "active"; }
                    echo '<li><a href="' . $value['link'] . '" class="'.$class.'" >' . $key . '</a></li>';
                }

                ?>
            </ul>
        </div>
    </div>
<?php
}

function print_left_nav($nav, $page = null, $skip = array()){
?>
    <div class="col wrap-left-col">
        <div id="left-col" class="wrap-left-col-menu">
            <?php
            
            foreach($nav as $key => $value){
                if (!in_array($key, $skip)){
                    // Print Section Title
                    if (isset($value['title']) && $value['title'] != ''){
                        echo '<h2 class="left-col-menu-header">';
                        echo print_leftnav_link($value);
                        echo '</h2>';
                    }

                    if (isset($value['list']) && $value['list'] != ''){
                        echo '<ul>';
                        foreach($value['list'] as $l_key => $l_value){
                            $class = '';
                            if ( $page == $l_value['title'] ) { $class = "active"; }
                            if (isset($l_value['child'])){
                                $parentclass = '';
                                $print = '';
                                $tmp_print = '';
                                foreach($l_value['child'] as $c_key => $c_value){
                                    $childclass = '';
                                    if ( $class == '' && $page == $c_value['title'] ) { 
                                        $childclass = "child-active"; 
                                        $parentclass = 'active';
                                    }
                                    $tmp_print .= '<li class="'.$childclass.'">';
                                    $tmp_print .= print_leftnav_link($c_value);
                                    $tmp_print .= '</li>';
                                }
                                $print .= '<li class="wrap-left-nav-child '.$class.'">';
                                $print .= print_leftnav_link($l_value, true);
                                $print .= '<ul class="'.$parentclass.' '.$class.'">'. $tmp_print .'</ul>';
                                $print .= '</li>';
                                echo $print;
                            }
                            else if (!isset($l_value['no_left'])) {
                                echo '<li class="'.$class.'">'.print_leftnav_link($l_value).'</li>';
                            }
                        }
                        echo '</ul>';
                    }
                }
            }

            ?>
        </div>
    </div>
<?php
}

function print_leftnav_link($link, $child = false){
    $print = '';
    if (isset($link['url']) && $link['url'] != ''){
        $print .= '<a href="'.$link['url'].'"';
        $print .= ( ($link['target'] != '') ? 'target="'.$link['target'].'"' : '' ) .'>';
        $print .= $link['title'];
        $print .= ( $child ? '<i class="fas fa-caret-down"></i>' : '' ); 
        $print .= '</a>';
    }
    else {
        $print = $link['title'];
    }

    return $print;
}
?>


<?php
function page_finish(){
    global $page_options;
?>
            </div>
        </div> 


        <section id="su_footer" style="display: unset">
            <su-footer></su-footer>
        </section>
        <script type="text/javascript" src="/template/layout/footer/index.js"></script>
        <link rel="stylesheet" type="text/css" href="/template/layout/footer/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    </body>
</html>

<?php } ?>
