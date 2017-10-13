PHP Utils 
===
A serie of php util files

### Instalation
```
git clone http://github.com/proclnas/php-utils.git
```

## Available Utils:
- Request
- File
- Network

## Request (Http utils)

Usage:

```php
require 'Request.php';

use Util\Request;

$r = new Request;

// Get Request
$r->getRequest('http://site.com');
// Post request
$r->postRequest('http://site.com/post', ['param1' => '...', 'param2' => '....']);

// Raw response
var_dump($r->getHttpResponse());

// Raw response using callback-like
$r->getRequest(
    'http://site.com',
    function($httpResponse, $httpInfo) {
        var_dump($httpResponse, $httpInfo);
    }
);

$r->postRequest(
    'http://site.com',
    ['param1' => '...', 'param2' => '...'],
    function($httpResponse, $httpInfo) {
        var_dump($httpResponse, $httpInfo);
    }
);
```
## File (io utils)

- Read file using generator (Avoid extensive memory usage)
- Save to file

Usage:
```php
require 'File.php';

use Util\File;

// Read a file
foreach(File::readFile($file) as $line) {
    // Logic here
}

// Save to file (Overwrite file)
File::saveFile('output.txt', 'content');

// Save to file (Append content)
File::saveFile('output.txt', 'content', true);

```

## Network (Network utils)

- Generate ip range using generator (Avoid extensive memory usage)

Usage:
```php
require 'Network.php';

use Util\Network;

foreach (Network::genIp('192.168.0.1', '192.168.1.255') as $ip) {
    echo $ip . PHP_EOL;
}
```

output:

```
...
192.168.0.1
...
192.168.1.243
192.168.1.244
192.168.1.245
192.168.1.246
192.168.1.247
192.168.1.248
192.168.1.249
192.168.1.250
192.168.1.251
192.168.1.252
192.168.1.253
192.168.1.254
192.168.1.255
...
```