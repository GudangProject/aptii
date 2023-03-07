JCMS | APTII




## Informasi Update

Update column message in configurations table, you can run it :
```bash
php artisan migrate --path="database/migrations/2023_03_07_173504_add_column_message_in_table_configuration.php"
```


## How to install

```bash
git clone https://github.com/jarwonozt/jcms.git

cp .example.env .env

php artisan migrate

php artisan storage:link

php artisan db:seed --class=User
```
