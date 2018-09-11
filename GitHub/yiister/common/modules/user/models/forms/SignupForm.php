<?php
namespace common\modules\user\models\forms;

use Yii;
use yii\base\Model;
use common\modules\user\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\modules\user\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\modules\user\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
           
            ['verifyCode', 'captcha', 'captchaAction' => 'user/default/captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        if (Yii::$app->params['verifiedRegistration'] == true) {
            $user->status = User::STATUS_INACTIVE;
            $user->activation_token = sha1(mt_rand(10000, 99999).time().$user->email);

            $activation_url = Yii::$app->urlManager->createAbsoluteUrl('user/activate?key=' . $user->activation_token);

            if ($user->save()) {
                $message = 'Thank you for signup up on Yiister! Verify: ' . $activation_url;

                Yii::$app->mailer->compose('layouts/html', ['content' => $message])
                ->setFrom('yiister@email.com')
                ->setTo($this->email)
                ->setSubject("Verify your registration")
                ->send();

                return true;
            } else {
                return false;
            }
        } else {
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        }
        
    }
    
    /**
     * Logs in a user using the provided email and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (!Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                return false;
            }
        } else {
            return false;
        }
        
        if ($this->getUser()->status == 5) {
            $this->notActivated = true;
            return false;
        }
        
        return false;
    }
}
