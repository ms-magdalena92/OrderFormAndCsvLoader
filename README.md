# Order Form And CSV Product List Loading App
## Recruitment Task (PHP MVC-based web app)

### Exercise 1: Functionality 
- order form with all inputs validation
- dynamically adding and removing products (max. 10 rows)
- total order amount calculating
- checkout page

### Exercise 2: Functionality
- loading product list from CSV file
- saving loaded data to database
- validation of each csv file's row
- all/added/invalid row count feedback table

### Screenshots
![orderForm1](https://user-images.githubusercontent.com/59318234/120064812-7a8e1700-c06e-11eb-98e6-ea5d39992065.png)

![orderForm2](https://user-images.githubusercontent.com/59318234/120064815-7cf07100-c06e-11eb-9efd-4ff6b23d11b8.png)

![orderForm3](https://user-images.githubusercontent.com/59318234/120064816-7cf07100-c06e-11eb-96d8-8ccfb197406e.png)

![orderForm4](https://user-images.githubusercontent.com/59318234/120064817-7d890780-c06e-11eb-84cc-2684617770a2.png)

![orderForm5](https://user-images.githubusercontent.com/59318234/120064914-0011c700-c06f-11eb-8c0d-6a2616ffebdb.png)

![orderForm6](https://user-images.githubusercontent.com/59318234/120064917-0142f400-c06f-11eb-9acd-dc9bf6ad8fe1.png)

### Installation

1. Download git repository
2. Install a web server, database server and PHP on your computer
3. Configure the root of your web server in 'httpd.conf' file: change localhost document root directory to public folder of downloaded repository
(e.g. "{pathToDownloadedRepository}/recruitment-task-master/public")
4. Restart your web server
5. Create 'products' database in your database server. Import products.sql file to the created database. All database config settings are stored in App\Config.php file of downloaded repository.
6. Go to http://localhost/ in your browser
