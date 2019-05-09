
import 'bootstrap/js/dist/collapse';
import '../css/app.css';
import 'whatwg-fetch';

import collection from './collection/main';
import book from './book/main';

document.addEventListener('DOMContentLoaded', function(){
  collection();
  book();
}, false);
