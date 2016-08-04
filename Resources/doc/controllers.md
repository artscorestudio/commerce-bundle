# Overriding Default ASFCommerceBundle Controllers

The default controllers packaged with the ASFCommerceBundle provide a lot of functionality that is sufficient for general use cases. But, you might find that you need to extend that functionality and add some logic that suits the specific needs of your application.

> Overriding the controller requires to duplicate all the logic of the action. Most of the time, it is easier to use the events to implement the functionality. Replacing the whole controller should be considered as the last solution when nothing else is possible.

The first step to overriding a controller in the bundle is to create a child bundle whose parent is ASFCommerceBundle. The following code snippet creates a new bundle named AcmeProductBundle that declares itself a child of ASFCommerceBundle.

```php
// src/Acme/CommerceBundle/AcmeCommerceBundle.php

namespace Acme\CommerceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeCommerceBundle extends Bundle
{
    public function getParent()
    {
        return 'ASFCommerceBundle';
    }
}
```
Now that you have created the new child bundle you can simply create a controller class with the same name and in the same location as the one you want to override. This example overrides the DefaultController by extending the ASFCommerceBundle DefaultController class and simply overriding the method that needs the extra functionality.