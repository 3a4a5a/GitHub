<?php
namespace common\modules\user\models\forms\settings;
use Yii;
use yii\base\Model;
use common\modules\user\models\User;
/**
 * Login form
 */
class PersonalForm extends Model
{
    public $username;
    public $name;
    public $first_name;
    public $last_name;
    
    // Objects
    public $_user = null;
    
    public $activeTab = 'personal';
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
                    
            ['activeTab', 'string'],
                 
            ['name', 'string',
                'min'  => 3,
                'max'  => 64,
            ],
                    
            ['first_name', 'string'],
            ['last_name', 'string'],
        ];
    }
    public function saveForm()
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
        
        if ($this->name != Yii::$app->user->identity->name) {
            $this->getUser()->name = $this->name;
            $adjusted = true;
        }
        
        if ($this->first_name != Yii::$app->user->identity->first_name) {
            $this->getUser()->first_name = $this->first_name;
            $adjusted = true;
        }
        
        if ($this->last_name != Yii::$app->user->identity->last_name) {
            $this->getUser()->last_name = $this->last_name;
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