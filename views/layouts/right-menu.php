<?=\yiister\gentelella\widgets\Menu::widget(
    [
        "items" => [
            [
                "label" => "Bosh Sahifa", 
                "url" => "/", 
                "icon" => "home"
            ],
            // [
            //     "label" => "Test",
            //     "url" => "#",
            //     "icon" => "bar-chart",
            //     "items" => [
            //         [
            //             "label" => Yii::t('app', 'Start exam'),
            //             "url" => "/exam",
            //         ],
            //         [
            //             "label" => Yii::t('app','Results'),
            //             "url" => "/results",
            //         ],
            //     ],
            // ],
            [
                "label" => Yii::t('app','Tests'), 
                "url" => ["/tests"], 
                "icon" => "newspaper-o"
            ],
            [
                "label" => Yii::t('app','Students'), 
                "url" => ["/student"], 
                'visible' => $user->isAdmin(),
                "icon" => "users"
            ],
            [
                "label" => "Kategoriyalar", 
                "url" => ["/categories"], 
                'visible' => $user->isAdmin(),
                "icon" => "tasks"
            ],

            [
                "label" => "Sozlamalar",
                "url" => "#",
                'visible' => $user->isAdmin(),
                "icon" => "cogs",
                "items" => [
                    [
                        "label" => 'Biz haqimizda',
                        "url" => ["/about-company"],
                        "badgeOptions" => ["class" => "label-success"],
                    ],
                    [
                        "label" => "Foydalanuvchilar",
                        "url" => ["/users"],
                        "badgeOptions" => ["class" => "label-success"],
                    ],
                ],
            ]

        ],
    ]
)
?>