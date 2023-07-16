# UseCase and task

We will be use methodology UseCase,Task and DTO 
1. What is UseCase ? 
### Answer
UseCase is business logic class where we will be written some business logic and one UseCase class should be created for each controller method.
 Example we Have controller method which name is getActiveUser and For this method we will be to create class GetActiveUserUseCase and 
 we use this class with DI (Dependency Injection).

2.  What is Task class ?
### Answer
 Task is common class which we will be use some general logic Example we Have rule for check user Type and this logic can be need a lot of times and for this
 rule we will be use Task class. Example CheckUserIsActiveTask

3. What is DTO ?
### Answer
 DTO (Data Transfer Object) is ValueObject class and request do not enter the UseCase, UseCase can take Only DTO ValueObject class
 if our parameter greater than 3 we should create and use DTO

# Code Convention 
1. Variable name is CamelCase. Example subTitle, userType
2. Function and Class name is PascalCase. Example GetSubTitle, GetUserType
3. Function and Class name with prefix Check will be check Soma condition and if condition is true will be return some Exception Example: [CheckUserTypeForDeveloperTask](https://github.com/parmonov98/devstart-api/blob/main/app/Tasks/User/CheckUserTypeForDeveloperTask.php)
4. Function and Class name with prefix Is will be return boolean 

For see how it is see look in Class [UserController](https://github.com/parmonov98/devstart-api/blob/main/app/Http/Controllers/ApiController/User/UserController.php)
