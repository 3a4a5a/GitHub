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
    public $display_name;
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
            ['display_name', 'unique',
                'targetClass' => User::class,
                'when'  => function ($model) {
                    return Yii::$app->user->identity->display_name != $model->display_name;
                }
            ],
            ['display_name', 'required'],
            ['display_name', 'string',
                'min'  => 3,
                'max'  => 24,
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
                'max'  => 24,
            ],
                    
            ['new_email', 'email'],
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
        
        if ($this->display_name != Yii::$app->user->identity->display_name) {
            $this->getUser()->display_name = $this->display_name;
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
