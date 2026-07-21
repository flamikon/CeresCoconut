

![plentymarkets Logo](http://www.plentymarkets.eu/layout/pm/images/logo/plentymarkets-logo.jpg)

# CeresCoconut

A Coconut theme for Ceres 3.

The Amikon edition includes a password-protected CleverReach MyContent endpoint. It lets the CleverReach newsletter editor search for PlentyONE items and import product names, descriptions, images, prices and shop links.

## CleverReach product source

After deploying the plugin, configure the interface password in the plugin settings. The product source URL is:

`https://www.amikon-shop.de/rest/cleverreach/products?password=YOUR_PASSWORD`

CleverReach calls the endpoint by POST and supplies `get=filter` or `get=search` according to the MyContent protocol.


## Requirements

This is a plugin for [plentymarkets 7](https://www.plentymarkets.com). This plugin is a theme for [Ceres](https://github.com/plentymarkets/plugin-io). The [IO](https://github.com/plentymarkets/plugin-ceres) plugin is required to run the plentymarkets **Ceres** plugin.

## Installing

For detailed information about plugin provisioning refer to [plentymarkets developers](https://developers.plentymarkets.com/dev-doc/basics#plugin-provisioning).

## Plugin documentation

- Learn how to create your [first plentymarkets plugin](https://developers.plentymarkets.com/tutorials/helloworld)
- Installing a [template](https://developers.plentymarkets.com/tutorials/design)
- Developing [template plugins](https://developers.plentymarkets.com/dev-doc/template-plugins)
- The plentymarkets [plugin interface](https://developers.plentymarkets.com/dev-doc/basics#introduction-interface)
- The plentymarkets [REST API](https://developers.plentymarkets.com/rest-doc/introduction)

## Join our community

Sign up today and become a member of our [forum](https://forum.plentymarkets.com/c/plugin-entwicklung). Discuss the latest trends in plugin development and share your ideas with our community.

## Versioning

Visit our forum and find the latest news and updates in our [Changelog](https://forum.plentymarkets.com/c/changelog?order=created).

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE - see the [LICENSE](/LICENSE) file for details.
