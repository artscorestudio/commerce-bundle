# Routing Configuration

By default, the routing file *@ASFCommerceBundle/Resources/config/routing/default.xml* imports all the routing files and enables all the routes according to the default bundle's configuration.

```yaml
asf_commerce:
    resource: "@ASFCommerceBundle/Resources/config/routing/all.yml"
```

So, the bundle import routes for Cart, CartCategory entities and routes for ajax requests used by search form types.

If you enable the support of all entities provides by the bundle, you can import the routing file *@ASFCommerceBundle/Resources/config/routing/all.xml*.

```yaml
asf_commerce:
    resource: "@ASFCommerceBundle/Resources/config/routing/all.yml"
```

In the case you want to enable or disable the different available routes, just use the single routing configuration files.

```yaml
# app/config/routing.yml
asf_commerce_cart:
    prefix: /cart
    resource: "@ASFCommerceBundle/Resources/config/routing/cart.yml"

# etc.

```