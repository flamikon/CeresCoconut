# Ceres Coconut – A Coconut Theme for Ceres 3

**Ceres Coconut** is a simple theme plugin that contains no style or design for Ceres 3. With the help of this theme, you can display your own CSS in Ceres. Furthermore, the templates of Ceres can be overridden with your own templates.

## Displaying your own CSS

After **installing** and **deploying** the plugin, you can enter your own CSS in the plugin detail view.

##### Entering your own CSS:

1. Go to **Plugins » Plugin overview**.<br /> → The plugin overview will open.
2. Click on **CeresCoconut**.<br /> → The plugin will open.
3. Click on **Files » resources » css » main.css** in the directory tree.
4. Enter your CSS code.  
7. **Save** the settings.<br /> → The CSS changes will be available after **deploying** the plugin again.

##### Activating your own CSS:

1. Go to **CMS » Container links**.
2. Go to the **Stylesheet (CeresCoconut)** area.
3. Select the container **Template: Style**.
4. **Save** the settings.<br /> → The CSS will be displayed in the online store.

## Displaying your own templates

**CeresCoconut** allows you to override the templates of **Ceres** with your own content. To do so, enter the code in the template and override the template. In the following, setting up the homepage is explained. Set up the other templates the same way.

##### Entering the code for your own homepage:

1. Go to **Plugins » Plugin overview**.<br /> → The plugin overview will open.
2. Click on **CeresCoconut**.<br /> → The plugin will open.
3. Click on **Files » resources » views » Homepage » Homepage.twig** in the directory tree.
4. Enter the code for your homepage.  
5. **Save** the settings.<br /> → The template changes will be available after deploying the plugin again.

##### Activating your own homepage:


1. Go to **Plugins » Plugin overview**.<br /> → The plugin overview will open.
2. Click on **CeresCoconut**.<br /> → The plugin will open.
3. Click on **Configuration** in the directory tree.
4. Activate **Homepage** under **Override partials and templates**.  
5. **Save** the settings.<br /> → The homepage will be displayed.

## Using your own data fields

**CeresCoconut** allows you to override the data fields of Ceres and extend the result fieldson different pages, such as the shopping cart, the category view, the single item view, etc. with your own data. In the following, editing the data fields of the single item view is explained. Set up the other pages the same way.

##### Editing the data fields of the single item view:

1. Go to **Plugins » Plugin overview**.<br /> → The plugin overview will open.
2. Click on **CeresCoconut**.<br /> → The plugin will open.
3. Click on **Files » resources » views » ResultFields » SingleItem.fields.json** in the directory tree.
4. Add other data fields.  
5. **Save** the settings.<br /> → The changes will be available after deploying the plugin again.


##### Activating your own data fields:

1. Go to **Plugins » Plugin overview**.<br /> → The plugin overview will open.
2. Click on **CeresCoconut**.<br /> → The plugin will open.
3. Click on **Configuration** in the directory tree.
4. Activate **Item data of the single item view** under **Override result fields**.  
5. **Save** the settings.<br /> → Your own data fields will be activated on the single item view.

## Using PlentyONE products in CleverReach

The CleverReach MyContent endpoint provides visible and active shop products to the CleverReach newsletter editor. It supplies the product name, short description, product image, sales price, item number, availability and shop link.

##### Configuring the endpoint in PlentyONE:

1. Install version 1.1.0 of this plugin in the shop's plugin set.
2. Go to **Plugins » Plugin overview**.
3. Open the **CeresCoconut** plugin.
4. Go to **Configuration » CleverReach product search**.
5. Enter a long random **interface password**.
6. Verify the shop URL `https://www.amikon-shop.de`.
7. Save the configuration and deploy the plugin set.

The product source URL is then:

`https://www.amikon-shop.de/rest/cleverreach/products?password=YOUR_PASSWORD`

##### Testing the endpoint:

Send a POST request containing `get=filter` to the product source URL. The JSON response must contain the **Sprache** and **Artikel** search fields. A POST request containing `get=search`, `language=de` and `product=SLM` must return matching products.

##### Configuring the product source in CleverReach:

1. Add the URL above as a **MyContent product search URL** in CleverReach. If the field is not available in your account, ask CleverReach support to enable the custom MyContent product source.
2. Create or open an email campaign.
3. Add a product layout or dynamic element.
4. Open **Insert dynamic content** and select the new product source.
5. Select the language and search by product name, item ID or variation number.
6. Select a result and insert it into the newsletter.

Do not publish the interface password or include it in regular shop pages. If it is exposed, change it in PlentyONE and CleverReach at the same time.

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE. – find further information in the [LICENSE](https://github.com/plentymarkets/plugin-ceres-Coconut/blob/master/LICENSE).
