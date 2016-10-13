<?php
/**
 * Date: 07.04.14
 * Time: 14:18
 * @author: Norman Albusberger
 *
 * The MIT License (MIT)

Copyright (c) 2015 WasabiLib.org


Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */

namespace WasabiMail;
use Zend\Mail\Transport\Sendmail;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements AutoloaderProviderInterface, ViewHelperProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig() {
        // TODO: Implement getViewHelperConfig() method.
    }

    public function getServiceConfig(){
        return array(
            'factories' => array("Mail" => function($sm) {
                $mail = new Mail();
                $mail->setRenderer($sm->get("ViewRenderer"));
                /**
                 * @var $sm \Zend\ServiceManager\ServiceLocatorInterface
                 */
                $config = $sm->get("config");
                $env = $config["env"]["type"];
                $transporterConfig = $config["WasabiMail"]["transporter"];

                $transporter = null;
                //Production
                if ($env=="production") {
                    $transporter = new Sendmail();
                }
                //Develop or Staging
                elseif($env=="develop"){
                    $mailConfig = $transporterConfig["develop"];
                    $mail->setTo($mailConfig["to"]);
                    $transporter = new \Zend\Mail\Transport\Smtp();
                    $options = new \Zend\Mail\Transport\SmtpOptions();
                    $options->setName($mailConfig["name"]);
                    $options->setHost($mailConfig["host"]);
                    $options->setPort($mailConfig["port"]);
                    if(isset($mailConfig['connection_class']))
                        $options->setConnectionClass($mailConfig['connection_class']);
                    if(isset($mailConfig['connection_config'])){
                        $options->$mailConfig['connection_config'];
                    }

                    $transporter->setOptions($options);
                }
                //Local development mode - write to disk
                elseif($env=="local") {
                    $fileConfig = $transporterConfig["local"];
                    $options = new \Zend\Mail\Transport\FileOptions();
                    $options->setPath( $fileConfig["base"].$fileConfig["target"]);
                    $options->setCallback(
                        function(\Zend\Mail\Transport\File $transport){
                            return "Message_".microtime(true)."-".mt_rand(0,100).".txt";
                        }
                    );
                    $transporter = new \Zend\Mail\Transport\File($options);
                }
                $mail->setTransporter($transporter);
                return $mail;
            })
        );
    }
}
