# Project setup
### Run:
    composer install
    npm install
    php artisan key:generate
    php artisan storage:link

### Duplicate .env.example e rename .env (modify some data as DB, API_KEY, ...)

### Posts' default img should be in /storage/app/public/uploads, take it from main folder, create uploads folder and move it there
<br>

### If a new db is created (PHPMyAdmin), run
    php artisan migrate
    php artisan db:seed
<br>

-----------------------------

## Access with ADMIN credentials:
    - Mail: admin@admin
    - Password: adadadad

## Access with GUEST credentials:
    - Mail: guest@guest
    - Password: adadadad

## If role == admin, you see all posts, included yours and you can modify or delete them all
## If role == guest, you see only your posts and you can modify or delete only them
