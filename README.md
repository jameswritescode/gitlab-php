## GitLab PHP Wrapper

This project is in development - feel free to contribute if you find this.

This project uses [git-flow](https://github.com/nvie/gitflow) for development.

### Usage

```php
require 'gitlab.php'

$gitlab = new GitLab('http://git.example.com/api/v3', 'private_token_here');

print_r($gitlab->project->find(1));
```
