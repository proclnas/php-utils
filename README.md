PHP Utils 
===
A serie of php util files

### Instalation
```
git clone http://github.com/proclnas/php-utils.git
```

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