<?php
//не реализована
class Blog
{

    
    public static function getBlogItemById($id)
    {
        //$id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            $collection = $db->posts;
            $post = array(
                '_id' => $id
            );
            $blogItem = $collection->findOne($post);
            var_dump($blogItem);
            return $blogItem;
        }
        // if ($id) {                        
        //     $db = Db::getConnection();
        //     $collection = $db->users;
        //     $user = array(
        //         '_id' => $id
        //     );
        //     $cursor=$collection->findOne($user);
        //     return $cursor;
        // }
    }

    
    public static function getBlogList() {
        $db = Db::getConnection();
        $collection = $db->posts;
        $filter = [];
        $options = ['sort'=>['timestamp' => -1]];
        $blogList = $collection->find($filter,$options);//reverse need [],$options
        return $blogList;
    }

    public static function createPost($label,$text,$status,$userId)
    {
        $db = Db::getConnection();
        $collection = $db->posts;
        $user = array(
            'label' => $label,
            'text' => $text,
            'userId' => $userId,
            'status' => $status,
            'date' => date("G:i d.m.Y")
        );
        return $collection->insertOne($user);
        
    }

}
