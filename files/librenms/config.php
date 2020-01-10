i<?php

## Have a look in includes/defaults.inc.php for examples of settings you can set here. DO NOT EDIT defaults.inc.php!

### Database config
$config['db_host'] = 'localhost';
$config['db_user'] = 'librenms';
$config['db_pass'] = 'GggwLkb#m9!V';
$config['db_name'] = 'librenms';

// This is the user LibreNMS will run as
//Please ensure this user is created and has the correct permissions to your install
$config['user'] = 'librenms';

### This should *only* be set if you want to *force* a particular hostname/port
### It will prevent the web interface being usable form any other hostname
$config['base_url']        = "/";

### Enable this to use rrdcached. Be sure rrd_dir is within the rrdcached dir
### and that your web server has permission to talk to rrdcached.
#$config['rrdcached']    = "unix:/var/run/rrdcached.sock";

### Default community
$config['snmp']['community'] = array("public");

### Authentication Model
#$config['auth_mechanism'] = "mysql";
#$config['http_auth_guest'] = "guest"; # remember to configure this user if you use http-auth

### List of RFC1918 networks to allow scanning-based discovery
#$config['nets'][] = "10.0.0.0/8";
#$config['nets'][] = "172.16.0.0/12";
#$config['nets'][] = "192.168.0.0/16";

# Uncomment the next line to disable daily updates
#$config['update'] = 0;

# Number in days of how long to keep old rrd files. 0 disables this feature
$config['rrd_purge'] = 0;

# Uncomment to submit callback stats via proxy
#$config['callback_proxy'] = "hostname:port";

# Set default port association mode for new devices (default: ifIndex)
#$config['default_port_association_mode'] = 'ifIndex';

# Enable the in-built billing extension
$config['enable_billing'] = 1;

# Enable the in-built services support (Nagios plugins)
$config['show_services'] = 1;
$config['fping'] = "/usr/sbin/fping";

# AD koppeling
$config['auth_mechanism'] = "active_directory";
$config['auth_ad_url'] = "ldap://voldc01.volandis.nl";
$config['auth_ad_dont_check_certificates'] = "1";
$config['auth_ad_domain'] = "volandis.nl";
$config['auth_ad_base_dn'] = "dc=volandis,dc=nl";
$config['auth_ad_groups']['NmsAdmin']['level'] = 10;
$config['auth_ad_debug'] = true;
$config['auth_ad_require_groupmembership'] = false;
$config['active_directory']['users_purge'] = 14;
$config['http_auth_guest'] = libreuser;
$config['ad_binduser'] = svc_ldap_query;
$config['auth_ad_bindpassword'] = ad_bindpassword;
$config['auth_ldap_cache_ttl'] = 300;

