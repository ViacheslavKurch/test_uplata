1. Open console in a root directory.
2. Rename .env.example to .env.
3. Run composer install.
4. Run docker-compose up -d.
5. Create database inside Postgres docker container. Database name must be equal to POSTGRES_DB_NAME from .env file.
6. Run migrations from file migration/migration.sql.
7. Run command php index.php consumer_save_parse_data inside php docker container. Leave console opened.
8. Open new tab in console and run command php index.php parse_forum_od_ua inside php docker container.