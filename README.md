### Description
- Cargo Agent management system is an app for cargo services.  
- Cargo Agent concept is **Join Personal Agent** means this app is for other cargo company who doesnt have online system to deliver their service to customer. So they can join to use our system to create online waybill and charges them for each waybill.  
- This module is free, if this module is not fit to your business and you need to create custom cargo application you can contact me [aalfiann on Github](https://github.com/aalfiann).

### Detail module information

1. Namespace >> **modules/cargoagent**
2. Zip Archive source >> 
    https://github.com/aalfiann/reSlim-modules-cargoagent/archive/master.zip

### How to Integrate this module into reSlim?

1. Download zip then upload to reSlim server to the **modules/**
2. Extract zip then you will get new folder like **reSlim-modules-cargoagent-master**
3. Rename foldername **reSlim-modules-cargoagent-master** to **cargoagent**
4. Done

### How to Integrate this module into reSlim with Packager?

1. Make AJAX GET request to >>
    http://**{yourdomain.com}**/api/packager/install/zip/safely/**{yourusername}**/**{yourtoken}**/?lang=en&source=**{zip archive source}**&namespace=**{modul namespace}**

### How to integrate this module into database?
This module is require integration to the current database.

1. Make AJAX GET request to >>
    http://**{yourdomain.com}**/api/cargoagent/install/**{yourusername}**/**{yourtoken}**

### Security Tips
After successful integration database, you must remove the **install** and **uninstall** router.  
Just make some edit in the **cargoagent.router.php** file manually.

### Requirement
- This module is require module [Deposit](https://github.com/aalfiann/reslim-modules-deposit) installed on reSlim.