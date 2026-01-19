# Railway Deployment Guide for Laravel

This guide will walk you through deploying your Laravel Brick Game to Railway.

## 1. Push Your Latest Changes
I have made a small modification to `app/Providers/AppServiceProvider.php` to ensure your app works securely (HTTPS) on Railway.
**Please commit and push these changes to GitHub before proceeding.**

## 2. Create Project on Railway
1. Go to your [Railway Dashboard](https://railway.app/dashboard).
2. Click **"New Project"**.
3. Select **"Deploy from GitHub repo"**.
4. Choose your repository.
5. Click **"Deploy Now"**.
   > *Note: The first build might fail or the app might error because we haven't set up the database yet. This is normal.*

## 3. Add a MySQL Database
Your `Dockerfile` is configured for MySQL, so you **MUST** choose MySQL (not PostgreSQL).
1. Click on your project card to open the Project View.
2. Click the **"New"** button (or "Create") in the top right or on the canas.
3. Select **"Database"** -> **"MySQL"**.
4. Wait for the MySQL service to initialize.

## 4. Configure Environment Variables
Now we need to tell your Laravel app how to connect to this database.

1. Click on your **Laravel App Service** (the card with your repo name).
2. Go to the **"Variables"** tab.
3. You need to add the following variables.
   - **APP_KEY**: Run `php artisan key:generate --show` in your local terminal and copy the value (starts with `base64:...`). Use that here.
   - **APP_DEBUG**: `false`
   - **APP_ENV**: `production`
   - **APP_URL**: `https://<your-railway-url>.up.railway.app` (You can find your domain in the "Settings" tab -> "Networking", or add it later).
   
   **Database Variables (The Important Part):**
   Railway creates "Shared Variables" for the database.
   - Click **"New Variable"**.
   - For `DB_CONNECTION`, enter `mysql`.
   - The easiest way to link the database is to use the **"Reference"** feature:
     - Type `DB_HOST`, then select the value from the dropdown (it usually shows `MySQL` -> `MYSQLHOST`).
     - `DB_PORT` -> `MySQL` -> `MYSQLPORT`
     - `DB_DATABASE` -> `MySQL` -> `MYSQLDATABASE`
     - `DB_USERNAME` -> `MySQL` -> `MYSQLUSER`
     - `DB_PASSWORD` -> `MySQL` -> `MYSQLPASSWORD`

   **Summary of Key Variables:**
   ```text
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:YOUR_KEY_HERE
   DB_CONNECTION=mysql
   DB_HOST=${{MySQL.MYSQLHOST}}
   DB_PORT=${{MySQL.MYSQLPORT}}
   DB_DATABASE=${{MySQL.MYSQLDATABASE}}
   DB_USERNAME=${{MySQL.MYSQLUSER}}
   DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
   ```

## 5. Deployment
Once you add these variables, Railway usually triggers a redeploy.
1. Go to the **"Deployments"** tab.
2. Check the logs.
3. If it says "Server running on [http://0.0.0.0:xxxx]", it's working!

## 6. Run Migrations (Database Setup)
Your database is currently empty. You need to run the `php artisan migrate` command.
1. On your Laravel Service page, go to the **"Settings"** tab.
2. Scroll down to **"Deploy"** > **"Deploy Command"**.
3. Enter: `php artisan migrate --force`
4. This ensures that every time you deploy, the database is updated.
5. Manually trigger a redeploy if it doesn't start automatically.

## Debugging
- If you see a "500 Server Error", check the **"Deployments"** -> **"View Logs"**.
- Common issues:
  - Missing `APP_KEY`.
  - Wrong Database credentials (verify the variables match the MySQL service).
  - Use `pdo_pgsql` requested but `pdo_mysql` installed (Make sure you chose MySQL service!).

Enjoy your game!
