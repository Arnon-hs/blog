<?php
class Blog
{
    

    // public function showConstant() {
    //     return self::COLOR_FOR_TAGS;
    // }

    public static function getBlogItemById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $collection = $db->posts;
            $post = array(
                '_id' => new MongoDB\BSON\ObjectId($id)
            );
            $blogItem = $collection->findOne($post);
            return $blogItem;
        }
    }

    public static function getBlogItemsByUserId($userId)
    {
        if ($userId) {
            $db = Db::getConnection();
            $collection = $db->posts;
            $post = array(
                'userId' => $userId
            );
            $blogItems = $collection->find($post);
            return $blogItems;
        }
    }
    public static function getBlogList() {
        $db = Db::getConnection();
        $collection = $db->posts;
        $filter = [];
        $options = ['sort'=>['date' => -1]];
        $blogList = $collection->find($filter,$options);//reverse need [],$options
        return $blogList;
    }

    public static function createPost($label,$text,$status,$userId,$tags)
    {
        $db = Db::getConnection();
        $collection = $db->posts;
        $user = array(
            'label' => $label,
            'text' => $text,
            'tags' => $tags,
            'userId' => $userId,
            'status' => $status,
            'date' => date("G:i d.m.Y")
        );
        return $collection->insertOne($user);
        
    }

    public static function updatePost($id,$label,$text, $status)
    {
        $db = Db::getConnection();
        $collection = $db->posts;
        $updateResult = $collection->updateOne(
            [ '_id' => new MongoDB\BSON\ObjectId($id) ],
            [ '$set' => [ 'label' => "$label", 'text' => "$text", 'status' => "$status" ]]
        );
        return $updateResult;
    }
    public static function randomColorTags()
    {
        $COLOR_FOR_TAGS =[
            '#5aba59',
            '#4d85d1',
            '#df2d4f',
            '#8156a7',
            '#FFFF00',
        ];
        
        $rand = rand(0, 4);
        return $COLOR_FOR_TAGS[$rand];
    }
}
