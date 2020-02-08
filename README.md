# RadicalPHP Framework
A lightweight, easy-to-use PHP framework for rapid application development.

To see this framework in action, visit [https://blog.lewiswilliams.info/](https://blog.lewiswilliams.info/)

## Folder Structure

radicalPHP utilizes the MVC (Model-View-Controller) architecture. It is made up of a number of folders;

### App
This contains our models, views and controllers.
- The models is code that represents data.
- The views are our pages. They contain the HTML. Each file ends with **.twig**. [Twig](https://twig.symfony.com/ "Twig") is a HTML template engine for PHP, allowing us to dynamically render HTML based on certain logic.
- The controllers is what controls our application. This determines what data is pulled from the models, and what views are displayed to the user. It contains the logic, authentication etc.
### Core
This contains the core code.
### Public
This is the folder our web server will be using. This contains our front-end code, and our index.php (main file the web browser goes for).
### resources
This folder contains the scss files. Any scss file stored inside this folder will be compiled at given to the front-end.
### storage
This folder contains basic files such as JSON files, log files etc... We don't need a relational database to store these files.
### Vendor
This folder contains our 3rd-party, open-source PHP code that is obtained from the enthusiastic software development community Composer.
### tests
You may store your unit tests in this directory.

## Routing

Routes are added in **public/index.php** with the `add` method. You can add fixed URL routes, and specify the controller and action, like this:

```php
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
```

Or you can add route **variables**, like this:

```php
$router->add('{controller}/{action}');
```

In addition to the **controller** and **action**, you can specify any parameter you like within curly braces, and also specify a custom regular expression for that parameter:

```php
$router->add('{controller}/{id:\d+}/{action}');
```

You can also specify a namespace for the controller:

```php
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
```

## Controllers

Controllers respond to user actions. They are stored in the `App/Controllers` folder. Controller classes need to be in the `App/Controllers` namespace.

Controller classes contain methods that are the actions. To create an action, add the **`Action`** suffix to the method name.

You can access route parameters (for example the **id** parameter shown in the route examples above) in actions via the `$this->route_params` property.

## Unit Tests

Unit tests should be stored in the `tests/` folder.

This framework uses PHPUnit. Please refer to their documentation for how to use the unit testing [here](https://phpunit.de/getting-started/phpunit-8.html).

## Framework Commands

It is possible to quickly create controllers and models using the in-built commands.

To create a controller, run the command:

```
php radical.php create controller HelloController
```

To create a model, run the command:

```
php radical.php create model HelloModel
```

## Scss Files

All scss files are stored inside `resources/scss`. In order to use them, you must place the following code inside your `<head>` tags;
```html
<link rel="stylesheet" href="{{ SCSS }}">
```