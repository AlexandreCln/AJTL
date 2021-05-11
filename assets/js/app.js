// CSS
import '../scss/app.scss';

// jQuery
const $ = require('jquery');

// Packages
require('bootstrap');
$(document).ready(function() {
  $('[data-toggle="popover"]').popover();
});

// Custom JS
import * as navbarToggler from "./modules/navbar-toggler";
navbarToggler.toggleMenu();

// Vue
import { createApp } from 'vue';
import ChatBox from '@/components/Chat/ChatBox';

createApp(ChatBox).mount('#chat-box');