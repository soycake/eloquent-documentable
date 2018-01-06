# Eloquent Documentable
Creation of documents number to support ISO for your Eloquent models in Laravel framework


1. Install the package via Composer.
    ```sh
    $ composer require baraear/eloquent-documentable
    ```
2. Register the service provider in `config/app.php`.
    ```php
    /*
    * Package Service Providers...
    */
    Baraear\Documentable\DocumentableServiceProvider::class,
    ```
3. Update your database column of the table that what you want to use documentable.
    ```php
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('documentable');
        });
    }
    ```
     
4. Update your eloquent models.
    ```php
    use Baraear\Documentable\Documentable;
    
    class Invoice extends Model
    {
        use Documentable;
    
        /**
         * Return the documentable configuration array for this model.
         *
         * @return array
         */
        public function documentable()
        {
            return [
                'prefix' => 'IV',
                'length' => 4
            ];
        }
    }
    ```
    > **NOTE**: By default if not set the length is will equal to 4.

When you create new invoice the data will like this.
```sql
+----+--------------+---------------------+---------------------+
| id | documentable | created_at          | updated_at          |
+----+--------------+---------------------+---------------------+
|  1 | IV1801060001 | 2018-01-06 13:06:51 | 2018-01-06 13:06:51 |
+----+--------------+---------------------+---------------------+
1 row in set (0.00 sec)
```