# typo3_traversal
TYPO3 extension for better work with pages and page tree


This extension adds three columns to database table `pages`: `lft`, `rgt` and `depth`. After each change of page tree these columns are recalculated.

For more information how to use these columns in your application, see http://en.wikipedia.org/wiki/Nested_set_model


## Instalation
Download extension (e.g. from https://github.com/lulco/typo3_traversal/archive/master.zip). Create folder `traversal` in your TYPO3 extension folder (`typo3conf/ext`). Copy all files and folders from `src` to your application folder `typo3conf/ext/traversal`. Turn on extension via extension manager.
