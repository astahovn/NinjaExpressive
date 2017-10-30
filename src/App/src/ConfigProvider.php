<?php

namespace App;

use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService as AuthService;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                Action\LogoutAction::class => Action\LogoutAction::class,
            ],
            'factories'  => [
                AuthAdapter::class => AuthAdapterFactory::class,
                AuthService::class => AuthServiceFactory::class,

                Action\Index\IndexAction::class => Action\BaseFactory::class,
                Action\Index\RegisterAction::class => Action\BaseFactory::class,

                Action\Profile\IndexAction::class => Action\BaseFactory::class,

                Model\User::class => Model\ModelFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app-index'    => [__DIR__ . '/../templates/app/index'],
                'app-profile'    => [__DIR__ . '/../templates/app/profile'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
