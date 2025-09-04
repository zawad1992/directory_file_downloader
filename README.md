# Directory File Downloader

A simple and elegant PHP-based file directory browser and download center with a modern Bootstrap interface.

## 🌟 Features

- **Modern Web Interface**: Clean and responsive design using Bootstrap 5
- **File Statistics**: Display total files, total size, file types, and last update
- **File Type Icons**: Visual file type recognition with Font Awesome icons
- **Smart File Filtering**: Automatically excludes system and development files
- **Download Management**: Direct file download functionality
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Real-time Information**: Shows file size, modification date, and more

## 🚀 Getting Started

### Prerequisites

- PHP 7.0 or higher
- Web server (Apache, Nginx, or PHP built-in server)

### Installation

1. Clone or download this repository to your web directory:
   ```bash
   git clone https://github.com/zawad1992/directory_file_downloader.git
   ```

2. Navigate to the project directory:
   ```bash
   cd directory_file_downloader
   ```

3. Place your downloadable files in the same directory as `index.php`

### Quick Start

#### Option 1: Using PHP Built-in Server
Run the included batch file to start the server:
```bash
server.bat
```
Or manually start the server:
```bash
php -S 0.0.0.0:8585
```
Then visit `http://localhost:8585` in your browser.

#### Option 2: Using Apache/Nginx
Simply place the files in your web server's document root and access via your domain.

## 📁 File Structure

```
directory_file_downloader/
├── index.php           # Main application file
├── server.bat         # Quick server start script
├── README.md          # Project documentation
└── [your files]      # Place downloadable files here
```

## 🎯 How It Works

1. **File Scanning**: The application automatically scans the current directory for downloadable files
2. **Smart Filtering**: Excludes development files (PHP, HTML, CSS, JS, BAT, etc.) and system files
3. **File Information**: Gathers file size, modification date, and file type
4. **Display**: Presents files in a sortable table with download links
5. **Statistics**: Shows overview statistics including total files and combined size

## 🔧 Supported File Types

The application recognizes and displays appropriate icons for:
- **Images**: JPG, JPEG, PNG, GIF, BMP, SVG
- **Videos**: MP4, AVI, MOV, MKV, WMV
- **Audio**: MP3, WAV, FLAC, AAC
- **Documents**: PDF, DOC, DOCX, XLS, XLSX
- **Archives**: ZIP, RAR, 7Z
- **Text**: TXT, LOG

## 🎨 Customization

### Excluded File Types
To modify which file types are excluded, edit the `$skippedExtensions` array in `index.php`:
```php
$skippedExtensions = ['php', 'html', 'css', 'js', 'bat', 'sh', 'cmd', 'ini', 'json', 'xml', 'yml', 'yaml', 'md'];
```

### Styling
The interface uses Bootstrap 5 and Font Awesome. You can customize the appearance by modifying the CSS in the `<style>` section of `index.php`.

## 💡 Use Cases

- **File Sharing**: Share files with colleagues or clients
- **Download Centers**: Create download portals for software, media, or documents
- **Local File Browser**: Browse files on a local network
- **Development**: Quick file sharing during development

## 🔒 Security Notes

- The application only displays files in the same directory as `index.php`
- System and development files are automatically excluded
- No file upload functionality (view/download only)
- Consider implementing authentication for sensitive file sharing

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 👤 Author

**Zawadul Kawum**
- GitHub: [@zawad1992](https://github.com/zawad1992)
- Website: [zawadulkawum.com](https://zawadulkawum.com)

## 🙏 Acknowledgments

- [Bootstrap](https://getbootstrap.com/) - For the responsive UI framework
- [Font Awesome](https://fontawesome.com/) - For the beautiful icons
- PHP Community - For the robust server-side scripting

---

⭐ If you found this project helpful, please give it a star!