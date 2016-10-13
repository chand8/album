Wasabi Mail Module for Zend Framework 2
=======================================================
[![Latest Stable Version](https://poser.pugx.org/wasabi/wasabimail/v/stable)](https://packagist.org/packages/wasabi/wasabimail) [![Total Downloads](https://poser.pugx.org/wasabi/wasabimail/downloads)](https://packagist.org/packages/wasabi/wasabimail) [![Latest Unstable Version](https://poser.pugx.org/wasabi/wasabimail/v/unstable)](https://packagist.org/packages/wasabi/wasabimail) [![License](https://poser.pugx.org/wasabi/wasabimail/license)](https://packagist.org/packages/wasabi/wasabimail)

This Email module enhances ZF2 email functionality for a convenient usage. It supports file attachments and template email composition.

#Configuration
The Mail Module is configured as a service and registered to the service manager.
You have 3 default *env*-types for configuration in vendor/WasabiMail/config.php:
 
1. **local** - sended emails are saved as text files in vendor/WasabiMail/localMails
2. **develop** - for staging or development servers. It is supposed that a Mail-Server is accessible. Emails are sended to the given address in the config.php
3. **production** - The transporter is SendMail. This can only be changed in the Module.php

You can change this behavior in the Module.php if necessary.

##Setting the Environment type
It is recommended to set the *env*-type in the local.php of the config-folder. Normaly this file will not be deployed and should differ from the specific server environment. 

###Copy the following code into the local.php
     "env" => array(
         "type" => "local"
        #"type" => "develop"
        #"type" => "production"
     ),
 Make sure that only one type is active.

#Examples

##Simple Usage
    $mail = $this->getServiceLocator()->get("Mail");
    $mail->setBody("Hello World");
    $mail->setTo("recipient@domain.com");
    $mail->send();

##Using  Html Templates
Using a template for sending emails is based on the ViewModel approach of ZF2. You only need to create a new
ZF2 *ViewModel* instance, set your template, fill in your variables and pass it to the setBody method of the Mail Module.

**WasabiMail is bundled with a *responsive* Html Email-Template that you can customize for your own needs.**
This template is tested with common email clients like Microsoft Outlook or Google Mail.
    
    $mail = $this->getServiceLocator()->get("Mail");
    $viewModel = new ViewModel();
    $viewModel->setTemplate("responsive");
    $mail->setBody($viewModel);
    $mail->send();


The template path stack is set to WasabiMail/templates. If necessary you can change this in the config.php 

## File Attachments

Files can be attached to the email before sending it by providing their paths with `addAttachment` the method.

###Usage

    $mail->addAttachment('data/mail/attachments/file1.pdf');

You can call the method for each attachment you want to attach.
You can use the second argument for another name of the file you want to attach. Otherwise the real file name will be used.



