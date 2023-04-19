> # Star
> To install this project :
> ```bash
> composer create-project xety/star <application_name>
> ```
>
> Then we will migrate and seed the database :
> ```bash
> php artisan migrate --seed
> ```
>
> Then we need to do a symlink from `public/storage` to `storage/app/public` to access and display the Stars images :
> ```bash
> php artisan storage:link
> ```
> Then we need to install hte JS dependencies and build the JS/CSS files :
> ```bash
> npm install
> npm run build
> ```
>
> Optional : if you want to use Homestead, you will need to modify the `Homestead.yaml` to fit your needs.
>
> Now the application is working. To connect to the pre-installed account :
>```bash
> Email : emeric@star.com
> Password : password
