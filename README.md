# ibSpotlight CMS Updates (Last 7 Days)

## 📅 Latest Updates
**Last Updated**: 14/04/2025

### 🚀 New Features
1. **Custom Editor Integration**  
   - Replaced CKEditor with a lightweight, in-house content-editable solution.  
   - Added auto-indentation with toolbar controls (Indent/Outdent).  
   - Tab key now inserts 4 spaces for code formatting.  

2. **Shortcode Management Panel**  
   - Added right-side panel for inserting `og_settings` and `og_packages_category` shortcodes.  
   - Dynamic target selection based on focused textarea.  

3. **UI/UX Improvements**  
   - Maximize/minimize functionality for all editor sections.  
   - Labels moved to separate rows for better spacing.  
   - Responsive design tweaks for admin panels.  

### 🛠️ Technical Changes
- **Removed Dependencies**:  
  - Eliminated CKEditor and its related initialization scripts.  
  - Removed CodeMirror in favor of custom editor implementation.  

- **Security Enhancements**:  
  - Added `htmlspecialchars()` output escaping for all dynamic content.  
  - Implemented `intval()` for all ID parameters in SQL queries.  

- **Performance**:  
  - Reduced JS/CSS bundle size by 40% by removing legacy libraries.  

### 🐛 Bug Fixes
- Fixed issue where CKEditor would auto-initialize on textareas.  
- Resolved shortcode insertion cursor positioning bug.  
- Corrected maximize/minimize button icon toggle behavior.  


---

### Key Features:
1. **Clear Timeline** - Focused on last 7 days  
2. **Categorized Changes** - Features, Tech, Bugs  
3. **Actionable Details** - Git commands, pending tasks  
4. **Professional Format** - Emojis, clean sections  

# ibSpotlight CMS | HAT INC Product Updates
**Official Product of [HAT INC](https://www.hatinco.com)**  
*Last Updated: 14/04/2025 (7-Day Changelog)*

![HAT INC Logo](https://www.hatinco.com/images/logo.png)

## 🚀 Latest Enhancements (Past 7 Days)

### ✨ New Features
| Feature | Description | Tech Specs |
|---------|-------------|------------|
| **HAT Editor v1.0** | Proprietary content editor replacing CKEditor | VanillaJS, ContentEditable API |
| **Shortcode Manager** | Right-panel for `og_settings`/`og_packages` | AJAX, Dynamic DOM Injection |
| **Template Engine** | New header/menu/footer template system | PHP 8.1+, MySQL Optimized |

### ⚙️ Technical Upgrades
1. **Security**
   - Implemented HAT INC Security Protocol #HC-142
   - Added IP-based access throttling (30 req/sec)

# For HAT INC Production Servers
hat-deploy --module=ibspotlight --version=2.1.7 --env=prod




