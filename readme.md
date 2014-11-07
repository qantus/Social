# Модуль социальной авторизации

## Установка

В файле конфигурации при подключении модуля описать компонент и адаптеры:

```php
...
'modules' => [
    'Social' => [
        'components' => [
            'social' => [
                'class' => 'Mindy\SocialAuth\SocialAuth',
                'providers' => [
                    'vk' => [
                        'class' => 'Mindy\SocialAuth\Adapter\Vk',
                        'clientId' => '4624319',
                        'clientSecret' => 'jGt3m9yFpp9KYeDQhUXS',
                        'redirectUri' => function() {
                                return \Mindy\Base\Mindy::app()->urlManager->reverse('social.auth', [
                                    'provider' => 'vk'
                                ]);
                            }
                    ],
                    'facebook' => [
                        'class' => 'Mindy\SocialAuth\Adapter\Facebook',
                        'clientId' => '745714052131897',
                        'clientSecret' => '78cba2fc7ecf931f6e0e27fa52437668',
                        'redirectUri' => function() {
                                return \Mindy\Base\Mindy::app()->urlManager->reverse('social.auth', [
                                    'provider' => 'facebook'
                                ]);
                            }
                    ],
                    'yandex' => [
                        'class' => 'Mindy\SocialAuth\Adapter\Yandex',
                        'clientId' => '84bf2001108f4bc0a7bdd6b89cac4898',
                        'clientSecret' => '4670f5e9130d414fbcb8d5bf2c07de7e',
                        'redirectUri' => function() {
                                return \Mindy\Base\Mindy::app()->urlManager->reverse('social.auth', [
                                    'provider' => 'yandex'
                                ]);
                            }
                    ],
                    'google' => [
                        'class' => 'Mindy\SocialAuth\Adapter\Google',
                        'clientId' => '766032454073-9l4kirl2t6iiitrspf5au0pfhl3f9mgq.apps.googleusercontent.com',
                        'clientSecret' => 'pA5DW8IlbtQ_56q9SCQuBcQB',
                        'redirectUri' => function() {
                                return \Mindy\Base\Mindy::app()->urlManager->reverse('social.auth', [
                                    'provider' => 'google'
                                ]);
                            }
                    ],
                ]
            ]
        ],
    ],
],
...
```

Далее использовать в шаблоне в любом месте хелпер `{{ social() }}`