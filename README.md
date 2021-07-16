# Uniphpant SPA v1.0
* **version**: 	`0.1`
* **app-identifier**: `uniphpant-standalone-single-page-application-1.0`

##Environmental variables##
* **APP_ENV**: production|staging|development|testing
* ***SITES_DIRPATH**: <project\>/sites/\*/*
* ***CACHE_DIRPATH**: <project\>/var/cache/*
* ***SITE_DIRPATH**: <project\>/sites/\{SITE_DIRPATH}/*
* ***SITE_CACHE_DIRPATH**: <project\>/sites/\{SITE_DIRPATH}/var/cache/*

## #TODO:
* Start to use `.env` files.
##.env files
The .env files might be found in two locations. One is in ./ and another might be found in ./sites/*/

###./.env file:
* ***APP_ENV**: DEVELOPMENT*
* ***APP_CACHE_ENABLED**: 0*
* ***SITES_DIRPATH**: "sites/"*
* ***CACHE_DIRPATH**: "var/cache/"*

###./sites/*/.env file:
* ***SITE_CACHE_ENABLED**: 0* - determines if sites `config` and `settings` should be cached.
* ***SITE_ID**: "default"* - If this is set, then it cannot be overwritten in site configs.

##Middleware##
Middleware classes are declared at `./app/spa/middleware.php` and it uses LIFO method.

Middleware listed below is responsible for reading current site settings.

|MiddlewareName               |Source                                      |Request Attr    |                     |Cache                            |Description|
|-----------------------------|--------------------------------------------|----------------|---------------------|---------------------------------|-----------|
|**CurrentHostMiddleware**    |UriInterface                                |current_host    |host\{:port}         |NA                               |
|**HostNameMiddleware**       |UriInterface                                |host_url        |schema://host\{:port}|NA                               |
|**SPASettingsMiddleware**    |./app/spa/settings.php:spa                  |spa_settings    |                     |NA                               |Gets cache settings. 'declaration','settings','config'
|**SiteDeclarationMiddleware**|./sites/site-*.\{json,yaml,php}             |site_declaration|                     |./var/cache/sites.php            |Find by current_host
|**SiteIdMiddleware**         |                                            |site_id         |                     |NA                               |
|**SiteSettingsMiddleware**   |./sites/\{DP}/site.json               |site_settings   |                     |./sites/\{DP}/var/cache/site.php |
|**SiteConfigMiddleware**     |./sites/\{DP}/config/*.\{json,yaml,php}|site_config     |                     |                                 |
|**TableGatewayMiddleware**   |                                            |                |                     |                                 |


### Table Gateway ###
Table gateways are assembled in **TableGatewayMiddleware**
dependencies: SiteConfigMiddleware
takes `table_gateway` and `data_source` index from siteConfig. In `table_gateway` iteration matches single `data_source`, injects the latter to LaminasDbAdapter and then creates TableGateway and adds the result to attribute collection. 
create `acme.php` in ./sites/default/config ; inside file create array with index `site->config` #TODO
#TODO describe db migration and seeding. seeding from site level and migration from app level.

table_gateway:
table gateways maybe taken from requests attribute `table_gateway`.



#TODO: HydratingResultSet && MyClassTable and https://stackoverflow.com/questions/12757808/zend-framework-2-zend-db-resultset-resultset-toarray-doe-not-return-records/19102697