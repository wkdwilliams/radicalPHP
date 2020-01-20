# radicalPHP
A lightweight, easy-to-use PHP framework for rapid application development

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
### storage
This folder contains basic files such as JSON files, log files etc... We don't need a relational database to store these files.
### Vendor
This folder contains our 3rd-party, open-source PHP code that is obtained from the enthusiastic software development community Composer.
