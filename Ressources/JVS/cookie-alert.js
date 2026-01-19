(function(){
  try {
    if (!sessionStorage.getItem('cookie_seen')) { //Si le message n’a jamais été affiché dans cette session
      var ok = confirm('Ce site utilise des cookies. Acceptez-vous les cookies ?');
      sessionStorage.setItem('cookie_seen', '1'); // validité jusqu’à fermeture de l’onglet
      if (ok) {
        document.cookie = 'cookie_consent=accepted; path=/'; //création du doc cookie
      }
    }
  } catch(e) {                      // si pb on recommence
    confirm('Ce site utilise des cookies. Acceptez-vous ?');
  }
})();
