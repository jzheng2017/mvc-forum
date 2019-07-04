$(document).ready(function(){
    $('.sidenav').sidenav();
});

$(document).ready(function(){
    $('select').formSelect();
});

$(document).ready(function(){
    $('.collapsible').collapsible();
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, []);
});

