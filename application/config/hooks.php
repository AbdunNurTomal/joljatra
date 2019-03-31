<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
  // create hook for multi langunage
  $hook['post_controller_constructor'] = array(
      'class'    => 'MultiLanguageLoader',
      'function' => 'initialize',
      'filename' => 'MultiLanguageLoader.php',
      'filepath' => 'hooks'
  );
?>