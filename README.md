# miab_ddns_proxy

This is a PHP script that will proxy GET requests (like from pfSense for example) to update a given DNS record.

The script is called like this:

### Browser:
`https://ip_or_domain/miabproxy.php?address=ddns-address.example.com`

### cURL:

`curl -X PUT --user username@example.com:password https://ip_or_domain/miabproxy.php?address=ddns-address.example.com`
