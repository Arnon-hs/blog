<?php
//не реализована
class Blog
{

    
    public static function getBlogItemById($id)
    {
        $id = intval($id);

        if ($id) {
                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM posts WHERE id_post=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $blogItem = $result->fetch();

            return $blogItem;
        }
    }

    
    public static function getBlogList() {
 
        $db = Db::getConnection();
        $collection = $db->posts;
        $blogList=$collection->find();
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
