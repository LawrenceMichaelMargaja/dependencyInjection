# Dependency Injection For Idiots

A guide to understand what Dependency Injection is in a simple and basic way.

Let's break down the term first... dependency and injection and understand what they mean...

well for injection... it's pretty straight forward. It means you inject something and in coding, it means you pass something as an argument.

now for the other part of the term "Dependency"...

1. ### What is a Dependency?
    - A Dependency in the context of Dependency Injection is an external object or service that a class relies on to perform its tasks.
2. ### What is Dependency Injection?
    - Dependency Injection is a design pattern in which an object receives its dependencies from external sources rather than creating them internally.

    - If we analogy as an example, it would go like this...

        1. Dependency Injection is like a car assembly line where each car(Object) is not responsible for creating its own parts(dependencies), but instead, these parts are provided by the assembly line(external sources). This approach allows for more flexibility and easier management of the car's components.
2. ### Why should we use Dependency Injection?
    - There are quite the number of reasons why we should use Dependency Injection.

    - Here are the reasons why:

    - **Easier To Maintain** === Classes being decoupled means that it's easier to maintain because classes have minimal or no impact on changes on their respective codes.
    - **Improved testability** === With Dependency Injection, it’s easy to replace real dependencies with mocks or stubs, facilitating unit testing. Components can be tested in isolation, making tests more reliable and easier to write.
    - **Inversion of Control** === This means that high-level modules should not depend on low-level modules but on abstractions. As such, you have full control because you are at the top of the caller chain.
    - **Easier to refactor** === Classes being decoupled means that you can refactor them without affecting the other classes.
    - **Easier code to work with in a Team Setting** === Code that is decoupled can be more easily handled by a team as they can focus more on classes they are assigned to rather than tightly coupled classes where they'd need to also be aware of how their changes affect those classes.
7. ### What are the ways we can use Dependency Injection?
   - There are three ways we can inject dependencies.</br> Let me show these ways but first let's build the classes we need to demonstrate the injections.
   - Here they are:
```php
// Logger and Database classes, think of them as specific tools in the kitchen.
class Logger {
    // Logger implementation...
}

class Database {
    // Database implementation...
}

// DI Container setup, like a central tool shed where all kitchen tools are organized.
class DIContainer {
    private $services = [];

    public function register($name, $callable) {
        $this->services[$name] = $callable;
    }

    public function get($name) {
        return $this->services[$name]();
    }
}

// Setting up the DI container (the tool shed) with Logger and Database (kitchen tools).
$container = new DIContainer();
$container->register('Logger', function() { return new Logger(); });
$container->register('Database', function() { return new Database(); });
```
   
- ### Injecting a container directly into a controller
  - Dependencies are provided directly to an object via its constructor.
  - What does this mean? Here is a sample code of injecting into the controller
```php
class ArticleController {
    private $diContainer;  // This is a variable that is private, which means it cannot be accessed or modified outside of this class.private 
                           // This is also the variable that stores the value(which is the container) passed into the controller in the construct function.

    // DI container is passed to the constructor
    public function __construct($container) {
        $this->diContainer = $container;  // Assigning the passed container to the property
    }

    public function createArticle($data) {
        // Fetching dependencies from the DI container
        $logger = $this->diContainer->get('Logger');
        $database = $this->diContainer->get('Database');
        
        // Use $logger and $database as needed...
    }
}
```

   - #### Why doing this is not consider good?
     - Because this makes your classes tightly coupled, making hard for a lot of things like debugging, testing, and refactoring.
     - Another thing that makes this bad is that your class has longer code and longer code means more chances of human error.
     - Dependencies might not be clear --- This may be a stretch but the dependencies used in the class might not be clear to the next dev. Although the dependencies can be seen in whatever function is using it in the class, if the class itself is gigantic, it may take the dev time to check for the dependencies. Also, it is the constructor where we usually check first for the dependencies used in the class. However, since it's just the container passed, there are no dependencies passed at all.
- ### Dependency Injection into the Constructor
  - Instead of injecting the container, a better way would be to inject the dependencies into the constructor.
    - Here is a sample code of what this type of dependency injection looks like:
