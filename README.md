# Uniphpant SPA v1.0
* **version**: 	`0.1`
* **app-identifier**: `uniphpant-standalone-single-page-application-1.0`

##Middleware##
Middleware classes are declared at `./app/spa/middleware.php` and it uses LIFO method.

Middleware listed below is responsible for reading current site settings.

|MiddlewareName               |Source                         |Request Attr    |                     |Cache                            |Description|
|-----------------------------|-------------------------------|----------------|---------------------|---------------------------------|-----------|
|**CurrentHostMiddleware**    |UriInterface                   |current_host    |host\{:port}         |NA                               |
|**HostNameMiddleware**       |UriInterface                   |host_url        |schema://host\{:port}|NA                               |
|**SPASettingsMiddleware**    |./app/spa/settings.php:spa     |spa_settings    |                     |NA                               |
|**SiteDeclarationMiddleware**|./sites/site-*.\{json,yaml,php}|site_declaration|                     |./var/cache/sites.php            |Find by current_host
|**SiteIdMiddleware**         |                               |site_id         |                     |NA                               |
|**SiteSettingsMiddleware**   |./sites/{DIR_PATH}/site.json   |site_settings   |                     |./sites/\{DP}/var/cache/site.php |
