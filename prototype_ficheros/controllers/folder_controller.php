<?php
  class FolderController {
    public function show() {
      // we expect a url of form ?controller=folders&action=show&id=x
      // without an id we just redirect to the error page as we need the folder id to find it in the database
      if(!isset($_GET['id'])){
        return call('folder', 'error');
      }
      $show_id = $_GET['id'];
      if($_GET['id'] == 0){
        $show_id = 1;
      }
      // we use the given id to get the right folder
      $data = Folder::subFolder($show_id);
      $crumbs = Folder::BuildCrumbs($data['current']->parent_id);
      require_once('views/folders/index.php');
    }

    public function error() {
      require_once('views/folders/error.php');
    }
  }
?>