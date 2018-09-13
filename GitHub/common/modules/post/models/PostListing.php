<?php

namespace common\modules\post\models;

use Yii;

class PostListing extends Post
{
    // Stash
    private $stash = [];
    
    /**
     * A saját bejegyzéseket nem hozza vissza ez a metódus
     * @return \yii\db\ActiveQuery
     */
    public static function getActivePosts($id = null, $restash = false)
    {
        if (isset($stash['activePosts']) && !$restash) {
            return $stash['activePosts'];
        }
        
        $query = new \yii\db\Query;
        
        $query = self::find()->where([
            'status'  => self::STATUS_ACTIVE,
        ])
        ->andWhere(['!=', 'user_id', Yii::$app->user->id])
        ->with('user', 'image')
        ->orderBy(['created_at' => SORT_DESC]);
        
        if ($id != null) {
            $query->andWhere(['user_id' => $id]);
        }
        
        return $stash['activePosts'] = $query;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getInactivePosts($restash = null)
    {
        if (isset($stash['inactivePosts']) && !$restash) {
            return $stash['inactivePosts'];
        }
        
        return $stash['inactivePosts'] = self::find()->where(['status' => self::STATUS_INACTIVE])->with('user', 'image')->orderBy(['created_at' => SORT_DESC]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getRemovedPosts($restash = false)
    {
        if (isset($stash['removedPosts']) && !$restash) {
            return $stash['removedPosts'];
        }
        
        return $stash['removedPosts'] = self::find()->where(['status' => self::STATUS_INACTIVE])->with('user', 'image')->orderBy(['created_at' => SORT_DESC]);
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
                    'status' => self::STATUS_ACTIVE,
                ])
                ->andWhere(['!=', 'user_id', Yii::$app->user->id])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ])
                ->with('user');
    }
    
    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public static function getRecentPosts()
    {
        return self::find()
                ->where([
                    'status' => self::STATUS_ACTIVE,
                ])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ])
                ->limit(5);
    }
}
