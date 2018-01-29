<?php
  class Folder {
    public $id;
    public $parent_id;
    public $created;
    public $name;

    public function __construct($id, $parent_id, $name, $created) {
      $this->id      = $id;
      $this->parent_id = $parent_id;
      $this->created  = $created;
      $this->name = $name;
    }

    public static function subFolder($id) {
      $folders = [];
      $files = [];
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      // get requested folder first
      $req = $db->prepare('SELECT * FROM folders WHERE id = :id');
      $req->execute(['id' => $id]);
      $res = $req->fetch();
      if($res){
        $current = new Folder($res['id'], $res['parent_id'], $res['name'], $res['created']);
      }
      //get all folders contained in this folder
      $req = $db->prepare('SELECT * FROM folders WHERE parent_id = :id');
      $req->execute(['id' => $id]);
      // we create a folders of Folder objects from the database results
      foreach($req->fetchAll() as $folder) {
        $folders[] = new Folder($folder['id'], $folder['parent_id'], $folder['name'], $folder['created']);
      }

      //get all files contained in this folder
      $req = $db->prepare('SELECT * FROM files WHERE parent_id = :id');
      $req->execute(['id' => $id]);
      // we create a list of File objects from the database results
      foreach($req->fetchAll() as $folder) {
        $files[] = new File($folder['id'], $folder['parent_id'], $folder['name'], $folder['created']);
      }
      return ['current'=>$current,'folders'=>$folders,'files'=>$files];
    }

    public static function BuildCrumbs($parent_id) {
        $crumbs = [];
        // we make sure $parent_id is an integer
        $parent_id = intval($parent_id);
        while($parent_id > 0){
          $p = self::GetParent($parent_id);
          $parent_id = $p->parent_id;
          array_push($crumbs,$p);
        }
        return array_reverse($crumbs);
    }

    public static function GetParent($parent_id){
      $db = Db::getInstance();
      $req = $db->prepare('SELECT * FROM folders WHERE id = :parent_id');
      $req->execute(['parent_id' => $parent_id]);
      $folder = $req->fetch();
      if($folder){
        return new Folder($folder['id'], $folder['parent_id'], $folder['name'], $folder['created']);
      }
    }
  }
?>