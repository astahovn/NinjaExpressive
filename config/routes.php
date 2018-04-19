<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

$app->route('/', App\Action\Index\IndexAction::class, ['GET', 'POST'], 'login');
$app->route('/register', App\Action\Index\RegisterAction::class, ['GET', 'POST'], 'register');

$app->get('/profile', App\Action\Profile\IndexAction::class, 'home');
$app->route('/profile/edit', App\Action\Profile\EditAction::class, ['GET', 'POST'], 'profile.edit');
$app->route('/profile/private_key', App\Action\Profile\PrivateKeyAction::class, ['GET'], 'profile.private_key');

$app->route('/conversation/create', App\Action\Conversation\CreateAction::class, ['GET', 'POST'], 'conversation.create');
$app->get('/conversation/chat/{id:\d+}', App\Action\Conversation\ChatAction::class, 'conversation.chat');

$app->get('/logout', App\Action\LogoutAction::class, 'logout');