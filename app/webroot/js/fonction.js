$(document).ready(function() {
    var keys     = [];
    // enter
    var login  = '69,78,84,69,82';
    // exit
    var logout  = '69,88,73,84';
    $(document).keydown(function(e){
       keys.push( e.keyCode );
          if ( keys.toString().indexOf( login ) >= 0 ){
              view_login();
              keys = [];
          }
          if ( keys.toString().indexOf( logout ) >= 0 ){
              view_logout();
              keys = [];
          }
    });
});
function view_login(){
  $("body").append('<div id="login_user"><fieldset><legend></legend><div class="formCenter"><br/><form action="'+__prefix+'/admin/users/user" id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><div class="input text required"><label for="UserUsername">Login : </label><input name="data[User][username]" size="30px" maxlength="100" type="text" id="UserUsername"/></div><div class="input password required"><label for="UserPassword">Mot de passe : </label><input name="data[User][password]" size="30px" type="password" id="UserPassword"/></div><br/><div class="submit"><input  type="submit" value="Connexion"/></div></form><br/></div></fieldset></div>');
  $("#login_user").slideDown("slow");
  $('#UserUsername').focus();
  //
  $("#login_user>fieldset").hover(
    function () {},
    function () {
      $("#login_user").click(function(){
        $('#login_user').slideUp('slow', function() {
          $("#login_user").remove();
       });
      });
    }
  );
  
}
function view_logout(){
  if(confirm("Voulez vous quitter l'administration ?")){
    window.location = __prefix+'/admin/users/logout';
  }
}