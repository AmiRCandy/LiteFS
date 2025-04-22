
---
# **LiteFS - Lightweight PHP File Manager Library**

`LiteFS` is a modern, fast, and easy-to-use PHP library for managing files and directories. It provides a clean API for common file management tasks such as creating directories, copying files, moving files, deleting files, and more.

---

## **Features**

- Create directories and files
- Copy directories and files
- Move or rename files and directories
- Delete files and directories
- List files and directories
- Check if files or directories exist
- Handle file paths relative to a given root path
- Supports recursive directory iteration

---

## **Installation**

You can install `LiteFS` by cloning the repository or by downloading the source code directly.

### **Clone the repository**

```bash
git clone https://github.com/AmiRCandy/LiteFS.git
cd LiteFS
```

### **Manual Download**

Download the ZIP file from [GitHub](https://github.com/AmiRCandy/LiteFS) and extract it.

---

## **Usage**

### **1. Create a FileManager Instance**

```php
use LiteFS\LiteFS;

$fileManager = new LiteFS('/path/to/base/directory');
```

The constructor accepts the path to the base directory where the operations will be performed.

---

### **2. Create a Directory**

```php
$fileManager->createDir('my/new/directory');
```

Creates a new directory relative to the base directory.

---

### **3. Copy a Directory**

```php
$fileManager->copyDir('source/directory', 'destination/directory');
```

Copies the entire directory, including subdirectories and files.

---

### **4. Move a File or Directory**

```php
$fileManager->move('source/file', 'destination/file');
```

Moves or renames a file or directory.

---

### **5. Delete a File or Directory**

```php
$fileManager->delete('file/to/delete');
```

Deletes the specified file or directory. If it's a directory, it deletes all files inside it recursively.

---

### **6. Check if a File or Directory Exists**

```php
if ($fileManager->exists('file/to/check')) {
    echo 'File or directory exists.';
}
```

Returns `true` if the file or directory exists, otherwise `false`.

---

### **7. List Files in a Directory**

```php
$files = $fileManager->listFiles('directory/to/list');
print_r($files);
```

Lists all files inside the specified directory. It returns an array of file names.

---

### **8. Get File Size**

```php
$size = $fileManager->getFileSize('file/to/size');
echo 'File size: ' . $size . ' bytes';
```

Returns the size of the file in bytes.

---

### **9. Delete Multiple Files**

```php
$fileManager->deleteMultiple(['file1.txt', 'file2.txt']);
```

Deletes multiple files in one call.

---

## **API Reference**

### **LiteFS Methods**

- `__construct(string $basePath)`: Initializes the `LiteFS` with the specified base directory.
- `createDir(string $path)`: Creates a new directory.
- `copyDir(string $src, string $dest)`: Copies a directory from `src` to `dest`.
- `move(string $src, string $dest)`: Moves or renames a file or directory.
- `delete(string $path)`: Deletes a file or directory.
- `deleteMultiple(array $files)`: Deletes multiple files.
- `exists(string $path)`: Checks if a file or directory exists.
- `listFiles(string $path)`: Lists files in a directory.
- `getFileSize(string $path)`: Gets the size of a file.

---

## **To-Do List for LiteFS Development**

---

### **General Tasks**

- [ ] **Test all methods** to ensure they work across different PHP versions (5.3+).
- [ ] **Write Unit Tests** using PHPUnit.
- [ ] **Write integration tests** for multi-step operations like copying directories and moving files.
- [ ] **Code Review** - Ensure all code is optimized for performance and readability.

---

### **Features to Add**

- [ ] **Add support for file permissions** (read/write/execute).
- [ ] **Add file search functionality** within directories.
- [ ] **Create a logging mechanism** for all file operations performed by the library.
- [ ] **Add support for symbolic links**.
- [ ] **Add file compression (zip/gzip)** and decompression support.
- [ ] **Support for file timestamps** (last modified, creation date).
- [ ] **Support for file ownership**.

---

### **Documentation & Release**

- [ ] **Update README** with more examples.
- [ ] **Publish documentation** to a static site or include in GitHub Pages.
- [ ] **Prepare GitHub Release** and version tags.
- [ ] **Publish to Packagist** for Composer installation.
- [ ] **Add a License** to the repository (MIT/Apache 2.0).

---

## **Contributing**

If you'd like to contribute to LiteFS, please fork the repository and submit a pull request. Contributions are welcome!

---

## **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---