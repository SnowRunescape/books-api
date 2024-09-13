<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UserController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $login the message to be echoed.
     * @param string $password the message to be echoed.
     * @param string $name the message to be echoed.
     * @return int Exit code
     */
    public function actionCreateUser(string $login, string $password, string $name)
    {
        $model = new User([
            'login' => $login,
            'password' => $password,
            'name' => $name,
        ]);

        if ($model->validate()) {
            $model->save();
        }

        return ExitCode::OK;
    }
}
