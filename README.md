# LiteFS Library

A modern, clean PHP library for managing files and directories. Supports all common file and folder operations, and works with ZIP archives.

## Features

- File and folder creation, reading, deletion, moving
- Recursive operations
- File info (size, extension, etc.)
- Safe path handling with base directory
- Zip/unzip folders

## Usage

```php
$fm = new LiteFS('/your/base/path');
$fm->createFile('myfile.txt', 'Hello!');
```