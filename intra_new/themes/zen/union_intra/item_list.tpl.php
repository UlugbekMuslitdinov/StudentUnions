<?php
$output = '<div class="item-list"><ul>';
if (isset($title)) {
$output .= '<h3>'. $title .'</h3>';
}
if (isset($items)){
	foreach ($items as $item){
		$output .= '<li>' . $item . '</li>';
	}
}
$output .= '</ul></div>';

print $output;
?>