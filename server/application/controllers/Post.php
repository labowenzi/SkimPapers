<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Mysql\Mysql as DB;

class Post extends CI_Controller {
    /**
      发表文章
    */
    public function index(){
      $json_str = file_get_contents("php://input");
      $data = json_decode($json_str,true);
      $title = $data['title'];
      $abstract = $data['abstract'];
      $content = $data['content'];

      if ($title == "" || $abstract == "" || $content == ""){
        $this->json([
          'code' => -1,
          'data' => "some fileds are empty"
        ]);
      }else{
        $res = DB::insert('paper',['title'=>$title, 'abstract'=>$abstract, 'content'=>$content]);
        if($res == 1){
          $this->json([
              'code' => 0,
              'data' => "success"
          ]);
        }else{
          $this->json([
            'code' => -1,
            'data' => "failed to insert!"
          ]);
        }
      }
    }
}