```php
        class ArticleController {
            private $logger;
            private $database;

        // Logger and Database are injected through the constructor
        public function __construct(Logger $loggerInstance, Database $databaseInstance) {
            $this->logger = $loggerInstance;
            $this->database = $databaseInstance;
        }

        public function createArticle($data) {
            // Use $this->logger and $this->database directly
        }
          }
    
          // Creating an instance of ArticleController with dependencies
          $logger = $container->get('Logger');
          $database = $container->get('Database');
          $articleController = new ArticleController($logger, $database);
```
- #### Why doing this is not consider good?
    - Because this makes your constructor so verbose. Imagine, if you had to inject 20 dependencies, the constructor will be so long and it will be such a pain to do.
    - There's also the factor of human error being higher in chance when the code is longer.

- #### Why doing this is not consider good?
    - Because this makes your constructor so verbose. Imagine, if you had to inject 20 dependencies, the constructor will be so long and it will be such a pain to do.
    - There's also the factor of human

- ### Dependency Injection into the Properties
    - Dependencies are injected directly into the properties of an object, often without the need for explicit setter methods.
    - What does that mean? it means you make properties in your class and then the injection is done automatically for you
    - This way of Dependency Injection is also the one that's leaves your class the cleanest. Which means there is much lesser code compared to the other two methods of Dependency Injection.
    - Here is what it looks like:
```php
    class ArticleController {
        #[Inject]
        private $logger;   // A place in the kitchen for the Logger tool.
        #[Inject]
        private $database; // A place in the kitchen for the Database tool.

    // No need for the chef to bring tools; they are already in the kitchen.
    public function createArticle($data) {
        // The chef uses the Logger and Database directly from their kitchen.
        }
    }

    // Creating an ArticleController instance.
    // The DI container or framework automatically equips the chef (ArticleController) with necessary tools (Logger, Database).
    $articleController = new ArticleController();
```
- ### Dependency Injection Containers can make you life easier
   - When using dependency injection, it can get quite cumbersome if the app is large.</br> 
   You create each object and its dependencies which is again cumbersome and error-prone.</br> 
   However, there are things called containers that can help us 
   
   
   
   Doing so would look like this:

### Without using a dependency injection container
```php
class Logger {
    public function log($message) {
        echo "Logging message: $message";
    }
}

class Database {
    private $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    // Database methods...
}

class UserService {
    private $database;
    private $logger;

    public function __construct(Database $database, Logger $logger) {
        $this->database = $database;
        $this->logger = $logger;
    }

    // UserService methods...
}

// Manually creating dependencies
$logger = new Logger();
$database = new Database($logger);
$userService = new UserService($database, $logger);
```

However, using the library php-di, you can use containers that can make it easier to handle class instantiations and passing of dependencies.

### Using a dependency injection container

```php
// Create a new instance of a generic DI container.
// This container will be used to manage object creation and dependencies.
$container = new DIContainer();

// Configure the container:
// Register the Logger class in the container.
// This tells the container how to create a Logger instance when needed.
$container->register(Logger::class, function() {
    return new Logger(); // Simple creation of a Logger instance.
});

// Register the Database class in the container.
// This function defines how to create a Database instance.
// It uses the container itself to resolve the Logger dependency.
$container->register(Database::class, function($container) {
    // The container creates a Logger instance and passes it to the Database constructor.
    return new Database($container->get(Logger::class));
});

// Register the UserService class in the container.
// This function defines how to create a UserService instance.
// It uses the container to resolve both Database and Logger dependencies.
$container->register(UserService::class, function($container) {
    // The container creates a Database and a Logger instance and passes them to the UserService constructor.
    return new UserService($container->get(Database::class), $container->get(Logger::class));
});

// Retrieve an instance of UserService from the container.
// The container automatically resolves all required dependencies (Database and Logger)
// and returns a fully constructed UserService instance.
$userService = $container->get(UserService::class);
```

5. ### Why should we use a Dependency Injection Container?

- **Simplified Dependency Management**:
   - Containers handle the instantiation and wiring of dependencies, reducing the boilerplate code needed for object creation and dependency resolution.

- **Improved Code Maintainability**:
   - Centralizing the configuration of components and their dependencies in one place makes the code easier to manage and modify.

- **Enhanced Flexibility and Scalability**:
   - Changing or updating dependencies is easier and can often be done without modifying the classes that use these dependencies.

