<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 07/11/14.11.2014 22:27
 */

namespace Modules\Social\Controllers;

use Mindy\Base\Mindy;
use Mindy\SocialAuth\Adapter\BaseAdapter;
use Modules\Core\Controllers\CoreController;
use Modules\Social\Models\SocialProfile;
use Modules\User\Models\User;

class SocialController extends CoreController
{
    public function actionAuth($provider)
    {
        /** @var \Mindy\SocialAuth\SocialAuth $social */
        $social = $this->getModule()->getComponent('social');
        $provider = $social->getProvider($provider);
        $status = $provider->authenticate();
        $app = Mindy::app();
        if ($status) {
            $user = $this->processProvider($provider);
            $app->auth->login($user);
            echo $this->render("social/_close.html");
        } else {
            $this->r->redirect($app->getModule('User')->getLoginUrl());
        }
    }

    /**
     * @param BaseAdapter $provider
     * @return \Modules\User\Models\User
     */
    protected function processProvider(BaseAdapter $provider)
    {
        $profile = SocialProfile::objects()->filter([
            'social_id' => $provider->getSocialId(),
            'info' => $provider->getInfo(),
        ])->get();

        if ($profile === null) {
            $email = $provider->getEmail();
            $password = substr(md5($provider->getSocialId()), 10);
            if (!is_null($email)) {
                $user = User::objects()->filter(['email' => $email])->get();
                if ($user === null) {
                    $user = User::objects()->createUser($provider->getSocialId(), $password, $email, [
                        'is_active' => true
                    ]);
                }
            } else {
                $user = User::objects()->filter(['username' => $provider->getSocialId()])->get();
                if ($user === null) {
                    $user = User::objects()->createUser($provider->getSocialId(), $password, null, [
                        'is_active' => true
                    ]);
                }
            }

            SocialProfile::objects()->create([
                'social_id' => $provider->getSocialId(),
                'info' => $provider->getInfo(),
                'user' => $user
            ]);
        } else {
            return $profile->user;
        }

        return $user;
    }
}
