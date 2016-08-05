# Overriding Default ASFCommerceBundle Forms

## Overriding a form type

The default forms packaged with the ASFCommerceBundle provide functionality for manage products. These forms work well with the bundle's default classes and controllers. But, as you start to add more properties to your classes or you decide you want to add a few options to the forms you will find that you need to override the forms in the bundle.

Suppose that you don't want to use some attributes in Cart entity. You have to remove this fields in the Cart form. The first step is to create your own Cart form who inherit from the ASFCommerceBundle Cart Form Type. 

```php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('some_attribute');
    }

    public function getParent()
    {
        return 'ASF\CommerceBundle\Form\Type\CartType';
    }

    public function getBlockPrefix()
    {
        return 'app_cart_type';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
```

> If you don't want to reuse the fields added in ASFCommerceBundle by default, you can omit the getParent method and configure all fields yourself.

The second step is to declare your form as a service and add a tag to it. The tag must have a name value of form.type and an alias value that is the equal to the string returned from the getName method of your form type class. The alias that you specify is what you will use in the ASFCommerceBundle configuration to let the bundle know that you want to use your custom form.

```xml
<!-- app/config/services.xml -->
<?xml version="1.0" encoding="UTF-8" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

    <services>

        <service id="app.form.cart" class="AppBundle\Form\CartType">
            <tag name="form.type" alias="app_cart_type" />
        </service>

    </services>

</container>
```

The final step is to update the ASFCommerceBundle Configuration for use your Cart Form Type :

```yaml
# app/config/config.yml
asf_commerce:
    cart:
        entity: AppBundle\Entity\Cart
        form:
            type: AppBundle\Form\CartType
            name: app_cart_type
```
