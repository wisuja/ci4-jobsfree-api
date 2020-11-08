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

##Login
url : http://localhost:8080/login/
method: POST
body/params: email, password


##lapak (dapatkan semua data lapak)
url : http://localhost:8080/lapak/
method : GET
body/params: -

##detail lapak
url : http://localhost:8080/lapak/$id
method : GET
body/params: -

##get lapak berdasarkan category
url : http://localhost:8080/category/$idcategory 
method : GET
body/params: -

##buat lapak baru
url : http://localhost:8080/lapak
method : POST
body/params: user_id, category_id, title, description, requirement, price_tag, working_hours, status

