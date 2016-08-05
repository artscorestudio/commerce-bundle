# ASFCommerceBundle entities

CommerceBundle allows you to create and manage carts, discounts, catalogs and taxes. As you will see, there are not entities that can be directly persisted in this bundle. This bundle provides a model that you can use. So, the bundle provides models and interfaces.

So, for persistance of the entities, you have to create your own bundle who inherits from ASFCommerceBundle or not but where entities can inherit from ASFCommerceBundle entities.

> For more information about bundle inheritance, check [Symfony documentation](http://symfony.com/doc/current/cookbook/bundles/inheritance.html).

> All mapping informations are controlled throught the annoations in entities. For further informations about annotations, please check [Symfony documentation : Databases and Doctrine](http://symfony.com/doc/current/book/doctrine.html).

## CartModel and CartInterface

If you want to create a Cart entity, a model class is available that you can expand or an interface to implement. If you create your Cart entity from scratch, do not forget to implement the CartInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Cart/CartModel.php
namespace ASF\CommerceBundle\Model\Cart;

class CartModel implements CartInterface
{
    // [...]
}
```

[View source](../../Model/Cart/CartModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Cart/CartInterface.php
namespace ASF\CommerceBundle\Model\Cart;

interface CartInterface
{
	/**
	 * @return string
	 */
	public function getName();
	
	// [...]
}
```

[View source](../../Model/Cart/CartInterface.php).

## Discount and DiscountInterface

If you want to create a Discount entity, a model class is available that you can expand or an interface to implement. If you create your Discount entity from scratch, do not forget to implement the DiscountInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Discount/Discount.php
namespace ASF\CommerceBundle\Model\Discount;

class DiscountModel implements DiscountInterface
{
    // [...]
}
```

[View source](../../Model/Discount/DiscountModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Discount/DiscountInterface.php
namespace ASF\CommerceBundle\Model\Discount;

interface catalogInterface
{
    /**
     * @return string
     */
    public function getName();
	
	// [...]
}
```

[View source](../../Model/Discount/DiscountInterface.php).

## Tax and TaxInterface

If you want to create a Tax entity, a model class is available that you can expand or an interface to implement. If you create your Tax entity from scratch, do not forget to implement the TaxInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Tax/Tax.php
namespace ASF\CommerceBundle\Model\Tax;

class TaxModel implements TaxInterface
{
    // [...]
}
```

[View source](../../Model/Tax/TaxModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Tax/TaxInterface.php
namespace ASF\CommerceBundle\Model\Tax;

interface catalogInterface
{
    /**
     * @return string
     */
    public function getName();
	
	// [...]
}
```

[View source](../../Model/Tax/TaxInterface.php).

## [Optionnal] Catalog and CatalogInterface

If you want to create a Catalog entity, a model class is available that you can expand or an interface to implement. If you create your Catalog entity from scratch, do not forget to implement the CatalogInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Catalog/Catalog.php
namespace ASF\CommerceBundle\Model\Catalog;

class CatalogModel implements CatalogInterface
{
    // [...]
}
```

[View source](../../Model/Catalog/CatalogModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Catalog/CatalogInterface.php
namespace ASF\CommerceBundle\Model\Catalog;

interface catalogInterface
{
    /**
     * @return string
     */
    public function getName();
	
	// [...]
}
```

[View source](../../Model/Catalog/CatalogInterface.php).
