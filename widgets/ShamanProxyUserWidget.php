<?php

namespace app\widgets;

use \yii\base\Widget;

class ShamanProxyUserWidget extends Widget
{
    /** @var \app\models\ShamanProxyUser */
    public $user;

    public function run()
    {
        return $this->render('shamanProxyUserWidget', [
            'user' => $this->user,
        ]);
    }
}
