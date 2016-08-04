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

## Category and CategoryInterface

Product entities have a relation with a Category entity. Like Product entity, a model class is available that you can expand or an interface to implement. If you create your Category entity from scratch, do not forget to implement the CategoryInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Category/Category.php
namespace ASF\CommerceBundle\Model\Category;

class CategoryModel implements CategoryInterface
{
    // [...]
}
```

[View source](../../Model/Category/CategoryModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Category/CategoryInterface.php
namespace ASF\CommerceBundle\Model\Category;

interface CategoryInterface
{
    /**
     * @return string
     */
    public function getName();
	
	// [...]
}
```

[View source](../../Model/Category/CategoryInterface.php).

## [Optionnal] Brand and BrandInterface

Product entities can have a relation with a Brand entity. Like Product entity, a model class is available that you can expand or an interface to implement. If you create your Brand entity from scratch, do not forget to implement the BrandInterface interface, which will be asked by the functionality of the bundle to ensure that your entity get the methods needed.

```php
<?php
// @ASFCommerceBundle/Model/Brand/Brand.php
namespace ASF\CommerceBundle\Model\Brand;

class BrandModel implements BrandInterface
{
    // [...]
}
```

[View source](../../Model/Brand/BrandModel.php).

```php
<?php
// @ASFCommerceBundle/Model/Brand/BrandInterface.php
namespace ASF\CommerceBundle\Model\Brand;

interface BrandInterface
{
    /**
     * @return string
     */
    public function getName();
    
    // [...]
}
```

[View source](../../Model/Brand/BrandInterface.php).

## [Optionnal] ProductPackInterface and ProductPackProductInterface

> This feature was disabled (not tested).

A product can be a "collection" of products, this is a pack. ASFCommerceBundle provides two interfaces that you can implements : ProductPackInterface which is a Product with additionnal parameters and ProductPackProductInterface which is an interface to implements for create an entity representing the relation between Product entities and ProductPack entity.

```php
<?php
// @ASFCommerceBundle/Model/Product/ProductPackInterface.php
namespace ASF\CommerceBundle\Model\Product;

interface ProductPackInterface
{
    /**
     * @return ArrayCollection
     */
    public function getProducts();

    /**
     * @param \ASF\CommerceBundle\Model\Product\ProductInterface $product
     *
     * @return \ASF\CommerceBundle\Model\Product\ProductPackInterface
     */
    public function addProduct(ProductInterface $product);

    /**
     * @param \ASF\CommerceBundle\Model\Product\ProductInterface $product
     *
     * @return \ASF\CommerceBundle\Model\Product\ProductPackInterface
     */
    public function removeProduct(ProductInterface $product);
}
```

[View source](../../Model/Product/ProductPackInterface.php).

```php
<?php
// @ASFCommerceBundle/Model/Product/ProductPackProductInterface.php
namespace ASF\CommerceBundle\Model\Product;

interface ProductPackProductInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return \ASF\CommerceBundle\Model\Product\ProductPackInterface
     */
    public function getProductPack();

    /**
     * @param \ASF\CommerceBundle\Model\Product\ProductInterface $product
     *
     * @return \ASF\CommerceBundle\Model\Product\ProductPackInterface
     */
    public function setProductPack(ProductPackInterface $product);

    /**
     * @return \ASF\CommerceBundle\Model\Product\ProductInterface
     */
    public function getProduct();

    /**
     * @param \ASF\CommerceBundle\Model\ProductInterface $product
     *
     * @return \ASF\CommerceBundle\Model\Product\ProductInterface
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return numeric
     */
    public function getOrder();

    /**
     * @param numeric $order
     *
     * @return \ASF\CommerceBundle\Model\Product\ProductInterface
     */
    public function setOrder($order);
}
```

[View source](../../Model/Product/ProductPackProductInterface.php).

