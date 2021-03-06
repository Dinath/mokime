## Installation

For dev environment, I am using [docker-compose](https://docs.docker.com/compose/).

* Create a `mokime` directoy and go in there `mkdir -vp mokime/db`
* Download WordPress friom `mokime` directory
  * `wget https://wordpress.org/latest.tar.gz`
  * `tar -xzvf latest.tar.gz`
  * `rm -v latest.tar.gz`
* Get the theme : `cd wordpress/wp-content/themes && git clone git@github.com:Dinath/mokime.git`

```
.
├── db
├── docker-compose.yaml
└── wordpress
```
* Add the following `docker-compose.yaml` file

```yaml
version: '3.1'

services:

  wordpress:
    image: wordpress
    restart: always
    ports:
      - 8080:80
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: exampleuser
      WORDPRESS_DB_PASSWORD: examplepass
      WORDPRESS_DB_NAME: exampledb
    volumes:
      - ./wordpress:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:5.7
    restart: always
    environment:
      MYSQL_DATABASE: exampledb
      MYSQL_USER: exampleuser
      MYSQL_PASSWORD: examplepass
      MYSQL_RANDOM_ROOT_PASSWORD: '1'
    volumes:
      - ./db:/var/lib/mysql

volumes:
  wordpress:
  db:
```

* Start it! 

```sh
docker-compose up --build
```
* Simple login into your WordPress admin panel.

## Access

* WordPress Administration : http://localhost:8080/wp-admin/
* WordPress Front-Office : http://localhost:8080

## Demo content

https://codex.wordpress.org/Theme_Unit_Test

Or Download a copy from https://raw.githubusercontent.com/WPTRT/theme-unit-test/master/themeunittestdata.wordpress.xml

1. Import test data into your WordPress install by going to Tools => Import => WordPress
1. Select the XML file from your computer
1. Click on "Upload file and import".
1. Under "Import Attachments," check the "Download and import file attachments" box and click submit.
   Note: you may have to repeat the Import step until you see "All Done" to obtain the full list of Posts and Media.

## Plugins to install

* [Theme Check](https://fr.wordpress.org/plugins/theme-check/)
* [Theme Sniffer](https://wordpress.org/plugins/theme-sniffer/)
* [Loco Translate](https://fr.wordpress.org/plugins/loco-translate/)
* [Health Check](https://fr.wordpress.org/plugins/health-check/)
* [Contact Form 7](https://fr.wordpress.org/plugins/contact-form-7/)
* [Yoast SEO](https://fr.wordpress.org/plugins/wordpress-seo/)
* [WP Super Cache](https://fr.wordpress.org/plugins/wp-super-cache/)
* [WordPress Importer](https://fr.wordpress.org/plugins/wordpress-importer/)
