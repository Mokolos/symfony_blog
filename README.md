1. - Ensure have php 7.4.0 or above installed, use wamp or xampp or whatever
   - install composer then run:
   >composer install
   > 
2. prepare your .env file

    - change on DATABASE_URL on line 34 
    it should be like 
    >DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
    
    example 
    >DATABASE_URL="mysql://root:@127.0.0.1:3306/blog?serverVersion=mariadb-10.4.10"
    
    - be careful with the serverVersion, it may cause a bug 
    in the example mine is mariadb-10.4.10
  
   
3. create the database by running this command:
   >php bin/console doctrine:database:create
   
4. run migration:
    > php bin/console make:migration
    
    then
    
    >php bin/console doctrine:migrations:migrate

5. install symfony
   - go here https://symfony.com/download
   - check by type command:
   > symfony -v
   > 

6. run a local server:
   >symfony server:start
   > 
   
   - you should see something like
     >[OK] Web server listening
      >  
     >The Web server is using PHP CGI 7.4.0
        >
     >http://127.0.0.1:8000
     > 
    - click on the link, here you are 


