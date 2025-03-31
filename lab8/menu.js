$(document).ready(function() {

   $.ajax({
       type: 'GET',
       url: '../../lab8/menu.json',
       dataType: 'json',
       success: function(responseData, status) {
           var output = '<ul class="list">';  
           $.each(responseData.menuItem, function(i, item) {
               output += '<li class="dropdown">';
               output += '<h1>' + item.name + '</h1>';
               output += '<div class="dropdown-content">';
               
               for(var key in item) {
                   if(key !== 'name') {
                       output += '<a href="' + item[key] + '">' + key + '</a>';
                   }
               }
               
               output += '</div></li>';
           });
           output += '</ul>';
           $('#menu').html(output);
       }, 
       error: function(msg) {
           console.error('Error:', msg);
           alert('There was a problem: ' + msg.status + ' ' + msg.statusText);
       }
   });
});