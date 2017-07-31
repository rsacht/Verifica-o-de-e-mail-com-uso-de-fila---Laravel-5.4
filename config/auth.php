<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults - Padrão de Autenticação
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    | 
    /Esta opção controla o padão de autenticação "guard" e opções de reset de senha
    /para a sua aplicação. Você pode mudar estes padrões se precisar, mas são um bom
    /começo para a maiora das aplicações.
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards - Autenticação dos Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    |Depois, você pode definir cada autentificação guard da sua aplicação;
    |Mas claro que, um ótimo padrão de configuração já foi definido para você
    |aqui que usa armazenamento de sessão e o Eloquent como provedor de usuários.
    |
    |Todos os drivers de autenticação possuem um provedor de usuário. Isso define como os
    |usuarios são realmente recuperados do seu banco de dados ou outros mecanismos de 
    |armazenamento usados pela aplicação para persistir os dados do usuário.
    |
    |Suporta: "session", "token"
    |

    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    |Todos os drivers de autenticação possuem um provedor de usuário. Isto define como os
    |usuários são realmente recuperados do seu banco de dados ou outros mecanismos de 
    |armazenamento usado pela aplicação para persistir os seus dados do usuário.
    |
    |Se você tem várias tabelas de usuário ou models você pode configurar várias
    |fontes que representam cada model / tabela. Estas fontes podem então ser atribuídas
    |a quaisquer guard de autenticação extra que você definiu.
    |
    |Suportado:  "database", "eloquent"
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    Você pode especificar multiplas configurações de redefinição de senha se você tiver mais que
    uma tabela de usuário ou model na aplicação e você quer ter separadas as configurações dos resetes de senha
    com base nos tipos especificos de usuários.
    
    O tempo de expiração é o número de minutos que o token de redefinição deve ser considerado válido.
    Esta característica de segurança mantém tokens de curta duração para que eles tenham menos tempo de 
    serem descobertos. Você pode mudar isto cconforme necessário.
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
