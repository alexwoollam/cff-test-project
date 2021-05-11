terraform {
  required_providers {
    docker = {
      source = "kreuzwerker/docker"
      version = "2.11.0"
    }
  }
}

provider "docker" {}

resource "docker_network" "private_network" {
  name = "backend"
}

resource "docker_container" "db" {
  name  = "${var.wp_db_host}"
  image = "mysql:5.7"
  restart = "always"
  networks_advanced {
      name = "backend"
  }
  volumes {
      host_path = "/var/www/traefik-test.io/DB"
      container_path = "/docker-entrypoint-initdb.d"
  }
  env = [
    "MYSQL_DATABASE=${var.wp_db_name}", 
    "MYSQL_ROOT_PASSWORD=${var.wp_db_pass}"
  ]
}

resource "docker_container" "wordpress" {
  name  = "${var.wp_box_name}"
  image = "wordpress:latest"
  restart = "always"
  network_mode = "bridge"
  networks_advanced {
      name = "backend"
  }
  hostname = "${var.url}"
  volumes {
      host_path = "/var/www/traefik-test.io/Content/"
      container_path = "/var/www/html/wp-content/"
  }
  ports {
    internal = "80"
    external = "80"
  }
  env = [
      "WORDPRESS_DB_HOST=http://${var.wp_db_host}",
      "WORDPRESS_DB_USER=http://${var.wp_db_user}",
      "WORDPRESS_DB_NAME=http://${var.wp_db_name}", 
      "WORDPRESS_DB_PASSWORD=http://${var.wp_db_pass}",
      "WORDPRESS_CONFIG_EXTRA= \n define('WP_HOME','http://${var.url}'); \n define('WP_SITEURL','http://${var.url}');"
    ]
}