<?php
return array(
    /*
     * Sets the environment type
     * You can move this to config/autoload/local.php
     */
    "env" => array(
        "type" => "local"
        #"type" => "develop"
        #"type" => "production"
    ),

    "WasabiMail" => array(
        "transporter" => array(
            /**
             * local configuration to save mails as text
             */
            "local" => array(
                "base" => __DIR__,
                "target" => "/localMails/"),

            /**
             * you have a staging or development system with access to a mail server
             * For detailed information of smtp options see: http://framework.zend.com/manual/current/en/modules/zend.mail.smtp.options.html
             */
            "develop" => array(
                "port" => 25,
                "to" => "development-mails@yourdomain.de",
                "name" => "mail.yourmailserver.local",
                "host" =>"mail.yourmailserver.local",),

                //comment the following lines if they are not needed for your setup
                'connection_class'  => 'login', //'crammd5' or 'plain'
                'connection_config' => array(
                    'username' => 'user',
                    'password' => 'pass',
                    'ssl'      => 'tls',
            ),
        ),
    ),
    /**
     * To use email templates you can change the path to your template folder here
     */
    'view_manager' => array(
        'template_path_stack' => array(
            'WasabiMail' => __DIR__ . '/templates',
        ),
    ),
);

