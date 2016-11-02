sfMcommerce
========================

Technologies & versions:
- Symfony 2.7.*
- FOSUserBundle
- StofDoctrineExtensionsBundle
- LiipImagine
- HwiOauthBundle
- KnpPaginatorBundle
- WhiteOctoberBreadcrumbsBundle
- FOSJsRoutingBundle
        
Content
========================
- Create a little Ecommerce App from scratch with Symfony based on DevAndClick tutorial : https://youtu.be/2ngvCQd-l74?list=PLzPK7Fy3SN2cvLglujdweDKNMNQhHDbTT

Install
========================
- Clone project
- Make composer install
- Make php app/console doctrine:database:create
- Make php app/console doctrine:schema:update --force
- Make php app/console doctrine:fixtures:load
