## GitLab PHP Wrapper

This project is not maintained and not finished.

### Usage

```php
require 'gitlab.php'

$gitlab = new GitLab('http://git.example.com/api/v3', 'private_token_here');

print_r($gitlab->project->find(1));
```
