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
            ],
            'factories'  => [
                AuthAdapter::class => AuthAdapterFactory::class,
                AuthService::class => AuthServiceFactory::class,
                AuthStorage::class => BaseFactory::class,

                Middleware\RouteAuth::class => BaseFactory::class,

                Action\Index\IndexAction::class => BaseFactory::class,
                Action\Index\RegisterAction::class => BaseFactory::class,
                Action\LogoutAction::class => BaseFactory::class,

                Action\Profile\IndexAction::class => BaseFactory::class,
                Action\Profile\EditAction::class => BaseFactory::class,

                Action\Chat\CreateAction::class => BaseFactory::class,

                Model\User::class => Model\ModelFactory::class,
                Model\Conversation::class => Model\ModelFactory::class,
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
                'app-chat'    => [__DIR__ . '/../templates/app/chat'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
