# Dependency Injection Made Easy

A guide to understand what Dependency Injection is in a simple and basic way.

Let's break down the term first... dependency and injection and understand what they mean...

well for injection... it's pretty straight forward. It means you inject something and in coding, it means you pass something as an argument.

now for the other part of the term "Dependency"...

1. #### What is a Dependency?
   - A Dependency in the context of Dependency Injection is an external object or service that a class relies on to perform its tasks.
2. #### What is Dependency Injection?
   - Dependency Injection is a design pattern in which an object receives its dependencies from external sources rather than creating them internally.
   
   - If we analogy as an example, it would go like this...
     
     1. Dependency Injection is like a car assembly line where each car(Object) is not responsible for creating its own parts(dependencies), but instead, these parts are provided by the assembly line(external sources). This approach allows for more flexibility and easier management of the car's components.
2. #### Why should we use Dependency Injection?
   - There are quite the number of reasons why we should use Dependency Injection. 
   
   - Here are the reasons why:

   1. Decoupling Classes === It solves the problem of classes being tightly coupled by decoupling them.
   2. Easier To Maintain === Classes being decoupled means that it's easier to maintain because classes have minimal or no impact on changes on their respective codes.
   3. Improved testability === With Dependency Injection, it’s easy to replace real dependencies with mocks or stubs, facilitating unit testing. Components can be tested in isolation, making tests more reliable and easier to write.
   4. Inversion of Control === This means that high-level modules should not depend on low-level modules but on abstractions. As such, you have full control because you are at the top of the caller chain.
   5. Easier to refactor === Classes being decoupled means that you can refactor them without affecting the other classes.
   6. Easier code to work with in a Team Setting === Code that is decoupled can be more easily handled by a team as they can focus more on classes they are assigned to rather than tightly coupled classes where they'd need to also be aware of how their changes affect those classes.
7. 