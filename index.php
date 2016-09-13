<?php
        $config = [
            'page_access_token' => 'EAAChUnuUE44BALnD7YLejGW8KNvblZAKKdcwkoUZAJiG9ERztjrPSSO6xV5kIn4RhMhuFeJ1YJ7AMzkHCLT1SP4LqKYSB8tTPprp6sa2aSyjEpXvJuKbAkapmcFZC0eUfHxyF0nx1Df9VQ0S9Br3JTiM1ad2eHZB417ZAJJZAQbgx10H3ZBaWNE'
        ];
        $bot = new GigaAI\MessengerBot($config);
        $botHelp = 'Hi, I\'m a bot! I can respond to:\n
            kudos, \n
            order status, \n
            support, \n
            ycash, \n
        ';

        $bot->answer('(hello|hi)%', 'Hi [first_name]!');
        $bot->answer('kudos', 'This month: ');
        $bot->answer('support', [
            'text' => 'Here are some links to help you',
            'buttons' => [
                [
                    'type' => 'web_url',
                    'url' => 'https://www.youniqueproducts.com/business/support',
                    'title' => 'Younique Customer Support'
                ],
                [
                    'type' => 'postback',
                    'payload' => 'USER_CLICKED_BOT_HELP_BUTTON',
                    'title' => 'Bot Help'
                ]
            ]
        ]);
        $bot->answer('ycash', function () {
            $yCash = 0;
            //logic to get how much ycash they have
            return 'You have this much ycash: ' . $yCash;
        });
        $bot->answer('order status', function () {
            //logic to get order status
            return '';
        });

        $bot->answer('payload:USER_CLICKED_BOT_HELP_BUTTON', $botHelp);
        $bot->answer('help', $botHelp);

        $bot->answer('default:', 'Sorry, bot cannot understand what you would like. send help for what I can do');
        $bot->run();