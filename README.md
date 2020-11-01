# api_jobsfree
API aplikasi Jobsfree

############################## CodeIgniter4 ############################## 

basic configuration
1.  import database dengan file sql pada folder sql/api_jobsfree.sql
2.  pergi ke file .env
3.  sesuaikan baseurl pada baris app.baseURL = 'http://localhost:8080/'
4.  sesuaikan user dan password database

    database.default.hostname = localhost
    database.default.database = jobsfree
    database.default.username = root
    database.default.password = 123
    database.default.DBDriver = MySQLi
    database.default.DSN = 'mysql:dbname=jobsfree;host=localhost';

############################## HTTP REQUEST ############################## 

#############################################
                USERS
#############################################

request data 'users'
url : http://localhost:8080/users/
http request : GET
params: username, password
response SUCCESS :
    status: 200,
    id_user: "1",
    username: "tes"
response FAIL :
    "status": 404,
    "error": 404,
    "messages": {
        "error": "Item not Found"
    }

#############################################
                SERVICES
#############################################
