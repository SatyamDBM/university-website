import './bootstrap';
import Alpine from 'alpinejs';
import { initGlobalSearch } from './global-search';

window.Alpine = Alpine;

// 🔥 MUST expose globally
window.initGlobalSearch = initGlobalSearch;

Alpine.start();