<?php

namespace App;

class Config
{

    const DB_HOST = 'your-database-host';
    const DB_NAME = 'your-database-name';
    const DB_USER = 'your-database-user';
    const DB_PASSWORD = 'your-database-password';

    const SHOW_ERRORS = true;   // If false, our custom 404 will show. Else, a detailed error will display.
    const DEVELOPMENT = true;   // If false, Scss and other assets will be minified,
                                //and other performance improvements will take effect.
}
