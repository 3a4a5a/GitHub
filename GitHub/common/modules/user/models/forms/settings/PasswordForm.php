<?php
namespace common\modules\user\models\forms\settings;
use Yii;
use yii\base\Model;
use common\modules\user\models\User;
/**
 * Login form
 */
class PasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $new_password_again;
    
    // Objects
    public $_user = null;
    
    public $activeTab = 'account';
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['old_password', 'validatePassword'],
            ['old_password', 'string'],
            ['old_password', 'required'],
            
            ['new_password', 'string', 'min' => 6],
            ['new_password', 'required'],
            
            ['activeTab', 'string'],
            
            ['new_password_again', 'string', 'min' => 6],
            ['new_password_again', 'required'],
            ['new_password_again', 'compare', 'compareAttribute' => 'new_password', 'message' => "Passwords don't match" ],
        ];
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }
    
    public function saveForm()
    {
        $this->getUser()->setPassword($this->new_password);
        if ($this->getUser()->save()) {
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