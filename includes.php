<?php
$base_path = '/sandbox';

function check_plain($text) {
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>
