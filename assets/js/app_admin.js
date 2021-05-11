// CSS
import '../scss/app_admin.scss';

// jQuery
const $ = require('jquery');

// Packages
require('bootstrap');

// Custom JavaScript
import * as customFileInput from './modules/custom-file-input.js';
customFileInput.updateInputFileName();
import * as dashboard from './pages/admin/dashboard.js';
dashboard.toggleMenu();
