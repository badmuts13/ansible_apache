## ansible_apache
Installation and configuration of Apache httpd server (w/ vhosts) on RedHat7/CentOS7

## Ansible Role: Apache

This Ansible role installs Apache, configures the server (SELinux and firewalld), copies certificates and private keys (encrypt those w/ ansible vault). Also a cleanup of unneeded config files.

Document roots are creates for vhosts using a template. Most modules are loaded using a base.load config file. 

PHP5 config is also loaded. Some servers are skipped using a regex on hostname.

This is a base role. If a lap or lamp stack is needed, use this role and the lap or lamp role.

## Requirements
This role is tested on CentOS and RHEL 7.7 with Apache 2.4.6.
The private keys for the user certificates are written to a file on the target server, using data encrypted with Ansible Vault.

## Role Variables:
Available variables are listed below, along with default values (see defaults/main.yml)when applicable

	apache_fresh_install:
		- unneeded_file: /etc/httpd/conf.d/autoindex.conf

You can list all the files you don't want after the installation as unneeded_file. In defaults/main.yml is a list of all files that are installed by default. These are all removed.

		apache_httpd:
			- Timeout: 300
			  MaxKeepAliveRequests: 100
			  KeepAliveTimeout: 15
			  LimitRequestFieldSize: 8190
			  LimitRequestFields: 100

These are the default settings used in template apache_httpd.conf.j2

		apache_mod_ssl:
			- SSLCipherSuite: ALL:+HIGH:!ADH:!EXP:!SSLv2:!SSLv3:!MEDIUM:!LOW:!NULL:!aNULL
			  SSLProtocol: TLSv1.2
			  SSLHonorCipherOrder: "On"

These are the default settings used in template ssl.conf.j2

		apache_vhosts:
			- servername: "{{ ansible_fqdn }}"
			  docroot: ""
			  serveradmin: your_email@example.com
			  http_port: 80
			  https_port: 443
			  priority: 99
			  owner: apache
			  group: apache
			  rewrite: on
			  override: None
			  domain: "{{ ansible_domain }}"

These are the settings used in template apache_vhosts.conf.j2. If for some reason you don't use SSL (which you shouldn't) this will probably break.

		apache_firewalld:
			- service: http
			- service: https

On all my Linux servers firewall is always on (as is SELinux). List the services you need on your apache server here. 

		apache_module_files:
			- mod_file: prefork.load
			- mod_file: prefork.conf

If you need extra load or conf files in conf.modules.d directory list them here.

		apache_conf_files:
			- conf_file: README

If you need extra configuration files in the conf.d directory, list them here. See the README in files/mods if you need further info about what goes where.

		apache_certs:
			- domain: example.com
			  sshkey: !vault |
			  $ANSIBLE_VAULT;1.1;AES256

The sshkey is written to a file on the target server. The sshkey is encrypted using the vault. 

## Dependencies:
None.

## Example Playbook
		---
		- hosts: apache
		  vars_files:
		  	- vars/vhosts.yml
		  become: true
		  roles:
			- apache

  Inside vars/vhosts.yml

		apache_vhosts:
			- servername: web01.example.com
		  	  serveralias: web.example.com
			  serveradmin: webmaster@example.com
			  http_port: 80
			  https_port: 443
			  priority: 10
			  owner: apache
			  group: apache
			  rewrite: On
			  rewrite_rule: '^(.*)$ https://web.example.com [R=301,L]'
			  override: None
			  domain: example.com
 

## License:
I think MIT / BSD.... Suggestions are welcome...

## Author Information
This role was created in 2019 by me. 




