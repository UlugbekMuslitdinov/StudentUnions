<?php

function uaqs_monitoring_page() {
  drupal_add_http_header('X-Robots-Tag', 'none');
  drupal_page_is_cacheable(FALSE);
  return '<p>This page is intended for use with uptime monitoring tools.</p>';  
}
