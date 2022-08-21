# LARAVEL

## environment

```bash
NOVAPOSHTA_API_KEY=KEY
NOVAPOSHTA_URL_JSON=https://api.novaposhta.ua/v2.0/json/
```

## admin panel

```bash
php artisan voyager:install

php artisan voyager:admin your@email.com --create
```
or
```bash
php artisan voyager:install --with-dummy

/admin
email: admin@admin.com
password: password
```



# VUE
## environment
Повинно закінчуватись на "api". Без слеша в кінці:
```bash
VUE_APP_API_URL=http://localhost:80/api
```


