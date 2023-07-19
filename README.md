## About Test

For the test, it was implemented using DDD and Hexagonal Architecture in PHP with Laravel.

While it is true that another pattern could have been used, such as DTO and Actions which I have worked with a lot, I decided to use this architecture.

"Okay! But why should I implement a clean architecture like Hexagonal Architecture, which undoubtedly adds accidental complexity, when one of Laravel's strengths is precisely the simplicity and speed with which it allows us to develop? With very few lines of code and enough food and drink, the application is already done."

It is because when the time comes to change our infrastructure, and for some reason this time will come sooner or later if the project starts to grow, having implemented a clean architecture will allow you to save a lot of time, money, and headaches.

"What are the main characteristics of a clean architecture?

From a technical perspective:


- Very low or no level of coupling and dependency on implementation details (framework, database, etc.).
- Ease of maintenance and flexibility to change.
- The software becomes intrinsically testable (yes, you have to do it, if you don't want to start praying every time you make a production deployment you have to write the tests).
- Stability, robustness, and scalability.

From a business perspective, this translates into:

- A higher quality product to which all the functionalities that our customers demand can be more easily added.
- Reduced development times due to lower technical debt.

## Hexagonal Architecture

Hexagonal architecture is a type of clean architecture that is structured into three layers or levels of depth.

The first and outermost layer is the infrastructure layer, the second is the application layer, and the third, the deepest one which is at the heart of our architecture so to speak, is the domain layer.

You can imagine it as concentric circles inside each other whose elements must respect a very simple rule: they can only communicate with other elements that belong to the same layer or the next innermost layer, but never with an outer layer, that is, from outside to inside and never the other way around.

More specifically, elements in the infrastructure layer can only communicate with other elements at their own level and with the application layer. In turn, elements in the application layer can only communicate with other elements at their own level and with the domain layer, and elements in the domain layer can only communicate with each other.

Communication between layers occurs through interfaces or ports (hexagonal architecture is also called port-adapter architecture).

In more detail, the layers are organized as follows:

# Infrastructure

Here we can find elements such as controllers and repository implementations, everything that represents a point of contact with our infrastructure and that could potentially be subject to the famous leaks mentioned earlier. They are the entry and exit points of our flow.

# Application

In this layer, we usually have use cases, also called actions or application services. The elements in this layer receive input that comes from the infrastructure elements such as controllers and communicate with the domain layer.

# Domain

This is where the business logic is located. In this layer, we will find elements such as domain models, their value objects, services, events, domain exceptions, interfaces implemented by the repositories located in the infrastructure layer, etc.

- The controllers and the Eloquent repositories are in the infrastructure layer, that is, IN and OUT of the request lifecycle within our architecture.
- The use cases are in the application layer.
- The models, value objects, and the repositories interfaces are in the domain layer.

## Considerations

In the Surcharge  module we can see the three layers of the hexagonal architecture, Infrastructure, Application and Domain, and in each of them the elements mentioned in the description of the architecture that I have given before.

- You will find a new folder called src which is the core of the architecture.
- The first thing we find when we display the src folder is the SurchargeMS folder.
- In the surcharge context we can find our domains or entities, in this case there is only one.


### Life cycle of a request

What controllers do is simply process the request to the controller in the infrastructure layer of the architecture, receive the response inside a resource and return it to the requester, nothing more.

For this I will only focus on the implementation of the DDD-Hexagonal architecture.

In the Laravel controller constructor  inject the controllers from the infrastructure layer, I initialize it and in the __invoke method.

At the end of the loop we will return the result of the request and its status code using the response object.

Controllers in the infrastructure layer are injected with the Eloquent repositories by constructor.

In the __invoke method of the controller we extract the data from the request we have received (in the case of UploadSurchargeController) we call the ValueObject "ExcelFile" to validate the excel file, another file check is made instantiating the class "ExcelUploaderService" once the check is successful we call the use case "UploadStandardSurchargeCase" to process the data that is found in the excel file.

Once the data is verified, different eloquent repositories are instantiated, which implement different interfaces, with the purpose of bringing the information from the surcharges table and standardizing it with excel and then saving the information sent through the xls file in the rate table.

Why do we use repositories?

This is the point at which the biggest infrastructure leak of the architecture is manifested when it is implemented in Laravel due to the integration of Eloquent and its models with the framework.

Eloquent is based on the active record pattern, and this represents the biggest difference with respect to a framework like Symfony, whose ORM is Doctrine, which otherwise uses the data mapper pattern.

To minimize the problem and avoid polluting our domain models, what we do here is use the models that are created in Laravel and assign an alias to it and instantiate it in the repository's constructor.

This allows us to have access to all the properties and methods of Laravel models and take advantage of the methods that Eloquent provides us.

In short, what we do is create an abstraction layer that allows us to keep our architecture safe from possible contamination and at the same time take advantage of the functionalities that the framework and its ORM provide us.

What the GetSurchargesController controller does is read the information from the database and returns it properly structured.

## Installation
```sh
git  https://github.com/jonquintero/cargofive.git cargofive
cd cargofive
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```
Generate application key:

```sh
php artisan key:generate
```
Setup env file testing:

```sh
cp .env .env.testing
```


Create a Database called cargofive and run the sql file  cargofive.sql that you can find in this project.

Run the command to standardize: 

```sh
php artisan standardize:surcharge
```

After that, make a copy of the database cargofive and name it cargofive_test

Rename env Var in env.testing
```sh
DB_DATABASE=cargofive_test
```

Run the command to start serve:

```sh
php artisan serve
```
The test only have 2 endpoints (please use Postman)
```sh
POST http://localhost:8000/api/upload
```
This method require and input called "file" which sends the excel file provided in the project

The method to get the surcharges in json format
```sh
GET  http://localhost:8000/api/surcharges
```

#To run test.

Please first copy the file ChallengeRates.xlsx into 

```sh
 ./storage/app
```
After that run:
```sh
 ./vendor/bin/pest
```



