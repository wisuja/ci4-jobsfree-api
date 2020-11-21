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
    database.default.DSN = 'mysql:dbname=jobsfree;host=localhost

############################## HTTP REQUEST ############################## 

##Login
1. url : http://localhost:8080/login/
2. method: POST
3. body/params: email, password


##lapak (dapatkan semua data lapak)
1. url : http://localhost:8080/lapak/
2. method : GET
3. body/params: -

##detail lapak
1. url : http://localhost:8080/lapak/$id
2. method : GET
3. body/params: -

##get lapak berdasarkan category
1. url : http://localhost:8080/category/$idcategory 
2. method : GET
3. body/params: -

##buat lapak baru
1. url : http://localhost:8080/lapak
2. method : POST
3. body/params: user_id, category_id, title, description, requirement, price_tag, working_hours, status

