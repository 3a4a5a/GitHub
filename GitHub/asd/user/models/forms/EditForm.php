<?php

/* @var $result common\modules\user\models\User */

namespace common\modules\user\models\forms;

use Yii;
use yii\base\Model;
use common\modules\user\models\User;

/**
 * Login form
 */
class EditForm extends Model
{
    public $email;
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /* Username */
            // Unique
            [['username'], 'unique',
                'when' => function ($model) {
                    return $model->email == Yii::$app->user->identity->email;
                },
                'message' => 'Ez a felhasználónév már foglalt',
                'targetClass' => User::class,
            ],
            
            // Compare
            [['username'], 'compare',
                'when' => function ($model) {
                    return $model->email == Yii::$app->user->identity->email;
                },
                'compareValue' => Yii::$app->user->identity->username,
                'operator' => '!=',
                'message' => 'Már ez a felhasználóneved',
            ],
            
            // String
            [['username'], 'string',
                'length' => [
                        3, 24
                    ],
            ],
            
            /* Email */ 
            // Unique
            [['email'], 'unique',
                'when' => function ($model) {
                    return $model->username == Yii::$app->user->identity->username;
                },
                'message' => 'Ez az email cím már foglalt',
                'targetClass' => User::class,
            ],
                    
            // Compare
            [['email'], 'compare',
                'when' => function ($model) {
                    return $model->username == Yii::$app->user->identity->username;
                },
                'compareValue' => Yii::$app->user->identity->email,
                'operator' => '!=',
                'message' => 'Már ez az email címed',
            ],
                    
            // String
            [['email'], 'string',
                'length' => [
                        3, 24
                    ],
            ],
                        
            // Email
            [['email'], 'email'],
        ];
    }

    /**
     * Ha változás történt true-val tér vissza.
     * @return boolean 
     */
    public function validateEdit()
    {
        $changed = false;
        $_user = User::findOne(Yii::$app->user->id);

        if ($_user->username != $this->username) {
            $_user->username = $this->username;
            $_user->save();
            $changed = true;
        }

        if ($_user->email != $this->email) {
            $_user->email = $this->email;
            $_user->save();
            $changed = true;
        }
        
        return $changed;
    }
}
