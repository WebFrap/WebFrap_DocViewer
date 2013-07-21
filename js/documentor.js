
$(document).ready(function(){
       $('ul.treeMenu').treeview();
});

function show_chapter( chapter ){

       $('#docu-menu').load("menu.php?page="+chapter, function(){
              $('ul.treeMenu').treeview();
    $('#docu-menu').find('a.clink').each( function(){
                console.log("found "+this.href);
      $(this).click( function(){
                            load_content(this);
              return false;
                     });
              });
       });
       show_content( chapter+".start" );
}

function show_content( page ){

       $('#docu-content').load("content.php?page="+page, function(){
    $('#docu-content').find('a.clink').each( function(){
      $(this).click( function(){
                            load_content(this);
              return false;
                     });
              });
       });
}

function load_content( link ){

       $('#docu-content').load( link.href, function(){

    $('#docu-content').find('a.clink').each( function(){
                     $(this).click( function(){
                            load_content(this);
              return false;
                     });
              });
       });
}