- **Better Support for Testing**:
   - DI containers facilitate unit testing by allowing easy substitution of real services with mocks or stubs.

- **Encourages Best Practices**:
   - Promotes the use of design patterns and principles like Dependency Inversion, leading to more robust and scalable software design.

- **Easier Integration of Third-Party Libraries**:
   - Containers can manage complex third-party dependencies and integrate them seamlessly into your application.

So as we can see, these containers can help us out a lot. However... there are rules to using them...

## # Rules for using a container and dependency injection

1. **Never Get an Entry from the Container Directly**:
   - Always use dependency injection instead of directly accessing the container to retrieve dependencies.

2. **Write Code Decoupled from the Container**:
   - Ensure that your code is not tightly coupled with the container itself, promoting better maintainability and flexibility.

3. **Type-Hint Against Interfaces**:
   - When defining dependencies, type-hint against interfaces rather than concrete classes.

4. **Configure Implementations in the Container's Configuration**:
   - Specify which implementation to use for a given interface within the container's configuration. This allows for greater flexibility and easier changes to implementations.


## # Writing Controllers

Using dependency injection in controllers is usually where 
it is the most painful.

Why is a pain though?</br> 

Because it will require you to make so much more boilerplate code 
and more code means more chances of making human errors.</br> 

What's more, is that your code is 



Now I didn't quite understand what rule #1 was about so here is some code of what that means. Hopefully that clears it up for you too.

### Instead of doing this (direct container access):
```php
class SomeClass {
    private $dependency;

    public function __construct(DIContainer $container) {
        $this->dependency = $container->get(SomeDependency::class);
    }
}
```



Here's another example without using a container
```php
use Dependency1;
use Dependency2;
use Dependency3;
use Dependency4;
use Dependency5;
use Dependency6;

class ComplexController {
    private Dependency1 $dependency1;
    private Dependency2 $dependency2;
    private Dependency3 $dependency3;
    private Dependency4 $dependency4;
    private Dependency5 $dependency5;
    private Dependency6 $dependency6;

    public function __construct(Dependency1 $dep1, Dependency2 $dep2, Dependency3 $dep3, Dependency4 $dep4, Dependency5 $dep5, Dependency6 $dep6) {
        $this->dependency1 = $dep1;
        $this->dependency2 = $dep2;
        $this->dependency3 = $dep3;
        $this->dependency4 = $dep4;
        $this->dependency5 = $dep5;
        $this->dependency6 = $dep6;
    }

    // Other methods...
}

```
### Do this instead (dependency injection):
```php
class SomeClass {
    private $dependency;

    public function __construct(SomeDependency $dependency) {
        $this->dependency = $dependency;
    }
}
```

and to make it even clearer... here's that second example but this time with the use of a container.

```php
use Dependency1;
use Dependency2;
use Dependency3;
use Dependency4;
use Dependency5;
use Dependency6;
use SomeNamespace\Inject;

class ComplexController {
    #[Inject]
    private Dependency1 $dependency1;
    #[Inject]
    private Dependency2 $dependency2;
    #[Inject]
    private Dependency3 $dependency3;
    #[Inject]
    private Dependency4 $dependency4;
    #[Inject]
    private Dependency5 $dependency5;
    #[Inject]
    private Dependency6 $dependency6;

    // Other methods...
}
```

Also regarding the #3 rule, **Type-Hint Against Interfaces**, it was also fuzzy for me so here's some clarification about it if in case it's also fuzzy for you.

### What does "Type-Hint against interfaces" even mean?

Simply put, it means that you use an interface to set the type of your injected dependency.</br>
To make it more clear, let me show you what it would look like without type-hint and with type-hint.

### Without Type-Hint
```php
class MySQLDatabase {
    // MySQL specific implementation...
}

class UserManager {
    private MySQLDatabase $database;

    public function __construct(MySQLDatabase $database) {
        $this->database = $database;
    }

    // Other methods...
}
```

### With Type-Hint
```php
interface DatabaseInterface {
    // Interface for database operations...
}

class MySQLDatabase implements DatabaseInterface {
    // MySQL specific implementation...
}

class UserManager {
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $database) {
        $this->database = $database;
    }

    // Other methods...
}
```

