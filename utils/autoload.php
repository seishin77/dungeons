<?php
// PGF = PHP Game Framework

/**
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \PGF\Baz\Qux class
 * from /path/to/PGF/Baz/Qux.php:
 *
 *      new \PGF\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class){
  // var_dump($class);
  // project-specific namespace prefix
  $prefix = 'PGF\\';
  $len = strlen($prefix);

  // base directory for the namespace prefix
  $base_dir = __DIR__ . '/../PGF/';

  // does the class use the namespace prefix?
  if (strncmp($prefix, $class, $len) !== 0){
    // no, move to the next registered autoloader
    return;
  }

  // get the relative class name
  $relative_class = substr($class, $len);

  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

  // if the file exists, require it
  if(file_exists($file)){
      require_once $file;
  }
});



/**
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \controllers\Baz\Qux class
 * from /path/to/controllers/Baz/Qux.php:
 *
 *      new \controllers\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class){
  // var_dump($class);
  // project-specific namespace prefix
  $prefix = 'controllers';
  $len = strlen($prefix);

  // base directory for the namespace prefix
  $base_dir = __DIR__ . '/../controllers/';

  // does the class use the namespace prefix?
  if (strncmp($prefix, $class, $len) !== 0){
    // no, move to the next registered autoloader
    return;
  }

  // get the relative class name
  $relative_class = substr($class, $len);

  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

  // if the file exists, require it
  if(file_exists($file)){
      require_once $file;
  }
});
