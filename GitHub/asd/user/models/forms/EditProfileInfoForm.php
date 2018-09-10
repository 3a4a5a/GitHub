<?php
namespace common\modules\user\models\forms;
use Yii;
use yii\base\Model;
use common\modules\user\models\User;
/**
 * Login form
 */
class EditProfileInfoForm extends Model
{
    // Form fields
    public $username;
    public $email;
    public $new_email;
    public $password;
    // Objects
    public $_user = null;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Display name
            ['email', 'unique',
                'targetClass' => User::class,
                'when'  => function ($model) {
                    return Yii::$app->user->identity->email != $model->email;
                }
            ],
            ['email', 'required'],
            ['email', 'string',
                'min'  => 3,
                'max'  => 64,
            ],
            
            // Username
            ['username', 'unique',
                'targetClass' => User::class,
                'when'  => function ($model) {
                    return Yii::$app->user->identity->username != $model->username;
                }
            ],
            ['username', 'required'],
            ['username', 'string',
                'min'  => 3,
                'max'  => 64,
            ],
        ];
    }
    public function save()
    {
        if ($this->adjustUser()) {
            $this->getuser()->save();
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @return boolean Whether there were changes in user details
     */
    private function adjustUser()
    {
        $adjusted = false;
        
        if ($this->username != Yii::$app->user->identity->username) {
            $this->getUser()->username = $this->username;
            $adjusted = true;
        }
        
        if ($this->email != Yii::$app->user->identity->email) {
            $this->getUser()->email = $this->email;
            $adjusted = true;
        }
        
        return $adjusted;
    }
    
    /**
     * @return User
     */
    private function getUser()
    {
        if ($this->_user == null) {
            $this->_user = User::findOne(Yii::$app->user->id);
            return $this->_user;
        } else {
            return $this->_user;
        }
    }
}