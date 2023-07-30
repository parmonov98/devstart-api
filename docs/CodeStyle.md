# UseCase and Task

We will be using methodology UseCase, Task and DTO 
1. What is UseCase ? 
### Answer
UseCase is a class where we will keep business logic. 
- a UseCase class should be created for each controller method.
- UseCase classes can accept any primitive data such as string, array, integer, and bool. 
- if quantity of arguments is more than 3 then accepts DTO object
- can return any data such as string, array, integer, and bool
- must return BusinessLogicException in case of error 
 # example we have a controller method called getActiveUser and for this method we should create a class with name of GetActiveUserUseCase and 
 we use this class with DI (Dependency Injection).
- Task Class can be injected into __construct of UseCase classes

2.  What is Task class ?
### Answer
 Task is a common class which we will be using it as a general logic. 
#example 
we have a rule for checking user type and this logic can be needed in many places. 
thereby the Task class must be callable from any point of project. from "Jobs", from "Controllers" and etc. 
accordingly as a convention we name task classes like this: CheckUserIsActiveTask

3. What is DTO ?
### Answer
 DTO (Data Transfer Object) is ValueObject class 
- UseCase classess don't accept request objects

# Code Convention 
1. Variable name is CamelCase. Example subTitle, userType
2. Function and Class name is PascalCase. Example GetSubTitle, GetUserType
3. Function and Class name with prefix Check as prefix, and ClassName for that condition. 
- if condition is true will be return some Exception 
#example: [CheckUserTypeForDeveloperTask]
(https://github.com/parmonov98/devstart-api/blob/main/app/Tasks/User/CheckUserTypeForDeveloperTask.php)

4. Function and Classes with name containing prefix Is must return boolean value

examples you can find in the file [UserController](https://github.com/parmonov98/devstart-api/blob/main/app/Http/Controllers/ApiController/User/UserController.php)
