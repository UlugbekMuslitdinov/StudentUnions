<?php
// $Id: template.php,v 1.4.2.1 2007/04/18 03:38:59 drumm Exp $

function ua_banner1_regions() { return array(
'header' => t('header'),
'content' => t('content'), 
'left' => t('left sidebar'),
'right' => t('right sidebar'),
'block1' => t('block 1'),
'footer' => t('footer') );


}

function ua_banner1_webform_mail_headers($form_values, $node, $sid, $cid) {
  $headers = array(
	'MIME-Version'	=> '1.0',
    'Content-Type'  => 'text/html; charset=UTF-8; format=flowed; delsp=yes',
    'X-Mailer'      => 'Drupal Webform (PHP/'. phpversion() .')',
  );
  return $headers;
}

function ua_banner1_webform_mail_message_669($form_values, $node, $sid, $cid) {
  return _phptemplate_callback('webform-mail-669', array('form_values' => $form_values, 'node' => $node, 'sid' => $sid, 'cid' => $cid));
}