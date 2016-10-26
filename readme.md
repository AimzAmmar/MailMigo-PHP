#MailMigo PHP Client
This is simple MailMigo PHP client to work with MailMigo API. The client uses CURL to send API requests.
##Instalation
Simply download the main file mailmigo_api.php in your project and include it to start working with it.
##Initialization
```php
require 'mailmigo.php';
$api = new mailmigo("YOUR_API_KEY");
```

##Request
```php
//Get All
$response = $api->get('/lists');
//Get One
$response = $api->get('/lists',$LIST_ID);
//Add
$response = $api->post('/lists',array(
    'POST_DATA'
));
//Edit
$response = $api->put('/lists,$LIST_ID, array(
    'name' => 'New name'
));
//Delete
$response = $api->delete('/lists','DELETE_LIST_ID');
```

#Docs
To documentation can be found here https://www.mailmigo.com/docs/api
