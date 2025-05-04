<?php
// Get og_settings and og_packages_category data using your database functions
$og_settings = return_multiple_rows("SELECT * FROM og_settings WHERE isactive = 1 AND soft_delete = 0");
$og_packages = return_multiple_rows("SELECT * FROM og_packages_category WHERE isactive = 1 AND soft_delete = 0");
?>

<style>
/* Add this CSS to make the shortcode panel scrollable */

<?php if(isset($css)) echo $css;?>

.shortcode-panel {
    position: fixed;
    right: 0;
    width: 350px;
    height: 100vh;
    background: #fff;
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
    z-index: 1000;
    padding: 15px;
    overflow-y: auto; /* Make the entire panel scrollable */
    transition: transform 0.3s ease;
}

.shortcode-panel.hidden {
    transform: translateX(100%);
}

.shortcode-panel .form-groups-container {
    max-height: calc(100vh - 150px);
    overflow-y: auto; /* Make form groups scrollable */
    padding-right: 5px;
}

.shortcode-panel .form-group {
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.shortcode-panel .form-group:last-child {
    border-bottom: none;
}

.shortcode-panel select[multiple] {
    min-height: 100px;
}

.show-panel-btn {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    background: #fff;
    border: 1px solid #ddd;
    border-right: none;
    padding: 10px 5px;
    border-radius: 5px 0 0 5px;
    cursor: pointer;
    z-index: 999;
}
</style>

<!-- Shortcode Panel -->
<div class="shortcode-panel hidden" id="shortcodePanel">
    <button class="close-panel" id="closeShortcodePanel">&times;</button>
    <h4>Insert Shortcodes</h4>
    
    <div class="form-groups-container">
        <div class="form-group">
            <label>Target Textarea:</label>
            <select class="form-control" id="targetTextarea">
                <!-- Options will be populated by JavaScript -->
            </select>
        </div>
        
        <div class="form-group">
            <label>Date/Time Shortcodes:</label>
            <select class="form-control date-time-shortcodes" multiple>
                <option value="{DATE}">Current Date (Y-m-d)</option>
                <option value="{DATE('F j, Y')}">Formatted Date</option>
                <option value="{TIME}">Current Time</option>
                <option value="{DATETIME}">Current DateTime</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>User Shortcodes:</label>
            <select class="form-control user-shortcodes" multiple>
                <option value="{USERNAME}">Username</option>
                <option value="{USEREMAIL}">User Email</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>System Shortcodes:</label>
            <select class="form-control system-shortcodes" multiple>
                <option value="{IP}">User IP</option>
                <option value="{USERAGENT}">User Agent</option>
                <option value="{BROWSER}">Browser</option>
                <option value="{OS}">Operating System</option>
                <option value="{LANG}">Language</option>
                <option value="{REFERER}">Referrer</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Text Transformation:</label>
            <select class="form-control text-shortcodes" multiple>
                <option value='{UPPER("text")}'>Uppercase</option>
                <option value='{LOWER("text")}'>Lowercase</option>
                <option value='{TITLECASE("text")}'>Title Case</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Math/Random:</label>
            <select class="form-control math-shortcodes" multiple>
                <option value="{RAND(1,100)}">Random Number</option>
                <option value="{UNIQUEID}">Unique ID</option>
                <option value="{UUID}">UUID</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Utility Shortcodes:</label>
            <select class="form-control utility-shortcodes" multiple>
                <option value="{GREETING}">Time-based Greeting</option>
                <option value='{SEOURL("text")}'>SEO URL</option>
                <option value='{CLEANCONTENT("text")}'>Clean Content</option>
                <option value='{DISCOUNT(100,10)}'>Discount</option>
                <option value='{TIMESINCE("2023-01-01")}'>Time Since</option>
                <option value='{PHONEFORMAT("03001234567")}'>Phone Format</option>
                <option value='{MD5("text")}'>MD5 Hash</option>
                <option value='{STRIPNUMBERS("text123")}'>Strip Numbers</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>OG Settings:</label>
            <select class="form-control og-settings-select" multiple>
                <?php foreach($og_settings as $setting): ?>
                    <option value="<?php echo htmlspecialchars($setting['short_code']); ?>"><?php echo htmlspecialchars($setting['settings_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>OG Packages:</label>
            <select class="form-control og-packages-select" multiple>
                <?php foreach($og_packages as $package): ?>
                    <option value="<?php echo htmlspecialchars($package['short_code']); ?>"><?php echo htmlspecialchars($package['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <button class="btn btn-sm btn-primary mt-3" id="insertAllShortcodes">Insert Selected Shortcodes</button>
    <button class="btn btn-sm btn-secondary mt-2" id="toggleShortcodePanel">Hide Panel</button>
</div>

<!-- Show Panel Button (hidden by default) -->
<button class="show-panel-btn" id="showPanelBtn">
    <i class="fas fa-chevron-left"></i> Shortcodes
</button>

<script type="text/javascript">
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize after a slight delay to ensure all dynamic content is loaded
    setTimeout(initializeShortcodePanel, 100);
});

function initializeShortcodePanel() {
   // Find all textareas on the page and populate the dropdown
    var textareas = document.querySelectorAll('textarea');
    var targetDropdown = document.getElementById('targetTextarea');
    
    // Clear existing options
    targetDropdown.innerHTML = '';
    
    // Add default option
    var defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = '-- Select a Textarea --';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    targetDropdown.appendChild(defaultOption);
    
    // Add all textareas to dropdown
    textareas.forEach(function(textarea) {
        var textareaId = textarea.id;
        if (textareaId) {
            var option = document.createElement('option');
            option.value = textareaId;
            option.textContent = textareaId;
            
            // Add dataset with the textarea's name/label if available
            if(textarea.name) option.dataset.name = textarea.name;
            if(textarea.placeholder) option.dataset.placeholder = textarea.placeholder;
            
            targetDropdown.appendChild(option);
        }
    });
    
    // Add event listeners to all textareas to update dropdown selection
    textareas.forEach(function(textarea) {
        textarea.addEventListener('focus', function() {
            var textareaId = this.id;
            if (textareaId) {
                targetDropdown.value = textareaId;
            }
        });
        
        textarea.addEventListener('click', function() {
            var textareaId = this.id;
            if (textareaId) {
                targetDropdown.value = textareaId;
            }
        });
    });
    
    // Also update when dropdown selection changes to focus the textarea
    targetDropdown.addEventListener('change', function() {
        var textareaId = this.value;
        if (textareaId) {
            var textarea = document.getElementById(textareaId);
            if (textarea) {
                textarea.focus();
            }
        }
    });
    
    // Shortcode panel functionality
    document.getElementById('toggleShortcodePanel').addEventListener('click', function() {
        document.getElementById('shortcodePanel').classList.add('hidden');
        document.getElementById('showPanelBtn').style.display = 'block';
    });
    
    document.getElementById('closeShortcodePanel').addEventListener('click', function() {
        document.getElementById('shortcodePanel').classList.add('hidden');
        document.getElementById('showPanelBtn').style.display = 'block';
    });
    
    document.getElementById('showPanelBtn').addEventListener('click', function() {
        document.getElementById('shortcodePanel').classList.remove('hidden');
        this.style.display = 'none';
    });
    
    // Function to insert text at cursor position
    function insertAtCursor(text) {
        var targetId = document.getElementById('targetTextarea').value;
        if (!targetId) {
            showAlert('Please select a target textarea first');
            return;
        }
        
        var textarea = document.getElementById(targetId);
        if (!textarea) {
            showAlert('Target textarea not found!');
            return;
        }
        
        // IE support
        if (document.selection) {
            textarea.focus();
            var sel = document.selection.createRange();
            sel.text = text;
        }
        // Modern browsers
        else if (textarea.selectionStart || textarea.selectionStart === 0) {
            var startPos = textarea.selectionStart;
            var endPos = textarea.selectionEnd;
            var scrollTop = textarea.scrollTop;
            
            textarea.value = textarea.value.substring(0, startPos) + 
                            text + 
                            textarea.value.substring(endPos, textarea.value.length);
            
            textarea.selectionStart = startPos + text.length;
            textarea.selectionEnd = startPos + text.length;
            textarea.scrollTop = scrollTop;
        } else {
            textarea.value += text;
        }
        
        textarea.focus();
    }
    
    // Insert all selected shortcodes
    document.getElementById('insertAllShortcodes').addEventListener('click', function() {
        var allSelected = [];
        
        // Helper function to get selected values from a select element
        function getSelectedValues(selector) {
            var options = document.querySelectorAll(selector + ' option:checked');
            return Array.from(options).map(function(option) {
                return option.value;
            });
        }
        
        // Get selected shortcodes from all categories
        allSelected = allSelected.concat(getSelectedValues('.date-time-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.user-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.system-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.text-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.math-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.utility-shortcodes'));
        allSelected = allSelected.concat(getSelectedValues('.og-settings-select'));
        allSelected = allSelected.concat(getSelectedValues('.og-packages-select'));
        
        // Insert all selected shortcodes
        if (allSelected.length > 0) {
            var combinedText = allSelected.join("\n");
            insertAtCursor(combinedText);
        } else {
            showAlert('Please select at least one shortcode to insert.');
        }
    });
}
</script>