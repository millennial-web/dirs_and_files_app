<?php
  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'folder':
        require_once('models/Folder.php');
        require_once('models/File.php');
        $controller = new FolderController();
      break;
    }

    // call the action
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('folder' => ['show']);


  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the folder controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('folder', 'error');
    }
  } else {
    call('folder', 'error');
  }
?>