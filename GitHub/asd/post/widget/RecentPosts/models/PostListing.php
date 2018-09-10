<?php

namespace common\modules\post\widget\PostList;

use common\modules\post\models\Post;

class PostListing extends \yii\base\Model
{
    /**
     * A saját bejegyzéseket nem hozza vissza ez a metódus
     * @return \yii\db\ActiveQuery
     */
    public static function getActivePosts()
    {
        return self::find()
                ->where(['status' => 1,])
                ->andWhere(['!=', 'user_id', Yii::$app->user->id])
                ->with('user', 'image')
                ->orderBy(['created_at' => SORT_DESC]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getInactivePosts()
    {
        return self::find()->where(['status' => 0])->with('user', 'image')->orderBy(['created_at' => SORT_DESC]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getRemovedPosts()
    {
        return self::find()->where(['status' => 0])->with('user', 'image')->orderBy(['created_at' => SORT_DESC]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     * @param integer $id The user's ID whose followers need to be queried
     */
    public static function getPostsFromFollowersById($id)
    {
        return self::find()
                ->innerJoin('follow', 'post.user_id = follow.followed_id')
                ->where([
                    'follow.follower_id' => Yii::$app->user->id,
                    'status' => 1,
                ])
                ->andWhere(['!=', 'user_id', Yii::$app->user->id])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ])
                ->with('user');
    }
}
