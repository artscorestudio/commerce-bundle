# ASFCommerceBundle Configuration Reference

## Default configuration

```yaml
asf_commerce:
    cart:
        entity: null
        form:
            type: "ASF\CommerceBundle\Form\Type\CartType"
            name: "cart_type"
    catalog:
        entity: null
        form:
            type: "ASF\CommerceBundle\Form\Type\CatalogType"
            name: "catalog_type"
    discount:
        entity: null
        form:
            type: "ASF\CommerceBundle\Form\Type\DiscountType"
            name: "discount_type"
    tax:
        entity: null
        form:
            type: "ASF\CommerceBundle\Form\Type\TaxType"
            name: "tax_type"
```

### Cart, Catalog, Discount and tax parameters

This parameters is for configurate forms for entities. If you want to customize forms according  to your needs, you can override forms without rewrite all the controllers or forms. For further information, check documentation on [overriding forms](forms.md).