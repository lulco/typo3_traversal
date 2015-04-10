# typo3_traversal
TYPO3 extension for better work with pages and page tree

This extension adds three columns to database table `pages`: `lft`, `rgt` and `depth`. After each change of page tree these columns are recalculated. Also you can set up scheduler to recalculate page tree in some intervals or run recalculating manually with button in clear cache menu.

## Instalation
Download extension (e.g. from https://github.com/lulco/typo3_traversal/archive/master.zip). Create folder `traversal` in your TYPO3 extension folder (`typo3conf/ext`). Copy all files and folders from `src` to your application folder `typo3conf/ext/traversal`. Turn on extension via extension manager.

## Usage
For more information how to use columns `lft`, `rgt` and `depth` in your application, see http://en.wikipedia.org/wiki/Nested_set_model