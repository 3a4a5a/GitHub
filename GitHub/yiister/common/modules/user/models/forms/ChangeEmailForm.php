<?php
namespace common\modules\user\models\forms;
use Yii;
use yii\base\Model;
use common\modules\user\models\User;
/**
 * Login form
 */
class ChangeEmailForm extends Model
{
    public $new_email;
    
    // Objects
    public $_user = null;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['new_email', 'string'],
            ['new_email', 'required'],
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