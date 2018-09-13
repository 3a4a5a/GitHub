<?php
namespace common\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use common\modules\post\models\Post;
use common\modules\follow\models\Follow;
use common\modules\user\models\data\UserData;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    // Trait
    use \common\traits\ActiveRecordViewTrait;
    protected $viewDataClass = UserData::class;
    
    // Constant
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    // Stash
    private $stash = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * @return integer a bejegyzéseinek száma user azonosító alapján
     */
    public function getPostCount($id)
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivePostCount()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->where(['status' => Post::STATUS_ACTIVE])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopFiveMostViewedPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])
            ->orderBy(['hits_count' => SORT_DESC])
            ->limit(5);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopFiveMostPopularPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])
            ->orderBy(['commentCount'=> SORT_DESC])
            ->limit(5);
    }
    
    /**
     * @return array of \common\modules\follow\models\Follow
     */
    public function getFollowers()
    {
        return Follow::find()->where(['follower_id' => $this->id])->all();
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
    /**
     * Bejegyzések száma
     * @return boolean
     */
    public function hasPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->exists();
    }
    
    /**
     * Aktív bejegyzések száma
     * @return boolean
     */
    public function hasActivePosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->where(['status' => Post::STATUS_INACTIVE])->exists();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * Megnézi, hogy követője-e az adott felhasználónak ID alapján
     * @return boolean
     */
    public function checkIfFollows($id)
    {
        return Follow::find()
            ->where([
                'follower_id' => $this->id,
                'followed_id' => $id
            ])
            ->exists();
    }
    
    /**
     * 
     * @return integer a létező bejegyzéseinek száma
     */
    public function countPosts($restash = false)
    {
        if (isset($this->stash['postCount']) && !$restash) {
            return $this->stash['postCount'];
        }
        
        return $this->stash['postCount'] = $this->hasMany(Post::className(), ['user_id' => 'id'])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function countInactivePosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->where(['status' => Post::STATUS_INACTIVE])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function countActivePosts()
    {
        if (isset($stash['activePostCount']) && !$restash) {
            return $stash['activePostCount'];
        }
        
        return $this->stash['activePostCount'] = $this->hasMany(Post::className(), ['user_id' => 'id'])->where(['status' => Post::STATUS_ACTIVE])->count();
    }
    
    /**
     * Visszatér a követők számával
     * @return integer
     */
    public function countFollowers()
    {
        return Follow::find()->where(['follower_id' => $this->id])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function countOfEverReceivedComments()
    {
       
    }
}
