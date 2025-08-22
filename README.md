# Sybre mvc
  It's just another framework that came about to simplify building website projects. There are already a lot of frameworks out there. Some are too complicated to learn for a quick project.  
    
  This project aims to be an easy to understand framework that could put one's mind at ease while using it.  
    
  Laravel's blade templating system is a great way to implement websites. This framework uses/relies on eftec/BladeOne as its templating engine.  
  
  ## Requirements
  1. nginx (preferred) or Apache
  2. PHP >= version 8.1
  3. Optional: Mariadb or MySQL
  4. A working knowledge of how to configure the above
  
  ## Installation
  1. Create project folder
  2. unzip the distribution or use git to download
  
  ## Typical workflow
  1. edit App/Routes/web.php to add your route i.e. `$router->get("/dashboard","App\Controllers\dashboardController.php");`
  2. create App/Controllers/dashboardController.php
   
    <?php
    namespace App\Controllers;
    use lib\Controller;


    class dashboardController extends Controller {
        $this->set_template_name("dashboard");
        $this->show();
    }
    
  3. create App/Views/dashboard.blade.php
    
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Dashboard</title>
        </head>
        <body>
          <h1>Dashboard</h1>
          ...dashboard code...
        </body>
    </html>
    